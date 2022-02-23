<?php
	function callCerrarSesion(){
		include("../../../template/templateHeadCerrarSesion.php");
		include("../../../template/templateFooterLogin.php");
		include("../../../dialogs/modalViews.php"); 
		template_head(); modalViews(); template_footer();
	}

	function restarDias($numDias, $fecha) {
		$dias = "-".intval($numDias)." day";
		$nuevafecha = strtotime($dias,strtotime($fecha));
		$nuevafecha = date('Y-m-j',$nuevafecha);
		return $nuevafecha;
	}
	
	function cleanData($limite,$max,$mayuscula,$data) {
		if ($data != "") {
			$data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlentities($data);
			if ($limite == "siLimite") {
				$data = substr($data,0,$max);
			}
		  if ($mayuscula == "siMayuscula") {
				$data = strtoupper($data);
			}
		}
		else {
			$data = NULL;
		}
	  return $data;
	}

	function app_error_reporting($data) {
    if ($data == 1) {
    	ini_set('display_errors','1');
  		error_reporting(E_ALL);
    }
    else {
  		error_reporting(0);
    }
	}

	class ValidacionUsuario {

    const HASH = PASSWORD_DEFAULT;
    const COST = 14;

    function encrypt_decrypt($action, $string) {
		  $output = false;
		  $string = md5($string);
		  $encrypt_method = "AES-256-CBC";
		  $secret_key = 'M@ruto_Di0s_3s_Fu3rz@';
		  $secret_iv = 'S@mu31_Di0s_3s_Fu3rz@';
		  $key = hash('sha256', $secret_key);
		  $iv = substr(hash('sha256', $secret_iv), 0, 16);
		  if ($action == 'encrypt') {
		    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		    $output = base64_encode($output);
		  } else if ($action == 'decrypt') {
		    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		  }
		  return $output;
		}

    public function save($userSystem,$password,$pdo) {
      $sql_upt="SELECT * FROM system.update_password(:userSystem, :pass)";
	    $query_upt=$pdo->prepare($sql_upt);
	    $query_upt->bindValue(':userSystem', $userSystem);
    	$query_upt->bindValue(':pass', $password);
	    $query_upt->execute();
	    return $query_upt;
    }
    public function setPassword($password) {
      return $this->encrypt_decrypt('encrypt', $password);
    }
    public function getPassword($password) {
      return $this->encrypt_decrypt('decrypt', $password);
    }
    public function newSesion($userSystem) {
    	require_once("sesion.class.php");
      $nombres = new sesion();
			$nombres->set("userSystem",$userSystem);
			$nombres->set("timeoutSession",time());
    }
    public function newSesionOtraPC($userSystem) {
    	require_once("sesion.class.php");
      $nombres = new sesion();
			$nombres->set("userSystemOtraPC",$userSystem);
    }
    public function verifyPassword($password, $password_encript) {
      if (hash_equals($this->encrypt_decrypt('encrypt',$password),$password_encript)) {
      	return true;
      }
      return false;
    }
    public function login($userSystem,$password,$pdo) {
      try {
				$sql="SELECT usr_contrasenia,usr_estado_contrasenia,usr_fecha_cambio_contrasenia,usr_contador_error_contrasenia,usr_expiro_contrasenia
							FROM dct_sistema_tbl_usuario
							WHERE usr_cod_usuario = :usr_cod_usuario;";
		    $query=$pdo->prepare($sql);
		    $query->bindValue(':usr_cod_usuario', $userSystem);
		    $query->execute();
		    if ($query->rowCount() == 1) {
		    	$row = $query->fetch(\PDO::FETCH_ASSOC);
		    	if ($row["usr_estado_contrasenia"] == 'A') {
		    		if ($this->verifyPassword($password,$row["usr_contrasenia"])) {
              return "pasoTodo";
		        }
		        return "claveNoIgual&&&".$row["usr_contador_error_contrasenia"];
		    	}
		    	return "statusPassFalse"; // clave inhabilitada por intentos excedidos
				}
			  return "cedulaNoRegistrada";
			} catch (\PDOException $e) {
			  echo $e->getMessage();
			}
    }
	} //Fin de clase ValidacionUsuario

	function validaAcceso($pdo,$dataSesion) {
		try {
			$sql="SELECT rlo_id_opcion
						FROM dct_sistema_tbl_rol_opcion
						WHERE rlo_id_rol = (SELECT usr_id_rol 
						FROM dct_sistema_tbl_usuario
						WHERE usr_cod_usuario = :usr_cod_usuario);";
	    $query=$pdo->prepare($sql);
	    $query->bindValue(':usr_cod_usuario', $dataSesion['cod_system_user']);
	    $query->execute();
	    $row = $query->fetchAll();
	    $return = array();
    	foreach ($row as $row) {
	      $return[] = $row["rlo_id_opcion"];
	  	}
	  	if (in_array($dataSesion['id_option'], $return)) {
	  		$sql_opt="SELECT opc_estado
									FROM dct_sistema_tbl_opcion
									WHERE opc_id_opcion = :opc_id_opcion;";
		    $query_opt=$pdo->prepare($sql_opt);
		    $query_opt->bindValue(':opc_id_opcion', $dataSesion['id_option']);
		    $query_opt->execute();
		    $row_opt = $query_opt->fetch(\PDO::FETCH_ASSOC);

		    $sql_app="SELECT apl_estado
									FROM dct_sistema_tbl_aplicacion
									WHERE apl_id_aplicacion = (SELECT opc_id_aplicacion
									FROM dct_sistema_tbl_opcion
									WHERE opc_id_opcion = :opc_id_opcion);";
		    $query_app=$pdo->prepare($sql_app);
		    $query_app->bindValue(':opc_id_opcion', $dataSesion['id_option']);
		    $query_app->execute();
		    $row_app = $query_app->fetch(\PDO::FETCH_ASSOC);

		    if ( $row_opt["opc_estado"] == 'A' &&  $row_app["apl_estado"] == 'A' ) {
		    	return TRUE;
		    }
		    else {
		    	return FALSE;
		    }
			}
			else {
				return FALSE;
			}
		} catch (\PDOException $e) {
		    echo $e->getMessage();
		}
	}

	function getRealIP() {
    return $_SERVER["REMOTE_ADDR"];
  }

  function calcularEdadFinal($fechaIngreso, $fechaActual) {
		if ($fechaActual == null) {
			$fechaActual = $fechaIngreso;
		}
		else {
			$fechaActual = $fechaActual;
		}
		$datetime1 = date_create($fechaIngreso);
		$datetime2 = date_create($fechaActual);
		$interval = date_diff($datetime1, $datetime2);
		/*'%Y años %m meses %d days %H horas %i minutos %s segundos'*/
		return $interval->format('%Y AÑOS %M MESES %D DÍAS');
	}
	function phpMailer($arrayMail)
	{
		include("../../../dctDatabase/Parameter.php");
		require_once('../../../plugins/PHPSendMail/PHPMailerAutoload.php');
	  $mail = new PHPMailer;
	  $mail->SMTPDebug = 0;
	  $mail->Debugoutput = 'html';
	  $mail->isSMTP();
	  $mail->Host = $hostSince;
	  $mail->SMTPAuth = true;
	  $mail->CharSet = "UTF-8";
	  $mail->Username = $mailSince;
	  $mail->Password = $passSince;
	  $mail->SMTPSecure = $mailSMTP;
	  $mail->Port = $mailPort;
	  $mail->setFrom($deCorreo);
	  $mail->SMTPOptions = array(
	    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
	    )
	  );

	  switch ($arrayMail["tipoCorreo"]) {
	  	case 'htmlResetPass':
					$mail->addAddress($arrayMail["paraCorreo"]);
				  $mail->Subject = $arrayMail["subject"];
				  $body = file_get_contents($arrayMail["archivoHTML"]);
				  $body = str_replace('%%fechaReporte%%', $fechaActual_1, $body);
				  $body = str_replace('%%linkReset%%', $arrayMail["linkReset"], $body);
				  $body = str_replace('%%nombres%%', $arrayMail["nombres"], $body);
	  		break;
	  	case 'htmlResetPassConfirmacion':
	  			$mail->addAddress($arrayMail["paraCorreo"]);
				  $mail->Subject = $arrayMail["subject"];
				  $body = file_get_contents($arrayMail["archivoHTML"]);
				  $body = str_replace('%%fechaReporte%%', $fechaActual_1, $body);
				  $body = str_replace('%%nombres%%', $arrayMail["nombres"], $body);
	  		break;
	  	case 'htmlActivarCuenta':
	  			$mail->addAddress($arrayMail["paraCorreo"]);
				  $mail->Subject = $arrayMail["subject"];
				  $body = file_get_contents($arrayMail["archivoHTML"]);
				  $body = str_replace('%%fechaReporte%%', $fechaActual_1, $body);
				  $body = str_replace('%%linkReset%%', $arrayMail["linkReset"], $body);
				  $body = str_replace('%%nombres%%', $arrayMail["nombres"], $body);
				break;
	  	default:
	  		break;
	  }

	  $mail->MsgHTML($body);
	  $mail->IsHTML(true);
		if ($mail->send()) {
		    return true;
				//echo json_encode(array('message'=>"sendOk"));
		} else {
		    return false;
		    //echo json_encode(array('message'=>"sendError"));
		}
	}
?>