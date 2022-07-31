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

		if (isset($_POST["csrf"]) && hash_equals($_SESSION["token_csrf"],$_POST["csrf"])) {
			$validacionUsuario = new ValidacionUsuario();
			$sql_3="UPDATE dct_sistema_tbl_usuario
	            SET usr_contrasenia = :usr_contrasenia, 
		            usr_estado_contrasenia=1, 
		            usr_expiro_contrasenia=1, 
		            usr_fecha_cambio_contrasenia=:usr_fecha_cambio_contrasenia, 
		            usr_contador_error_contrasenia=0 
	            WHERE usr_cod_usuario = :usr_cod_usuario;";
	    $query_3=$pdo->prepare($sql_3);
	    $query_3->bindValue(':usr_contrasenia',$validacionUsuario->setPassword(cleanData("siLimite",13,"noMayuscula",$_POST["editCedula"])),PDO::PARAM_STR);
	    $query_3->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$_POST["editCedula"]),PDO::PARAM_INT);
	    $query_3->bindValue(':usr_fecha_cambio_contrasenia',$fechaActual_1,PDO::PARAM_STR);
	    $query_3->execute();

	    if($query_3) {
	      $pdo->commit();
	      $data_result["message"] = "saveOK";
	      $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
	      $data_result["dataModal_2"] = 'Información';
	      $data_result["dataModal_3"] = 'El reseteo la contraseña de manera correcta.';
	      $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-dismiss="modal">Cerrar</button>';
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