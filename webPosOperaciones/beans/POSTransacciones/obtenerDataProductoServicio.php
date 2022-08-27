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

    $sql_seg_fas="SELECT fd.fdt_id_factura_detalle, fd.prs_id_prod_serv, fd.fdt_cantidad, ps.prs_codigo_item, 
                  ps.prs_descripcion_item, ps.prs_valor_unitario, ps.prs_descuento, ps.prs_iva_cod_impuesto, ps.prs_iva_cod_tarifa, 
                  ps.prs_ice_cod_impuesto, ps.prs_ice_cod_tarifa, ps.prs_irbpnr_cod_impuesto, ps.prs_irbpnr_cod_tarifa
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

    $posTransComprobante = 0;
    $posTransDescuento = 0;
    $posTransSubTotal = 0;
    $posTransIvaCero = 0;
    $posTransIvaDiffCero = 0;
    $posTransIce = 0;
    $posTransIrbpnr = 0;

    $posTotalComprobante = 0;
    $posTotalDescuento = 0;
    $posTotalSubTotal = 0;
    $posTotalIvaCero = 0;
    $posTotalIvaDiffCero = 0;
    $posTotalIce = 0;
    $posTotalIrbpnr = 0;

    $data_tabla = '<table class="table table-striped dct_table"><tr><th style="text-align:center;">Código Ítem</th><th style="text-align:center;">Descripción</th><th style="text-align:center;">Cantidad</th><th style="text-align:center;">Precio Unitadrio</th><th style="text-align:center;">Sub Total</th><th style="text-align:center;">Acciones</th></tr>';
    foreach ($row_seg_fas as $row_seg_fas) {

      if ($row_seg_fas["prs_descuento"] >= 0) {
        $posTransDescuento = $row_seg_fas["prs_valor_unitario"] * $row_seg_fas["prs_descuento"] / 100;
        $posTotalDescuento += $posTransDescuento;
        $posTransSubTotal = $row_seg_fas["prs_valor_unitario"] - $posTransDescuento;
        $posTotalSubTotal += $posTransSubTotal;
      }
      else {
        $posTotalDescuento += $row_seg_fas["prs_descuento"];
        $posTotalSubTotal += $row_seg_fas["prs_valor_unitario"];
      }

      $data_tabla .= '<tr>';
      $data_tabla .= '<td align="center">'.$row_seg_fas["prs_codigo_item"].'</td>';
      $data_tabla .= '<td>'.$row_seg_fas["prs_descripcion_item"].'</td>';
      $data_tabla .= '<td align="center">'.$row_seg_fas["fdt_cantidad"].'</td>';
      $data_tabla .= '<td align="right">'.$row_seg_fas["prs_valor_unitario"].'</td>';
      $data_tabla .= '<td align="right">'.($row_seg_fas["fdt_cantidad"] * $row_seg_fas["prs_valor_unitario"]) .'</td>';
      $data_tabla .= '<td align="center"><div class="btn-group btn-group-sm"><a href="#" class="btn btn-info refDetalleItemProceso" title="Detalle Ítem" id="item_detalle_'.$row_seg_fas["fdt_id_factura_detalle"].'"><i class="fas fa-eye"></i><span class="solo_main">'.$row_seg_fas["fdt_id_factura_detalle"].'</span></a><a href="#" class="btn btn-danger refDescartarItemProceso" title="Descatar Ítem" id="item_descartar_'.$row_seg_fas["fdt_id_factura_detalle"].'"><i class="fas fa-trash"></i><span class="solo_main">'.$row_seg_fas["fdt_id_factura_detalle"].'</span></a></div></td>';    
      $data_tabla .= '</tr>';
    }
    $data_tabla .= '</table>';
    
    if($query_seg_fas) {
      $data_result["posTransComprobante"] = $posTransComprobante;
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