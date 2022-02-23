<?php 
	require_once("../../controller/sesion.class.php");
	require_once("../../controller/misFunciones.php");
	require_once("../../dctDatabase/Connection.php");
	require_once("../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$sesion = new sesion();
		$userSystem = $sesion->get("userSystem");
		if( $userSystem == false ) {	
			header("Location: ../../index.php");
		}
		else {
			$ConnectionDB = new ConnectionDB();
			$pdo = $ConnectionDB->connect();
			$pdo->beginTransaction();
	    $sql="UPDATE dct_sistema_tbl_usuario
						SET usr_logeado=FALSE,
						usr_ip_pc_acceso=NULL,
						usr_fecha_acceso=NULL,
						usr_contador_error_contrasenia=0
						WHERE usr_cod_usuario = :usr_cod_usuario;";
			$query=$pdo->prepare($sql);
			$query->bindValue(':usr_cod_usuario',$userSystem,PDO::PARAM_INT);
			$query->execute();
	    if ($query) {
	    	$sesion->termina_sesion();
	    	$pdo->commit();
	    	header("location: ../../sesionCerrada/");
	    }
	    else {
		  	$pdo->rollBack();
		  }
		}	
	} catch (\PDOException $e) {
    echo $e->getMessage();
	}
?>