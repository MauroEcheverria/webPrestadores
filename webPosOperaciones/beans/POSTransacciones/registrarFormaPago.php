<?php
  require_once("../../../controller/funcionesCore.php");
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

		$sql_2="UPDATE dct_pos_tbl_factura_transaccion 
						SET ftr_id_forma_pago = :ftr_id_forma_pago,
						ftr_usuario_modificacion = :ftr_usuario_modificacion,
						ftr_fecha_modificacion = now(),
						ftr_ip_modificacion = :ftr_ip_modificacion
						WHERE ftr_id_factura_transaccion = :ftr_id_factura_transaccion";
    $query_2=$pdo->prepare($sql_2);          
    $query_2->bindValue(':ftr_id_factura_transaccion',$_SESSION["id_factura_transaccion"],PDO::PARAM_INT);
    $query_2->bindValue(':ftr_id_forma_pago',cleanData("siLimite",2,"noMayuscula",$_POST["ftr_id_forma_pago"]),PDO::PARAM_INT); 
    $query_2->bindValue(':ftr_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
    $query_2->bindValue(':ftr_ip_modificacion',getRealIP(),PDO::PARAM_STR);
    $query_2->execute();

    if($query_2) {
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
   		
  } catch (Exception $ex) {
    $data_result["message"] = "salidaExcepcionCatch";
    $data_result["codError"] = $ex->getCode();
    $data_result["msjError"] = $ex->getMessage();
    $data_result["numLineaCodigo"] = __LINE__;
    echo json_encode($data_result);
  }
?> 