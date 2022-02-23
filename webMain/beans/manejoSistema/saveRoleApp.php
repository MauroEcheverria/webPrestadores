<?php
	require_once("../../../controller/misFunciones.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

		foreach ($_POST["sys_selec_app"] as $selectedApp) {
			$sql="INSERT INTO dct_sistema_tbl_rol_aplicacion(rla_id_rol, rla_id_aplicacion, rla_estado)
		    		VALUES (:rla_id_rol, :rla_id_aplicacion, 'A');";
	    $query=$pdo->prepare($sql);
	    $query->bindValue(':rla_id_rol', cleanData("noLimite",0,"noMayuscula",$_POST["sys_selec_roles"]),PDO::PARAM_INT); 
	    $query->bindValue(':rla_id_aplicacion', cleanData("noLimite",0,"noMayuscula",$selectedApp),PDO::PARAM_INT);
	    $query->execute();
		}

		if($query) {
			$pdo->commit();
			$data_result["message"] = "saveOK";
			echo json_encode($data_result);
		}
		else {
			$data_result["message"] = "saveError";
			echo json_encode($data_result);
		}	
	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}
?>