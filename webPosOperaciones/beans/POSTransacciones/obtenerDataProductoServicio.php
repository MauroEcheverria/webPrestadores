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

    $sql_seg_fas="SELECT fd.fdt_id_factura_detalle, 
                  fd.prs_id_prod_serv, 
                  fd.fdt_cantidad, 
                  ps.prs_codigo_item, 
                  ps.prs_descripcion_item, 
                  ps.prs_valor_unitario, 
                  ps.prs_descuento,
                  ps.prs_iva_cod_tarifa,
                  IFNULL((SELECT trf_porcentaje FROM dct_pos_tbl_tarifa_impuesto WHERE imp_codigo = ps.prs_iva_cod_impuesto AND trf_codigo = ps.prs_iva_cod_tarifa),0) trf_porcentaje_iva,
                  IFNULL((SELECT trf_porcentaje FROM dct_pos_tbl_tarifa_impuesto WHERE imp_codigo = ps.prs_ice_cod_impuesto AND trf_codigo = ps.prs_ice_cod_tarifa),0) trf_porcentaje_ice,
                  IFNULL((SELECT trf_porcentaje FROM dct_pos_tbl_tarifa_impuesto WHERE imp_codigo = ps.prs_irbpnr_cod_impuesto AND trf_codigo = ps.prs_irbpnr_cod_tarifa),0) trf_porcentaje_irbpnr
                  FROM dct_pos_tbl_factura_detalle fd, dct_pos_tbl_producto_servicio ps
                  WHERE fd.prs_id_prod_serv = ps.prs_id_prod_serv
                  AND fd.ftr_id_factura_transaccion = :ftr_id_factura_transaccion
                  AND fd.fdt_estado = 1
                  AND fd.fdt_estado_transaccion = 'TMP'
                  AND ps.emp_id_empresa = :emp_id_empresa
                  ORDER BY fd.fdt_fecha_creacion DESC";
    $query_seg_fas=$pdo->prepare($sql_seg_fas);
    $query_seg_fas->bindValue(':ftr_id_factura_transaccion',$_SESSION["id_factura_transaccion"],PDO::PARAM_INT);
    $query_seg_fas->bindValue(':emp_id_empresa',$dataSesion["usr_id_empresa"],PDO::PARAM_INT);
    $query_seg_fas->execute();
    $row_seg_fas = $query_seg_fas->fetchAll();

    $pos_trans_descuento = 0;
    $pos_trans_sub_total = 0;
    $pos_total_descuento = 0;
    $pos_total_sub_total = 0;

    $pos_base_imp_iva_cero = 0;
    $pos_base_imp_iva_12 = 0;
    $pos_base_imp_iva_14 = 0;
    $pos_base_imp_iva_no_sujeto = 0;
    $pos_base_imp_iva_exento = 0;
    $pos_base_imp_iva_diferenciado = 0;

    $pos_calc_iva_12 = 0;
    $pos_calc_iva_14 = 0;
    $pos_calc_iva_diferenciado = 0;

    $data_tabla = '<table class="table table-striped dct_table"><tr><th style="text-align:center;">Código Ítem</th><th style="text-align:center;">Descripción</th><th style="text-align:center;">Cantidad</th><th style="text-align:center;">Precio Unitadrio</th><th style="text-align:center;">Descuento</th><th style="text-align:center;">Sub Total</th><th style="text-align:center;">Acciones</th></tr>';
    foreach ($row_seg_fas as $row_seg_fas) {

      /* Descuentos */
      $pos_trans_descuento = $row_seg_fas["prs_valor_unitario"] * $row_seg_fas["prs_descuento"] / 100;
      $pos_total_descuento += $pos_trans_descuento;
      $pos_trans_sub_total = ($row_seg_fas["prs_valor_unitario"] - $pos_trans_descuento) * $row_seg_fas["fdt_cantidad"];
      $pos_total_sub_total += $pos_trans_sub_total;

      /* Diferenciacion IVA */
      switch ($row_seg_fas["prs_iva_cod_tarifa"]) {
        case '0':
          $pos_base_imp_iva_cero += $pos_trans_sub_total;
          break;
        case '2':
          $pos_base_imp_iva_12 += $pos_trans_sub_total;
          $pos_calc_iva_12 += $pos_trans_sub_total * $row_seg_fas["trf_porcentaje_iva"] / 100;
          break;
        case '3':
          $pos_base_imp_iva_14 += $pos_trans_sub_total;
          $pos_calc_iva_14 += $pos_trans_sub_total * $row_seg_fas["trf_porcentaje_iva"] / 100;
          break;
        case '6':
          $pos_base_imp_iva_no_sujeto += $pos_trans_sub_total;
          break;
        case '7':
          $pos_base_imp_iva_exento += $pos_trans_sub_total;
          break;
        case '8':
          $pos_base_imp_iva_diferenciado += $pos_trans_sub_total;
          $pos_calc_iva_diferenciado += $pos_trans_sub_total * $row_seg_fas["trf_porcentaje_iva"] / 100;
          break;
      }

      $data_tabla .= '<tr>';
      $data_tabla .= '<td align="center">'.$row_seg_fas["prs_codigo_item"].'</td>';
      $data_tabla .= '<td>'.$row_seg_fas["prs_descripcion_item"].'</td>';
      $data_tabla .= '<td align="center"><input type="number" class="form-control fdt_cantidad_tbl" name="fdt_cantidad_tbl" id="itemCant_'.$row_seg_fas["fdt_id_factura_detalle"].'" value="'.$row_seg_fas["fdt_cantidad"].'"></td>';
      $data_tabla .= '<td align="right">'.$row_seg_fas["prs_valor_unitario"].'</td>';
      $data_tabla .= '<td align="right">'.$row_seg_fas["prs_descuento"].'%</td>';
      $data_tabla .= '<td align="right">'.$pos_trans_sub_total.'</td>';
      $data_tabla .= '<td align="center"><div class="btn-group btn-group-sm"><a href="#" class="btn btn-info refDetalleItemProceso" title="Detalle Ítem" id="item_detalle_'.$row_seg_fas["fdt_id_factura_detalle"].'"><i class="fas fa-eye"></i><span class="solo_main">'.$row_seg_fas["fdt_id_factura_detalle"].'</span></a><a href="#" class="btn btn-danger refDescartarItemProceso" title="Descatar Ítem" id="item_descartar_'.$row_seg_fas["fdt_id_factura_detalle"].'"><i class="fas fa-trash"></i><span class="solo_main">'.$row_seg_fas["fdt_id_factura_detalle"].'</span></a></div></td>';    
      $data_tabla .= '</tr>';
    }
    $data_tabla .= '</table>';
    
    if($query_seg_fas) {

      $data_result["pos_base_imp_12"] = $pos_base_imp_iva_12;
      $data_result["pos_base_imp_14"] = $pos_base_imp_iva_14;
      $data_result["pos_base_imp_diff"] = $pos_base_imp_iva_diferenciado;
      $data_result["pos_base_imp_iva_cero"] = $pos_base_imp_iva_cero;
      $data_result["pos_base_imp_iva_no_sujeto"] = $pos_base_imp_iva_no_sujeto;
      $data_result["pos_base_imp_iva_exento"] = $pos_base_imp_iva_exento;
      $data_result["pos_total_iva_diff"] = $pos_calc_iva_12 + $pos_calc_iva_14 + $pos_calc_iva_diferenciado;
      $data_result["pos_total_ice"] = 0;
      $data_result["pos_total_irbpnr"] = 0;
      $data_result["pos_total_descuento"] = $pos_total_descuento;
      $data_result["pos_total_sub_total"] = $pos_total_sub_total;
      $data_result["pos_total_comprobante"] = $pos_total_sub_total;

      $data_result["data_tabla"] = $data_tabla;
      $data_result["message"] = "saveOK";
      echo json_encode($data_result);
    }
    else {
      $data_result["message"] = "saveError";
      echo json_encode($data_result);
    } 
      
  } catch (\PDOException $e) {
      throw $e;
      echo $e->getMessage();
  }
?>