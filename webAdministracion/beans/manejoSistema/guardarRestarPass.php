<?php
	require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

    $cedOlvPass = cleanData("siLimite",13,"noMayuscula",$_POST["cedOlvPass"]); 

    $sql="SELECT um.usr_correo, CONCAT(um.usr_nombre_1,' ',um.usr_nombre_2,' ',um.usr_apellido_1,' ', um.usr_apellido_2) usr_nom_completos
          FROM dct_sistema_tbl_usuario um
          WHERE um.usr_cod_usuario = :usr_cod_usuario;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':usr_cod_usuario',$cedOlvPass,PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(\PDO::FETCH_ASSOC);

    $phpMail = false;
    $query_1 = false;
  	$existeCuenta = "NO";
  	$tokenActivo = "SI";
  	$correoEnviado = "NO";

    if ($query->rowCount() == 1) {
    	$existeCuenta = "SI";
    	$sql_2="SELECT TIMESTAMPDIFF(MINUTE,tok_fecha,now()) diff
						FROM dct_sistema_tbl_token
						WHERE tok_estado = 1
						AND TIMESTAMPDIFF(MINUTE,tok_fecha,now()) <= 10
						AND tok_cedula = :tok_cedula
						AND tok_tipo = 'RESETEO'";
	    $query_2=$pdo->prepare($sql_2);
	    $query_2->bindValue(':tok_cedula',$cedOlvPass,PDO::PARAM_INT);
	    $query_2->execute();

	    if ($query_2->rowCount() == 0) {
	    	$tokenActivo = "NO";
	    	$tokenAsignado = $cedOlvPass.$fechaActual_3;
	    	$validacionUsuario = new ValidacionUsuario();

	    	$sql_1="INSERT INTO dct_sistema_tbl_token(tok_token,tok_cedula,tok_fecha,tok_estado,tok_tipo)
			    		VALUES (:tok_token,:tok_cedula,now(),1,'RESETEO');";
		    $query_1=$pdo->prepare($sql_1);
		    $query_1->bindValue(':tok_token',$validacionUsuario->setPassword($tokenAsignado),PDO::PARAM_STR);
		    $query_1->bindValue(':tok_cedula',$cedOlvPass,PDO::PARAM_INT);
		    $query_1->execute();

		    $sql_3="UPDATE dct_sistema_tbl_usuario
		            SET usr_estado_contrasenia = 0
		            WHERE usr_cod_usuario = :usr_cod_usuario;";
		    $query_3=$pdo->prepare($sql_3);
		    $query_3->bindValue(':usr_cod_usuario',$cedOlvPass,PDO::PARAM_INT);
		    $query_3->execute();

		    $arrayMail["subject"] = "🔐 Link para restablecimiento de contraseña";
		    $arrayMail["paraCorreo"] = $row["usr_correo"];
		    $arrayMail["nombres"] = $row["usr_nom_completos"];
		    $arrayMail["linkReset"] = $validacionUsuario->setPassword($tokenAsignado);
		    $arrayMail["archivoHTML"] = "../../mail/htmlResetPass.php";
		    $arrayMail["tipoCorreo"] = "htmlResetPass";
		    $phpMail = phpMailer($arrayMail);

		    if ($phpMail) {
		    	$correoEnviado = "SI";
		    }
	    }	
    }
		if($query_1 && $query_3 && $phpMail) {
			$pdo->commit();
			$data_result["message"] = "saveOK";
			$data_result["existeCuenta"] = $existeCuenta;
			$data_result["tokenActivo"] = $tokenActivo;
			$data_result["correoEnviado"] = $correoEnviado;
			$data_result["usr_correo"] = $row["usr_correo"];
			echo json_encode($data_result);
		}
		else {
			$pdo->rollBack();
			$data_result["message"] = "saveOK";
			$data_result["existeCuenta"] = $existeCuenta;
			$data_result["tokenActivo"] = $tokenActivo;
			$data_result["correoEnviado"] = $correoEnviado;
			echo json_encode($data_result);
		}	
			
	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}
?>