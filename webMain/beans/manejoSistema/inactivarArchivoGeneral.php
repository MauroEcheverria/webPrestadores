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

		$sql="UPDATE dct_sistema_tbl_usuario_archivo
						SET arc_estado = 'I', arc_usuario_modificacion=:arc_usuario_modificacion,
						arc_fecha_modificacion=now(),arc_ip_modificacion=:arc_ip_modificacion
						WHERE arc_id_user_archivo = :arc_id_user_archivo";
    $query=$pdo->prepare($sql);
    $query->bindValue(':arc_id_user_archivo',cleanData("noLimite",0,"noMayuscula",$_POST["arc_id_user_archivo"]));
    $query->bindValue(':arc_usuario_modificacion', cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]));
    $query->bindValue(':arc_ip_modificacion', getRealIP());
    $query->execute();

    $sql_1 = "SELECT arc_nombre_file
              FROM dct_sistema_tbl_usuario_archivo
              WHERE arc_id_user_archivo = :arc_id_user_archivo";
    $query_1=$pdo->prepare($sql_1);
    $query_1->bindValue(':arc_id_user_archivo',cleanData("noLimite",0,"noMayuscula",$_POST["arc_id_user_archivo"]));
    $query_1->execute();
    $row_1 = $query_1->fetch(\PDO::FETCH_ASSOC);

		if($query) {
			$pdo->commit();

			$location = __DIR__."../../../uploadFile/".$row_1["arc_nombre_file"];
	    if(file_exists($location)){
				unlink($location);
			}

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