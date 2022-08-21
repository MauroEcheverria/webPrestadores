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

		$sql="SELECT ftr_id_factura_transaccion,emp_id_empresa,cli_id_cliente
					FROM dct_pos_tbl_factura_transaccion
					WHERE usr_cod_usuario = :usr_cod_usuario_1
					AND ftr_estado_transaccion = 'TMP'
					AND emp_id_empresa = (SELECT usr_id_empresa 
					FROM dct_sistema_tbl_usuario 
					WHERE usr_cod_usuario = :usr_cod_usuario_2);";
    $query=$pdo->prepare($sql);
    $query->bindValue(':usr_cod_usuario_1',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
    $query->bindValue(':usr_cod_usuario_2',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
    $query->execute();
		
		if ( $query->rowCount() == 0 ) {
			$data_result["message"] = "no_transaccion";
			$data_result["numLineaCodigo"] = __LINE__;
			echo json_encode($data_result);
		}
		else {
			$data_result["message"] = "si_transaccion";
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