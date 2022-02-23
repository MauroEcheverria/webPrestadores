<?php 
	require_once("../../../controller/sesion.class.php");
	require_once("../../../controller/misFunciones.php");
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
					SET usr_logeado=TRUE,
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
	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}
?>