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

		$sql="SELECT tr.ftr_id_factura_transaccion,tr.emp_id_empresa,tr.cli_id_cliente, tr.ftr_id_forma_pago,
					(SELECT cli_tipo_identificacion FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_tipo_identificacion,
					(SELECT cli_identificacion FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_identificacion,
					(SELECT CONCAT(IFNULL(cli_nombre_1,''),' ',IFNULL(cli_nombre_2,''),' ',IFNULL(cli_apellido_1,''),' ',IFNULL(cli_apellido_2,'')) FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_nombres,
					(SELECT cli_correo FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_correo,
					(SELECT cli_direccion FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_direccion,
					(SELECT cli_telefono FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_telefono,
					(SELECT cli_placa FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_placa
					FROM dct_pos_tbl_factura_transaccion tr
					WHERE tr.ftr_usuario_creacion = :usr_cod_usuario
					AND tr.ftr_estado_transaccion = 'TMP'
					AND tr.emp_id_empresa = :emp_id_empresa;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
    $query->bindValue(':emp_id_empresa',cleanData("noLimite",0,"noMayuscula",$dataSesion["usr_id_empresa"]),PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(\PDO::FETCH_ASSOC);

    $sql_2="SELECT ctg_key,ctg_descripcion
				    FROM dct_sistema_tbl_catalogo
				    WHERE ctg_estado = 1
				    AND ctg_tipo = 'PAGO';";
    $query_2=$pdo->prepare($sql_2);
    $query_2->execute();
    $row_2 = $query_2->fetchAll();

    $rpta_2="<option value=''>Seleccione una opción</option>";
    foreach ($row_2 as $row_2) {
      $rpta_2.="<option value='".$row_2["ctg_key"]."'>".$row_2["ctg_descripcion"]."</option>";
    }

    $sql_3="SELECT ctg_key,ctg_descripcion
				    FROM dct_sistema_tbl_catalogo
				    WHERE ctg_estado = 1
				    AND ctg_tipo = 'IDEN';";
    $query_3=$pdo->prepare($sql_3);
    $query_3->execute();
    $row_3 = $query_3->fetchAll();

    $rpta_3="<option value=''>Seleccione una opción</option>";
    foreach ($row_3 as $row_3) {
      $rpta_3.="<option value='".$row_3["ctg_key"]."'>".$row_3["ctg_descripcion"]."</option>";
    }
		
		$data_result["formas_pago"] = $rpta_2;
		$data_result["tipo_identificacion"] = $rpta_3;
		if ( $query->rowCount() == 1 ) {
			$_SESSION["id_factura_transaccion "] = $row["ftr_id_factura_transaccion"];
			$data_result["data_row"] = $row;
			$data_result["message"] = "si_transaccion";
			$data_result["numLineaCodigo"] = __LINE__;
		}
		else {
			$data_result["message"] = "no_transaccion";
			$data_result["numLineaCodigo"] = __LINE__;
		}	
		echo json_encode($data_result);

	} catch (Exception $ex) {
		$data_result["message"] = "salidaExcepcionCatch";
		$data_result["codError"] = $ex->getCode();
		$data_result["msjError"] = $ex->getMessage();
		$data_result["numLineaCodigo"] = __LINE__;
		echo json_encode($data_result);
	}
?>