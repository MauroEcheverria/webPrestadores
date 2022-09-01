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
    $query->bindValue(':usr_cod_usuario',$dataSesion["cod_system_user"],PDO::PARAM_INT);
    $query->bindValue(':emp_id_empresa',$dataSesion["usr_id_empresa"],PDO::PARAM_INT);
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

    $sql_4="SELECT prs_id_prod_serv,prs_descripcion_item
				    FROM dct_pos_tbl_producto_servicio
				    WHERE prs_estado = 1
				    AND emp_id_empresa = :emp_id_empresa;";
    $query_4=$pdo->prepare($sql_4);
    $query_4->bindValue(':emp_id_empresa',cleanData("noLimite",0,"noMayuscula",$dataSesion["usr_id_empresa"]),PDO::PARAM_INT);
    $query_4->execute();
    $row_4 = $query_4->fetchAll();

    $rpta_4="<option value=''>Seleccione una opción</option>";
    foreach ($row_4 as $row_4) {
      $rpta_4.="<option value='".$row_4["prs_id_prod_serv"]."'>".$row_4["prs_descripcion_item"]."</option>";
    }
		
		$data_result["formas_pago"] = $rpta_2;
		$data_result["tipo_identificacion"] = $rpta_3;
		$data_result["productos_servicios"] = $rpta_4;
		if ( $query->rowCount() == 1 ) {
			$sql_seg_fas="SELECT fd.fdt_id_factura_detalle, fd.prs_id_prod_serv, fd.fdt_cantidad, ps.prs_codigo_item, 
	                  ps.prs_descripcion_item, ps.prs_valor_unitario, ps.prs_descuento, ps.prs_iva_cod_impuesto, ps.prs_iva_cod_tarifa, 
	                  ps.prs_ice_cod_impuesto, ps.prs_ice_cod_tarifa, ps.prs_irbpnr_cod_impuesto, ps.prs_irbpnr_cod_tarifa
	                  FROM dct_pos_tbl_factura_detalle fd, dct_pos_tbl_producto_servicio ps
	                  WHERE fd.prs_id_prod_serv = ps.prs_id_prod_serv
	                  AND fd.ftr_id_factura_transaccion = :ftr_id_factura_transaccion
	                  AND fd.fdt_estado = 1
	                  AND fd.fdt_estado_transaccion = 'TMP'
	                  AND ps.emp_id_empresa = :emp_id_empresa
	                  ORDER BY fd.fdt_fecha_creacion";
	    $query_seg_fas=$pdo->prepare($sql_seg_fas);
	    $query_seg_fas->bindValue(':ftr_id_factura_transaccion',$row["ftr_id_factura_transaccion"],PDO::PARAM_INT);
	    $query_seg_fas->bindValue(':emp_id_empresa',$dataSesion["usr_id_empresa"],PDO::PARAM_INT);
	    $query_seg_fas->execute();
	    $row_seg_fas = $query_seg_fas->fetchAll();

	    $data_tabla = '<table class="table table-striped dct_table"><tr><th style="text-align:center;">Código Ítem</th><th style="text-align:center;">Descripción</th><th style="text-align:center;">Cantidad</th><th style="text-align:center;">Precio Unitadrio</th><th style="text-align:center;">Sub Total</th><th style="text-align:center;">Acciones</th></tr>';
	    foreach ($row_seg_fas as $row_seg_fas) {
	      $data_tabla .= '<tr>';
	      $data_tabla .= '<td align="center">'.$row_seg_fas["prs_codigo_item"].'</td>';
	      $data_tabla .= '<td>'.$row_seg_fas["prs_descripcion_item"].'</td>';
	      $data_tabla .= '<td align="center">'.$row_seg_fas["fdt_cantidad"].'</td>';
	      $data_tabla .= '<td align="right">'.$row_seg_fas["prs_valor_unitario"].'</td>';
	      $data_tabla .= '<td align="right">'.($row_seg_fas["fdt_cantidad"] * $row_seg_fas["prs_valor_unitario"]) .'</td>';
	      $data_tabla .= '<td align="center"><div class="btn-group btn-group-sm"><a href="#" class="btn btn-info" title="Detalle Ítem" id="item_detalle_'.$row_seg_fas["fdt_id_factura_detalle"].'"><i class="fas fa-eye"></i></a><a href="#" class="btn btn-danger" title="Descatar Ítem" id="item_descartar_'.$row_seg_fas["fdt_id_factura_detalle"].'"><i class="fas fa-trash"></i></a></div></td>';    
	      $data_tabla .= '</tr>';
	    }
	    $data_tabla .= '</table>';

	    $data_result["data_tabla"] = $data_tabla;
			$data_result["data_row"] = $row;
			$data_result["message"] = "si_transaccion";
			$data_result["numLineaCodigo"] = __LINE__;
			$_SESSION["id_factura_transaccion"] = $row["ftr_id_factura_transaccion"];
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