<?php
	require_once("../../../controller/sesion.class.php");
	require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$sesion = new sesion();
		$dataSesion = $sesion->get('dataSesion');
		$ConnectionDB = new ConnectionDB();
		$pdo = $ConnectionDB->connect();
		$pdo->beginTransaction();
		$validacionUsuario = new ValidacionUsuario();

		if (isset($_POST["csrf"]) && hash_equals($_SESSION["token_csrf"],$_POST["csrf"])) {
			$usr_cedula = cleanData("siLimite",13,"noMayuscula",$_POST["usr_cod_usuario"]);
			$usr_nombre_1 = cleanData("siLimite",15,"noMayuscula",$_POST["usr_nombre_1"]);
			$usr_nombre_2 = cleanData("siLimite",15,"noMayuscula",$_POST["usr_nombre_2"]);
			$usr_apellido_1 = cleanData("siLimite",15,"noMayuscula",$_POST["usr_apellido_1"]);
			$usr_apellido_2 = cleanData("siLimite",15,"noMayuscula",$_POST["usr_apellido_2"]);
			$usr_correo = strtolower(cleanData("siLimite",60,"noMayuscula",$_POST["usr_correo"]));

			$data_fast = 0;
			if ( strlen($usr_cedula) >= 1) {
				$data_fast += 1;
			}
			if ( strlen($usr_nombre_1) >= 3) {
				$data_fast += 1;
			}
			if ( strlen($usr_nombre_2) >= 2) {
				$data_fast += 1;
			}
			if ( strlen($usr_apellido_1) >= 3) {
				$data_fast += 1;
			}
			if ( strlen($usr_correo) >= 6) {
				$data_fast += 1;
			}

			if ($data_fast < 5) {
				$data_result["message"] = "errorCriterios";
				$data_result["numLineaCodigo"] = __LINE__;
				echo json_encode($data_result);
			}
			else {

				$tokenAsignado = $usr_cedula.$fechaActual_3;

				$sql_1="INSERT INTO dct_sistema_tbl_token(tok_token,tok_cedula,tok_fecha,tok_estado,tok_tipo,tok_usuario_creacion,tok_fecha_creacion,tok_ip_creacion) 
									VALUES (:tok_token,:tok_cedula,now(),1,'ACTIVACION',:tok_usuario_creacion,now(),:tok_ip_creacion);";
		    $query_1=$pdo->prepare($sql_1);
		    $query_1->bindValue(':tok_token', $validacionUsuario->setPassword($tokenAsignado));
		    $query_1->bindValue(':tok_cedula', $usr_cedula);
		    $query_1->bindValue(':tok_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_1->bindValue(':tok_ip_creacion',getRealIP(),PDO::PARAM_STR);
		    $query_1->execute();

				$sql="INSERT INTO dct_sistema_tbl_usuario(usr_cod_usuario, usr_nombre_1, usr_nombre_2, usr_apellido_1, usr_apellido_2, usr_contrasenia, 
					usr_logeado, usr_estado, usr_correo, usr_id_rol, usr_estado_contrasenia, usr_id_empresa, usr_fecha_cambio_contrasenia, 
					usr_contador_error_contrasenia, usr_expiro_contrasenia, usr_usuario_creacion, usr_fecha_creacion, usr_ip_creacion, usr_estado_correo)
			    	VALUES (:usr_cod_usuario, :usr_nombre_1, :usr_nombre_2, :usr_apellido_1, :usr_apellido_2, :usr_contrasenia, 0, 1, 
			    		:usr_correo, :usr_id_rol, 1, :usr_id_empresa, :usr_fecha_cambio_contrasenia, 0, 1, :usr_usuario_creacion, now(), :usr_ip_creacion, 0);";
		    $query=$pdo->prepare($sql);
		    $query->bindValue(':usr_cod_usuario',$usr_cedula,PDO::PARAM_INT);
		    $query->bindValue(':usr_nombre_1',$usr_nombre_1,PDO::PARAM_STR);
		    $query->bindValue(':usr_nombre_2',$usr_nombre_2,PDO::PARAM_STR);
		    $query->bindValue(':usr_apellido_1',$usr_apellido_1,PDO::PARAM_STR);
		    $query->bindValue(':usr_apellido_2',$usr_apellido_2,PDO::PARAM_STR); 
		    $query->bindValue(':usr_contrasenia',$validacionUsuario->setPassword($usr_cedula),PDO::PARAM_STR); 
		    $query->bindValue(':usr_correo',$usr_correo,PDO::PARAM_STR); 
		    $query->bindValue(':usr_id_rol',cleanData("noLimite",0,"noMayuscula",$_POST["usr_id_rol"]),PDO::PARAM_INT); 
		    $query->bindValue(':usr_id_empresa',cleanData("noLimite",0,"noMayuscula",$_POST["usr_id_empresa"]),PDO::PARAM_INT); 
		    $query->bindValue(':usr_fecha_cambio_contrasenia',$fechaActual_4,PDO::PARAM_STR);
		    $query->bindValue(':usr_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query->bindValue(':usr_ip_creacion',getRealIP(),PDO::PARAM_STR);
		    $query->execute();

				if($query && $query_1) {

					$pdo->commit();
					$data_result["message"] = "saveOK";
					$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
			    $data_result["dataModal_2"] = 'Información';
			    $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-dismiss="modal">Cerrar</button>';

			    $arrayMail["subject"] = "👋 Bienvenido a su Nuestros Sistema";
			    $arrayMail["paraCorreo"] = $usr_correo;
			    $arrayMail["nombres"] = $usr_nombre_1." ".$usr_nombre_2." ".$usr_apellido_1." ".$usr_apellido_2;
			    $arrayMail["linkReset"] = $validacionUsuario->setPassword($tokenAsignado);
			    $arrayMail["archivoHTML"] = "../../mail/htmlBienvenida.php";
			    $arrayMail["host"] = $host;
			    $arrayMail["tipoCorreo"] = "htmlBienvenida";
			    $phpMail = phpMailer($arrayMail);

			    if ($phpMail) {
			      $data_result["dataModal_3"] = 'El registro fue guardado correctamente, revisa tu correo ya que te enviamos un correo de bienvenida.';
			    }
			    else {
			      $data_result["dataModal_3"] = 'El registro fue guardado correctamente.';
			    }
			    $data_result["numLineaCodigo"] = __LINE__;
				echo json_encode($data_result);
						
				}
				else {
					$pdo->rollBack();
					$data_result["message"] = "saveError";
					$data_result["numLineaCodigo"] = __LINE__;
					echo json_encode($data_result);
				}
			}
		}
		else {
			$data_result["message"] = "token_csrf_error";
			$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
			$data_result["dataModal_2"] = 'Información';
			$data_result["dataModal_3"] = "Token de seguridad inválido, refresque el aplicativo WEB.";
			$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
			$data_result["numLineaCodigo"] = __LINE__;
			echo json_encode($data_result);
		}
			
	} catch (Exception $ex) {
		$data_result["message"] = "salidaExcepcionCatch";
		$data_result["codError"] = $ex->getCode();
		$data_result["msjError"] = $ex->getMessage();
		$data_result["numLineaCodigo"] = __LINE__;
		echo json_encode($data_result);
	}
?>