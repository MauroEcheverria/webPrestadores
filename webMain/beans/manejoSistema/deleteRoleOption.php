<?php
	require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();
		$sql="UPDATE dct_sistema_tbl_rol_opcion
					SET rlo_estado = 'IN'
 			  	WHERE rlo_id_rol = :rlo_id_rol
 			  	AND rlo_id_opcion = :rlo_id_opcion
 			  	AND rlo_estado = 'AC';";
    $query=$pdo->prepare($sql);
    $query->bindValue(':rlo_id_rol', cleanData("noLimite",0,"noMayuscula",$_POST["sys_selec_roles"]),PDO::PARAM_INT); 
    $query->bindValue(':rlo_id_opcion', cleanData("noLimite",0,"noMayuscula",$_POST["sys_id_opt"]),PDO::PARAM_INT); 
    $query->execute();
		if($query) {
			$pdo->commit();
			$data_result["message"] = "saveOK";
			echo json_encode($data_result);
		}
		else {
			$pdo->rollBack();
			$data_result["message"] = "saveError";
			echo json_encode($data_result);
		}	
	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}
?>