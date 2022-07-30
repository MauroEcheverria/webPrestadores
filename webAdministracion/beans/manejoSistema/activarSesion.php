<?php 
	require_once("../../../controller/sesion.class.php");
	require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$sesion = new sesion();
		$userSystem = $sesion->get("userSystemOtraPC");
		$ConnectionDB = new ConnectionDB();
		$pdo = $ConnectionDB->connect();
		$pdo->beginTransaction();
		$sql="UPDATE dct_sistema_tbl_usuario
					SET usr_logeado='AC',
					usr_ip_pc_acceso=:usr_ip_pc_acceso,
					usr_fecha_acceso=:usr_fecha_acceso,
					usr_contador_error_contrasenia=0
					WHERE usr_cod_usuario = :usr_cod_usuario;";
		$query=$pdo->prepare($sql);
		$query->bindValue(':usr_ip_pc_acceso',getRealIP(),PDO::PARAM_STR);
		$query->bindValue(':usr_cod_usuario',$userSystem,PDO::PARAM_INT);
		$query->bindValue(':usr_fecha_acceso',$fechaActual_2,PDO::PARAM_STR);
		$query->execute();
		if ($query) {
			$pdo->commit();
			$nombres = new sesion();
			$nombres->set("userSystem",$userSystem);
			$nombres->set("timeoutSession",time());
			echo "<SCRIPT LANGUAGE='javascript'>location.href = '../../pages/bienvenido';</SCRIPT>";
		}
	    else {
		  	$pdo->rollBack();
		}
	} catch (Exception $ex) {
		$data_result["message"] = "salidaExcepcionCatch";
		$data_result["codError"] = $ex->getCode();
		$data_result["msjError"] = $ex->getMessage();
		$data_result["numLineaCodigo"] = __LINE__;
		echo json_encode($data_result);
	}
?>