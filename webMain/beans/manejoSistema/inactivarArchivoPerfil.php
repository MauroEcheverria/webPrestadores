<?php
	require_once("../../../controller/misFunciones.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
    require_once("../../../controller/sesion.class.php");
	app_error_reporting($app_error_reporting);
	try {
    $sesion = new sesion();
    $dataSesion = $sesion->get('dataSesion');
		$ConnectionDB = new ConnectionDB();
		$pdo = $ConnectionDB->connect();
		$pdo->beginTransaction();

		$sql_1 = "SELECT usp_nombre_file
              FROM dct_sistema_tbl_usuario_perfil
              WHERE usp_id_user_perfil = :usp_id_user_perfil";
    $query_1=$pdo->prepare($sql_1);
    $query_1->bindValue(':usp_id_user_perfil',cleanData("noLimite",0,"noMayuscula",$_POST["usp_id_user_perfil"]));
    $query_1->execute();
    $row_1 = $query_1->fetch(\PDO::FETCH_ASSOC);

    $location = __DIR__."../../../uploadFile/".$row_1["usp_nombre_file"];
    if(file_exists($location)){
			unlink($location);
		}

		$sql="UPDATE dct_sistema_tbl_usuario_perfil
						SET usp_nombre_file = '', usp_usuario_modificacion=:usp_usuario_modificacion,
						usp_fecha_modificacion=now(),usp_ip_modificacion=:usp_ip_modificacion
						WHERE usp_id_user_perfil = :usp_id_user_perfil";
    $query=$pdo->prepare($sql);
    $query->bindValue(':usp_id_user_perfil',cleanData("noLimite",0,"noMayuscula",$_POST["usp_id_user_perfil"]));
    $query->bindValue(':usp_usuario_modificacion', cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]));
    $query->bindValue(':usp_ip_modificacion', getRealIP());
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