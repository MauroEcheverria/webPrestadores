<?php
	require_once("../../../controller/misFunciones.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$ConnectionDB = new ConnectionDB();
		$pdo = $ConnectionDB->connect();
		$pdo->beginTransaction();			
		$validacionUsuario = new ValidacionUsuario();

		$tokenAsignado = cleanData("siLimite",13,"noMayuscula",$_POST["newCedula"]).$fechaActual_3;
		$usr_cedula = cleanData("siLimite",13,"noMayuscula",$_POST["newCedula"]);
		$usr_nombre_1 = cleanData("siLimite",15,"noMayuscula",$_POST["usr_nombre_1"]);
		$usr_nombre_2 = cleanData("siLimite",15,"noMayuscula",$_POST["usr_nombre_2"]);
		$usr_apellido_1 = cleanData("siLimite",15,"noMayuscula",$_POST["usr_apellido_1"]);
		$usr_apellido_2 = cleanData("siLimite",15,"noMayuscula",$_POST["usr_apellido_2"]);
		$usr_correo = strtolower(cleanData("siLimite",60,"noMayuscula",$_POST["newCorreo"]));
		$usr_nom_completos = $usr_nombre_1." ".$usr_nombre_2." ".$usr_apellido_1." ".$usr_apellido_2;

		$data_fast = 0;
		if ( strlen($usr_cedula) >= 1 && strlen($usr_cedula) <= 10) {
			$data_fast += 1;
		}
		if ( strlen($usr_nombre_1) >= 3 && strlen($usr_nombre_1) <= 48) {
			$data_fast += 1;
		}
		if ( strlen($usr_nombre_2) >= 2 && strlen($usr_nombre_2) <= 50) {
			$data_fast += 1;
		}
		if ( strlen($usr_apellido_1) >= 3 && strlen($usr_apellido_1) <= 48) {
			$data_fast += 1;
		}
		if ( strlen($usr_correo) >= 6 && strlen($usr_correo) <= 128) {
			$data_fast += 1;
		}

		if ($data_fast < 5) {
			$data_result["message"] = "errorCriterios";
			echo json_encode($data_result);
		}
		else {
			$sql_1="INSERT INTO dct_sistema_tbl_token(tok_token,tok_cedula,tok_fecha,tok_estado,tok_tipo)
		    		VALUES (:tok_token,:tok_cedula,now(),TRUE,'ACTIVACION');";
	    $query_1=$pdo->prepare($sql_1);
	    $query_1->bindValue(':tok_token',$validacionUsuario->setPassword($tokenAsignado),PDO::PARAM_STR);
	    $query_1->bindValue(':tok_cedula',cleanData("siLimite",15,"noMayuscula",$_POST["newCedula"]),PDO::PARAM_INT);
	    $query_1->execute();

			$sql="INSERT INTO dct_sistema_tbl_usuario(usr_cod_usuario, usr_nom_completos, usr_correo, usr_id_rol, usr_contrasenia, usr_logeado, usr_estado, usr_estado_contrasenia, usr_id_empresa, usr_expiro_contrasenia, usr_fecha_cambio_contrasenia, usr_contador_error_contrasenia,usr_usuario_creacion,usr_fecha_creacion,usr_ip_creacion, usr_nacimiento, usr_sexo,usr_nombre_1,usr_nombre_2,usr_apellido_1,usr_apellido_2)
		    	VALUES (:usr_cod_usuario, :usr_nom_completos, :usr_correo, :usr_id_rol, :usr_contrasenia, FALSE, FALSE, TRUE, :usr_id_empresa, FALSE, :usr_fecha_cambio_contrasenia, :usr_contador_error_contrasenia,:usr_usuario_creacion,now(),:usr_ip_creacion, :usr_nacimiento, :usr_sexo, :usr_nombre_1, :usr_nombre_2, :usr_apellido_1, :usr_apellido_2);";
	    $query=$pdo->prepare($sql);
	    $query->bindValue(':usr_cod_usuario',$usr_cedula,PDO::PARAM_INT);
	    $query->bindValue(':usr_nom_completos',$usr_nom_completos,PDO::PARAM_STR); 
	    $query->bindValue(':usr_correo',$usr_correo,PDO::PARAM_STR); 
	    $query->bindValue(':usr_id_rol',3);
	    $query->bindValue(':usr_contrasenia',$validacionUsuario->setPassword(cleanData("noLimite",0,"noMayuscula",$_POST["valPaciente"])),PDO::PARAM_STR); 
	    $query->bindValue(':usr_id_empresa',1); 
	    $query->bindValue(':usr_fecha_cambio_contrasenia',$fechaActual_4,PDO::PARAM_STR);
	    $query->bindValue(':usr_contador_error_contrasenia',0);
	    $query->bindValue(':usr_usuario_creacion',$usr_cedula,PDO::PARAM_INT);
	    $query->bindValue(':usr_ip_creacion',getRealIP(),PDO::PARAM_STR);
	    $query->bindValue(':usr_nacimiento',cleanData("noLimite",0,"noMayuscula",$_POST["newNacimiento"]),PDO::PARAM_STR);
	    $query->bindValue(':usr_sexo',cleanData("siLimite",1,"noMayuscula",$_POST["usr_sexo"]),PDO::PARAM_STR);
	    $query->bindValue(':usr_nombre_1',$usr_nombre_1,PDO::PARAM_STR);
	    $query->bindValue(':usr_nombre_2',$usr_nombre_2,PDO::PARAM_STR);
	    $query->bindValue(':usr_apellido_1',$usr_apellido_1,PDO::PARAM_STR);
	    $query->bindValue(':usr_apellido_2',$usr_apellido_2,PDO::PARAM_STR); 
	    $query->execute();

	    $sql_2="INSERT INTO dct_salud_tbl_paciente(pct_cedula, pct_nom_completos, pct_fecha_nacimiento, pct_sexo, pct_estado_civil, pct_instruccion, pct_tipo_sangre, pct_telefono, pct_provincia, pct_canton, pct_parroquia, pct_direccion, pct_referencia, usr_usuario_creacion, usr_fecha_creacion, usr_ip_creacion, pct_datos_personales, pct_ante_familiares, pct_prefijo)
		    	VALUES (:pct_cedula, :pct_nom_completos, :pct_fecha_nacimiento, :pct_sexo, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, :usr_usuario_creacion, now(), :usr_ip_creacion, 'I', 'I', '593');";
	    $query_2=$pdo->prepare($sql_2);
	    $query_2->bindValue(':pct_cedula',$usr_cedula,PDO::PARAM_INT);
	    $query_2->bindValue(':pct_nom_completos', $usr_nom_completos,PDO::PARAM_STR); 
	    $query_2->bindValue(':pct_fecha_nacimiento', cleanData("noLimite",0,"noMayuscula",$_POST["newNacimiento"]),PDO::PARAM_STR);
	    $query_2->bindValue(':pct_sexo', cleanData("siLimite",1,"noMayuscula",$_POST["usr_sexo"]),PDO::PARAM_STR); 
	    $query_2->bindValue(':usr_usuario_creacion', $usr_cedula,PDO::PARAM_INT);
	    $query_2->bindValue(':usr_ip_creacion', getRealIP(),PDO::PARAM_STR);
	    $query_2->execute();

			if($query && $query_2) {

				$arrayMail["subject"] = "Link para activar activación de cuenta.";
		    $arrayMail["paraCorreo"] = $usr_correo;
		    $arrayMail["nombres"] = $usr_nom_completos;
		    $arrayMail["linkReset"] = $validacionUsuario->setPassword($tokenAsignado);
		    $arrayMail["archivoHTML"] = "../../mail/htmlActivarCuenta.php";
		    $arrayMail["tipoCorreo"] = "htmlActivarCuenta";
		    $phpMail = phpMailer($arrayMail);

		    if ($phpMail) {
		    	$correoEnviado = "SI";
		    	$pdo->commit();
					$data_result["message"] = "saveOK";
					echo json_encode($data_result);
		    }
		    else {
		    	$pdo->rollBack();
					$data_result["message"] = "coreoNoEnviado";
					echo json_encode($data_result);
		    }	
			}
			else {
				$pdo->rollBack();
				$data_result["message"] = "saveError";
				echo json_encode($data_result);
			}
		}
	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}
?>