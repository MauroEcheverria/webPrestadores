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

		$sql="SELECT prs_id_prod_serv 
          FROM dct_pos_tbl_factura_detalle 
          WHERE fdt_estado = 1
          AND ftr_id_factura_transaccion = :ftr_id_factura_transaccion;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':ftr_id_factura_transaccion',$_SESSION["id_factura_transaccion"],PDO::PARAM_INT); 
    $query->execute();
    $row = $query->fetchAll();

    $cont=0;
		foreach ($row as $row) {
			if ($row["prs_id_prod_serv"] == $_POST["prs_id_prod_serv"]) {$cont++;}
		}
		if ($cont==0) {
      $sql="INSERT INTO dct_pos_tbl_factura_detalle(ftr_id_factura_transaccion, prs_id_prod_serv, fdt_cantidad, fdt_estado_transaccion, fdt_estado, fdt_usuario_creacion, fdt_fecha_creacion, fdt_ip_creacion)
		    	VALUES (:ftr_id_factura_transaccion, :prs_id_prod_serv, :fdt_cantidad, 'TMP', 1, :fdt_usuario_creacion, now(), :fdt_ip_creacion);";
	    $query=$pdo->prepare($sql);
	    $query->bindValue(':ftr_id_factura_transaccion',$_SESSION["id_factura_transaccion"],PDO::PARAM_INT);
	    $query->bindValue(':prs_id_prod_serv',cleanData("noLimite",0,"noMayuscula",$_POST["prs_id_prod_serv"]),PDO::PARAM_INT);
	    $query->bindValue(':fdt_cantidad',cleanData("noLimite",0,"noMayuscula",$_POST["fdt_cantidad"]),PDO::PARAM_INT);
	    $query->bindValue(':fdt_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
	    $query->bindValue(':fdt_ip_creacion',getRealIP(),PDO::PARAM_STR);
	    $query->execute();

			if($query) {
				$pdo->commit();
				$data_result["message"] = "saveOK";
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

			$sql_item="SELECT fdt_id_factura_detalle 
	          FROM dct_pos_tbl_factura_detalle 
	          WHERE fdt_estado = 1
	          AND ftr_id_factura_transaccion = :ftr_id_factura_transaccion
	          AND prs_id_prod_serv = :prs_id_prod_serv;";
	    $query_item=$pdo->prepare($sql_item);
	    $query_item->bindValue(':ftr_id_factura_transaccion',$_SESSION["id_factura_transaccion"],PDO::PARAM_INT);
	    $query_item->bindValue(':prs_id_prod_serv',cleanData("noLimite",0,"noMayuscula",$_POST["prs_id_prod_serv"]),PDO::PARAM_INT);
	    $query_item->execute();
	    $row_item = $query_item->fetch(\PDO::FETCH_ASSOC);

     	$pdo->rollBack();
			$data_result["message"] = "itemRegistrado";
			$data_result["id_item"] = $row_item["fdt_id_factura_detalle"];
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