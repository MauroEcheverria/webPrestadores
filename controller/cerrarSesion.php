<?php 
	require_once("../controller/sesion.class.php");
	require_once("../controller/funcionesCore.php");
	require_once("../dctDatabase/Connection.php");
	require_once("../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$sesion = new sesion();
		$userSystem = $sesion->get("userSystem");
		if( $userSystem == false ) {	
			header("Location: ../index.php");
		}
		else {
			$ConnectionDB = new ConnectionDB();
			$pdo = $ConnectionDB->connect();
			$pdo->beginTransaction();
	    $sql="UPDATE dct_sistema_tbl_usuario
						SET usr_logeado=0,
						usr_ip_pc_acceso=NULL,
						usr_fecha_acceso=NULL,
						usr_contador_error_contrasenia=0
						WHERE usr_cod_usuario = :usr_cod_usuario;";
			$query=$pdo->prepare($sql);
			$query->bindValue(':usr_cod_usuario',$userSystem,PDO::PARAM_INT);
			$query->execute();
	    if ($query) {
        $url_actual = $sesion->get("linkTemp");
	    	$sesion->termina_sesion();
	    	$pdo->commit();
        $url = new sesion();
        $url->set("linkTemp",$url_actual);
	    	header("location: ../");
	    }
	    else {
		  	$pdo->rollBack();
		  }
		}	
	} catch (Exception $ex) {
		$data_result["message"] = "salidaExcepcionCatch";
		$data_result["codError"] = $ex->getCode();
		$data_result["msjError"] = $ex->getMessage();
		$data_result["numLineaCodigo"] = __LINE__;
		echo json_encode($data_result);
	}
?>