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
		
		$sql="INSERT INTO dct_pos_tbl_factura_detalle(ftr_id_factura_transaccion, prs_id_prod_serv, fdt_cantidad, fdt_estado_transaccion, fdt_estado, fdt_usuario_creacion, fdt_fecha_creacion, fdt_ip_creacion)
	    	VALUES (:ftr_id_factura_transaccion, :prs_id_prod_serv, :fdt_cantidad, 'TMP', 1, :fdt_usuario_creacion, now(), :fdt_ip_creacion);";
    $query=$pdo->prepare($sql);
    $query->bindValue(':ftr_id_factura_transaccion',$_SESSION["id_factura_transaccion"],PDO::PARAM_INT);
    $query->bindValue(':prs_id_prod_serv',$_SESSION["prs_id_prod_serv"],PDO::PARAM_INT);
    $query->bindValue(':fdt_cantidad',cleanData("noLimite",0,"noMayuscula",$_POST["fdt_cantidad"]),PDO::PARAM_INT);
    $query->bindValue(':fdt_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
    $query->bindValue(':fdt_ip_creacion',getRealIP(),PDO::PARAM_STR);
    $query->execute();

		if($query) {
			$pdo->commit();
			$data_result["message"] = "saveOK";
			$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
			$data_result["dataModal_2"] = 'Información';
			$data_result["dataModal_3"] = 'Ítem registado de manera correcta.';
			$data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-dismiss="modal">Cerrar</button>';
	    $data_result["numLineaCodigo"] = __LINE__;
			echo json_encode($data_result);	
		}
		else {
			$pdo->rollBack();
			$data_result["message"] = "saveError";
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