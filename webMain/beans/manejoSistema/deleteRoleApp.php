<?php
	require_once("../../../controller/misFunciones.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

		$sql="UPDATE dct_sistema_tbl_rol_aplicacion
					SET rla_estado = 'I'
 			  	WHERE rla_id_rol = :rla_id_rol
 			  	AND rla_id_aplicacion = :rla_id_aplicacion
 			  	AND rla_estado = 'A';";
    $query=$pdo->prepare($sql);
    $query->bindValue(':rla_id_rol',cleanData("noLimite",0,"noMayuscula",$_POST["sys_selec_roles"]),PDO::PARAM_INT); 
    $query->bindValue(':rla_id_aplicacion',cleanData("noLimite",0,"noMayuscula",$_POST["sys_id_app"]),PDO::PARAM_INT); 
    $query->execute();

    $sql="UPDATE dct_sistema_tbl_rol_opcion
    			SET rlo_estado = 'I'
					WHERE rlo_id_opcion IN (SELECT opc_id_opcion
					FROM dct_sistema_tbl_opcion op
					WHERE opc_id_aplicacion = :opc_id_aplicacion)
					AND rlo_id_rol = :rlo_id_rol
					AND rlo_estado = 'A';";
    $query=$pdo->prepare($sql);
    $query->bindValue(':rlo_id_rol',cleanData("noLimite",0,"noMayuscula",$_POST["sys_selec_roles"]),PDO::PARAM_INT); 
    $query->bindValue(':opc_id_aplicacion',cleanData("noLimite",0,"noMayuscula",$_POST["sys_id_app"]),PDO::PARAM_INT); 
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