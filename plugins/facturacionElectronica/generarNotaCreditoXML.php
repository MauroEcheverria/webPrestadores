<?php
class generarFacturaXML {
  public function funcGenerarFacturaXML($data_comprobante,$pdo) {

    $sql_comprobante_detalle="SELECT prs_id_prod_serv,fdt_cantidad
                              FROM dct_pos_tbl_factura_detalle 
                              WHERE ftr_id_factura_transaccion = :ftr_id_factura_transaccion;";
    $query_comprobante_detalle=$pdo->prepare($sql_comprobante_detalle);
    $query_comprobante_detalle->bindValue(':ftr_id_factura_transaccion',$data_comprobante["ftr_id_factura_transaccion"],PDO::PARAM_INT);
    $query_comprobante_detalle->execute();
    $row_comprobante_detalle = $query_comprobante_detalle->fetchAll();

    $xml_detalles = '';
    $xml_total_impuesto = '';
    
    $pos_trans_descuento = 0;
    $pos_trans_sub_total = 0;
    $pos_total_descuento = 0;
    $pos_total_sub_total = 0;

    $pos_base_imp_iva = 0;
    $pos_base_imp_iva_acum = 0;
    $pos_base_imp_iva_2_acum = 0;
    $pos_base_imp_iva_3_acum = 0;
    $pos_base_imp_iva_8_acum = 0;
    $pos_base_imp_2_acum = 0;
    $pos_base_imp_3_acum = 0;
    $pos_base_imp_8_acum = 0;
    $pos_base_imp_0_acum = 0;
    $pos_base_imp_6_acum = 0;
    $pos_base_imp_7_acum = 0;
    $pos_base_imp_diff_8_acum = 0;

    $pos_base_imp_ice = 0;
    $pos_base_imp_ice_acum = 0;
    $pos_base_imp_base_ice_acum = 0;
    $impuesto_ice = false;
    $impuesto_cabecera_ice = '';
    $array_ice = array();

    $pos_base_imp_irbpnr = 0;
    $pos_base_imp_irbpnr_acum = 0;
    $pos_base_imp_base_irbpnr_acum = 0;
    $impuesto_cabecera_irbpnr = '';
    $impuesto_irbpnr = false;

    $pos_total_comprobante = 0;

    foreach ($row_comprobante_detalle as $row_comprobante_detalle) {

      $sql_producto_detalle="SELECT ps.prs_codigo_item, 
                            ps.prs_descripcion_item, 
                            ps.prs_valor_unitario, 
                            ps.prs_descuento, 
                            ps.prs_iva_cod_impuesto, 
                            ps.prs_iva_cod_tarifa,
                            ps.prs_iva_dif_porc,
                            ps.prs_ice_cod_impuesto, 
                            ps.prs_ice_cod_tarifa, 
                            ps.prs_irbpnr_cod_impuesto,
                            ps.prs_irbpnr_cod_tarifa, 
                            ps.prs_estado,
                            ps.prs_det_nombre_1, 
                            ps.prs_det_valor_1, 
                            ps.prs_det_nombre_2, 
                            ps.prs_det_valor_2, 
                            ps.prs_det_nombre_3, 
                            ps.prs_det_valor_3,
                            IFNULL((SELECT trf_porcentaje FROM dct_pos_tbl_tarifa_impuesto WHERE imp_codigo = ps.prs_iva_cod_impuesto AND trf_codigo = ps.prs_iva_cod_tarifa),0) trf_porcentaje_iva,
                            IFNULL((SELECT trf_porcentaje FROM dct_pos_tbl_tarifa_impuesto WHERE imp_codigo = ps.prs_ice_cod_impuesto AND trf_codigo = ps.prs_ice_cod_tarifa),0) trf_porcentaje_ice,
                            IFNULL((SELECT trf_porcentaje FROM dct_pos_tbl_tarifa_impuesto WHERE imp_codigo = ps.prs_irbpnr_cod_impuesto AND trf_codigo = ps.prs_irbpnr_cod_tarifa),0) trf_porcentaje_irbpnr
                            FROM dct_pos_tbl_producto_servicio ps
                            WHERE ps.prs_id_prod_serv = :prs_id_prod_serv;";
      $query_producto_detalle=$pdo->prepare($sql_producto_detalle);
      $query_producto_detalle->bindValue(':prs_id_prod_serv',$row_comprobante_detalle["prs_id_prod_serv"],PDO::PARAM_INT);
      $query_producto_detalle->execute();
      $row_producto_detalle = $query_producto_detalle->fetch(\PDO::FETCH_ASSOC);

      $pos_trans_descuento = $row_producto_detalle["prs_valor_unitario"] * $row_comprobante_detalle["fdt_cantidad"] * $row_producto_detalle["prs_descuento"] / 100;
      $pos_total_descuento += $pos_trans_descuento;
      $pos_trans_sub_total = ($row_producto_detalle["prs_valor_unitario"] * $row_comprobante_detalle["fdt_cantidad"]) - $pos_trans_descuento;
      $pos_total_sub_total += $pos_trans_sub_total;

      $xml_detalles .= '<detalle>
                        <codigoPrincipal>'.$row_producto_detalle["prs_codigo_item"].'</codigoPrincipal>
                        <codigoAuxiliar>'.$row_producto_detalle["prs_codigo_item"].'</codigoAuxiliar>
                        <descripcion>'.$row_producto_detalle["prs_descripcion_item"].'</descripcion>
                        <cantidad>'.$row_comprobante_detalle["fdt_cantidad"].'</cantidad>
                        <precioUnitario>'.round($row_producto_detalle["prs_valor_unitario"],2).'</precioUnitario>            
                        <descuento>'.round($pos_trans_descuento,2).'</descuento>
                        <precioTotalSinImpuesto>'.round($pos_trans_sub_total,2).'</precioTotalSinImpuesto>
                        <detallesAdicionales>';
                          if( $row_producto_detalle["prs_det_nombre_1"] != "" && $row_producto_detalle["prs_det_valor_1"] != "" ) {
                            $xml_detalles .= '<detAdicional nombre="'.$row_producto_detalle["prs_det_nombre_1"].'" valor="'.$row_producto_detalle["prs_det_valor_1"].'"></detAdicional>';
                          }
                          if( $row_producto_detalle["prs_det_nombre_2"] != "" && $row_producto_detalle["prs_det_valor_2"] != "" ) {
                            $xml_detalles .= '<detAdicional nombre="'.$row_producto_detalle["prs_det_nombre_2"].'" valor="'.$row_producto_detalle["prs_det_valor_2"].'"></detAdicional>';
                          }
                          if( $row_producto_detalle["prs_det_nombre_3"] != "" && $row_producto_detalle["prs_det_valor_3"] != "" ) {
                            $xml_detalles .= '<detAdicional nombre="'.$row_producto_detalle["prs_det_nombre_3"].'" valor="'.$row_producto_detalle["prs_det_valor_3"].'"></detAdicional>';
                          }
      $xml_detalles .= '</detallesAdicionales>';

      $xml_detalles .= '<impuestos>';

      /* Diferenciacion IVA */
      switch ($row_producto_detalle["prs_iva_cod_tarifa"]) {
        case '2':
          $pos_base_imp_iva = $pos_trans_sub_total * $row_producto_detalle["trf_porcentaje_iva"] / 100;
          $xml_detalles .= '<impuesto>
                              <codigo>'.$row_producto_detalle["prs_iva_cod_impuesto"].'</codigo>
                              <codigoPorcentaje>'.$row_producto_detalle["prs_iva_cod_tarifa"].'</codigoPorcentaje>
                              <tarifa>'.$row_producto_detalle["trf_porcentaje_iva"].'</tarifa>
                              <baseImponible>'.round($pos_trans_sub_total,2).'</baseImponible>
                              <valor>'.round($pos_base_imp_iva,2).'</valor>
                            </impuesto>';
          $pos_base_imp_iva_acum += round($pos_base_imp_iva,2);
          $pos_base_imp_iva_2_acum += round($pos_base_imp_iva,2);
          $pos_base_imp_2_acum += round($pos_trans_sub_total,2);
          break;
        case '3':
          $pos_base_imp_iva = $pos_trans_sub_total * $row_producto_detalle["trf_porcentaje_iva"] / 100;
          $xml_detalles .= '<impuesto>
                              <codigo>'.$row_producto_detalle["prs_iva_cod_impuesto"].'</codigo>
                              <codigoPorcentaje>'.$row_producto_detalle["prs_iva_cod_tarifa"].'</codigoPorcentaje>
                              <tarifa>'.$row_producto_detalle["trf_porcentaje_iva"].'</tarifa>
                              <baseImponible>'.round($pos_trans_sub_total,2).'</baseImponible>
                              <valor>'.round($pos_base_imp_iva,2).'</valor>
                            </impuesto>';
          $pos_base_imp_iva_acum += round($pos_base_imp_iva,2);
          $pos_base_imp_iva_3_acum += round($pos_base_imp_iva,2);
          $pos_base_imp_3_acum += round($pos_trans_sub_total,2);
          break;
        case '8':
          $pos_base_imp_iva = $pos_trans_sub_total * $row_producto_detalle["prs_iva_dif_porc"] / 100;
          $xml_detalles .= '<impuesto>
                              <codigo>'.$row_producto_detalle["prs_iva_cod_impuesto"].'</codigo>
                              <codigoPorcentaje>'.$row_producto_detalle["prs_iva_cod_tarifa"].'</codigoPorcentaje>
                              <tarifa>'.$row_producto_detalle["prs_iva_dif_porc"].'</tarifa>
                              <baseImponible>'.round($pos_trans_sub_total,2).'</baseImponible>
                              <valor>'.round($pos_base_imp_iva,2).'</valor>
                            </impuesto>';
          $pos_base_imp_iva_acum += round($pos_base_imp_iva,2);
          $pos_base_imp_iva_8_acum += round($pos_base_imp_iva,2);
          $pos_base_imp_8_acum += round($pos_trans_sub_total,2);
          $pos_base_imp_diff_8_acum = $row_producto_detalle["prs_iva_dif_porc"];
          break;
        case '0':
          $xml_detalles .= '<impuesto>
                              <codigo>'.$row_producto_detalle["prs_iva_cod_impuesto"].'</codigo>
                              <codigoPorcentaje>'.$row_producto_detalle["prs_iva_cod_tarifa"].'</codigoPorcentaje>
                              <tarifa>'.$row_producto_detalle["trf_porcentaje_iva"].'</tarifa>
                              <baseImponible>'.round($pos_trans_sub_total,2).'</baseImponible>
                              <valor>0.00</valor>
                            </impuesto>';
          $pos_base_imp_0_acum += round($pos_trans_sub_total,2);
          break;
        case '6':
          $xml_detalles .= '<impuesto>
                              <codigo>'.$row_producto_detalle["prs_iva_cod_impuesto"].'</codigo>
                              <codigoPorcentaje>'.$row_producto_detalle["prs_iva_cod_tarifa"].'</codigoPorcentaje>
                              <tarifa>'.$row_producto_detalle["trf_porcentaje_iva"].'</tarifa>
                              <baseImponible>'.round($pos_trans_sub_total,2).'</baseImponible>
                              <valor>0.00</valor>
                            </impuesto>';
          $pos_base_imp_6_acum += round($pos_trans_sub_total,2);
          break;
        case '7':
          $xml_detalles .= '<impuesto>
                              <codigo>'.$row_producto_detalle["prs_iva_cod_impuesto"].'</codigo>
                              <codigoPorcentaje>'.$row_producto_detalle["prs_iva_cod_tarifa"].'</codigoPorcentaje>
                              <tarifa>'.$row_producto_detalle["trf_porcentaje_iva"].'</tarifa>
                              <baseImponible>'.round($pos_trans_sub_total,2).'</baseImponible>
                              <valor>0.00</valor>
                            </impuesto>';
          $pos_base_imp_7_acum += round($pos_trans_sub_total,2);
          break;
      }

      /* Diferenciacion ICE */
      if ($row_producto_detalle["prs_ice_cod_impuesto"] == 3) {
        $impuesto_ice = true;
        $pos_base_imp_ice = $pos_trans_sub_total * $row_producto_detalle["trf_porcentaje_ice"] / 100;
        $xml_detalles .= '<impuesto>
                            <codigo>'.$row_producto_detalle["prs_ice_cod_impuesto"].'</codigo>
                            <codigoPorcentaje>'.$row_producto_detalle["prs_ice_cod_tarifa"].'</codigoPorcentaje>
                            <tarifa>'.$row_producto_detalle["trf_porcentaje_ice"].'</tarifa>
                            <baseImponible>'.round($pos_trans_sub_total,2).'</baseImponible>
                            <valor>'.round($pos_base_imp_ice,2).'</valor>
                          </impuesto>';
        $pos_base_imp_ice_acum += round($pos_base_imp_ice,2);
        $pos_base_imp_base_ice_acum += round($pos_trans_sub_total,2);

        $array_ice[$row_producto_detalle["prs_ice_cod_tarifa"]]['base_imponible'] += round($pos_trans_sub_total,2);
        $array_ice[$row_producto_detalle["prs_ice_cod_tarifa"]]['valor'] += round($pos_base_imp_ice,2);
        $array_ice[$row_producto_detalle["prs_ice_cod_tarifa"]]['tarifa'] = $row_producto_detalle["trf_porcentaje_ice"];
      }

      /* Diferenciacion irbpnr */
      if ($row_producto_detalle["prs_irbpnr_cod_impuesto"] == 5) {
        $impuesto_irbpnr = true;
        $pos_base_imp_irbpnr = $pos_trans_sub_total * $row_producto_detalle["trf_porcentaje_irbpnr"] / 100;
        $xml_detalles .= '<impuesto>
                            <codigo>'.$row_producto_detalle["prs_irbpnr_cod_impuesto"].'</codigo>
                            <codigoPorcentaje>'.$row_producto_detalle["prs_irbpnr_cod_tarifa"].'</codigoPorcentaje>
                            <tarifa>'.$row_producto_detalle['trf_porcentaje_irbpnr'].'</tarifa>
                            <baseImponible>'.round($pos_trans_sub_total,2).'</baseImponible>
                            <valor>'.round($pos_base_imp_irbpnr,2).'</valor>
                          </impuesto>';
        $pos_base_imp_irbpnr_acum += round($pos_base_imp_irbpnr,2);
        $pos_base_imp_base_irbpnr_acum += round($pos_trans_sub_total,2);

        $impuesto_cabecera_irbpnr .= '<codigo>'.$row_producto_detalle["prs_irbpnr_cod_impuesto"].'</codigo>
                                      <codigoPorcentaje>'.$row_producto_detalle["prs_irbpnr_cod_tarifa"].'</codigoPorcentaje>                        
                                      <baseImponible>'.round($pos_trans_sub_total,2).'</baseImponible>
                                      <tarifa>'.$row_producto_detalle['trf_porcentaje_irbpnr'].'</tarifa>
                                      <valor>'.round($pos_base_imp_irbpnr,2).'</valor>';
      }

      $xml_detalles .= '</impuestos>';
      $xml_detalles .= '</detalle>';
    }

    /*****************************************************************************************************************/

    if ($pos_base_imp_2_acum > 0) {
      $xml_total_impuesto .= '<totalImpuesto>
                                <codigo>2</codigo>
                                <codigoPorcentaje>2</codigoPorcentaje>
                                <baseImponible>'.$pos_base_imp_2_acum.'</baseImponible>
                                <tarifa>12</tarifa>
                                <valor>'.$pos_base_imp_iva_2_acum.'</valor>
                              </totalImpuesto>';
    }
    if ($pos_base_imp_3_acum > 0) {
      $xml_total_impuesto .= '<totalImpuesto>
                                <codigo>2</codigo>
                                <codigoPorcentaje>3</codigoPorcentaje>
                                <baseImponible>'.$pos_base_imp_3_acum.'</baseImponible>
                                <tarifa>14</tarifa>
                                <valor>'.$pos_base_imp_iva_3_acum.'</valor>
                              </totalImpuesto>';
    }
    if ($pos_base_imp_8_acum > 0) {
      $xml_total_impuesto .= '<totalImpuesto>
                                <codigo>2</codigo>
                                <codigoPorcentaje>8</codigoPorcentaje>
                                <baseImponible>'.$pos_base_imp_8_acum.'</baseImponible>
                                <tarifa>'.$pos_base_imp_diff_8_acum.'</tarifa>
                                <valor>'.$pos_base_imp_iva_8_acum.'</valor>
                              </totalImpuesto>';
    }
    if ($pos_base_imp_0_acum > 0) {
      $xml_total_impuesto .= '<totalImpuesto>
                                <codigo>2</codigo>
                                <codigoPorcentaje>0</codigoPorcentaje>
                                <baseImponible>'.$pos_base_imp_0_acum.'</baseImponible>
                                <tarifa>0</tarifa>
                                <valor>0.00</valor>
                              </totalImpuesto>';
    }
    if ($pos_base_imp_6_acum > 0) {
      $xml_total_impuesto .= '<totalImpuesto>
                                <codigo>2</codigo>
                                <codigoPorcentaje>6</codigoPorcentaje>
                                <baseImponible>'.$pos_base_imp_6_acum.'</baseImponible>
                                <tarifa>0</tarifa>
                                <valor>0.00</valor>
                              </totalImpuesto>';
    }
    if ($pos_base_imp_7_acum > 0) {
      $xml_total_impuesto .= '<totalImpuesto>
                                <codigo>2</codigo>
                                <codigoPorcentaje>7</codigoPorcentaje>
                                <baseImponible>'.$pos_base_imp_7_acum.'</baseImponible>
                                <tarifa>0</tarifa>
                                <valor>0.00</valor>
                              </totalImpuesto>';
    }

    if ($impuesto_ice) {
      foreach($array_ice as $k => $v) {
        $impuesto_cabecera_ice = '<codigo>3</codigo>
                                  <codigoPorcentaje>'.$k.'</codigoPorcentaje>                        
                                  <baseImponible>'.$v['base_imponible'].'</baseImponible>
                                  <tarifa>'.$v['tarifa'].'</tarifa>
                                  <valor>'.$v['valor'].'</valor>';
        $xml .= '<totalImpuesto>'.$impuesto_cabecera_ice.'</totalImpuesto>';
      }
    }
    
    if($impuesto_irbpnr) {
      $xml .= '<totalImpuesto>'.$impuesto_cabecera_irbpnr.'</totalImpuesto>';
    } 

    $pos_total_comprobante = round($pos_total_sub_total,2) + round($pos_base_imp_iva_acum,2) + round($pos_base_imp_ice_acum,2) + round($pos_base_imp_irbpnr_acum,2);

    $xml = '<?xml version="1.0" encoding="UTF-8"?>
            <factura id="comprobante" version="1.0.0">
            <infoTributaria>
                <ambiente>'.$data_comprobante["sri_clave_acceso_tipo_ambiente"].'</ambiente>
                <tipoEmision>'.$data_comprobante["sri_clave_acceso_tipo_emision"].'</tipoEmision>
                <razonSocial>'.$data_comprobante["emp_empresa"].'</razonSocial>
                <nombreComercial>'.$data_comprobante["emp_nom_comercial"].'</nombreComercial>
                <ruc>'.$data_comprobante["emp_ruc"].'</ruc>
                <claveAcceso>'.$data_comprobante["sri_clave_acceso"].'</claveAcceso>
                <codDoc>'.$data_comprobante["sri_clave_acceso_tipo_comprobante"].'</codDoc>
                <estab>'.$data_comprobante["sri_clave_acceso_serie_establecimiento"] .'</estab>
                <ptoEmi>'.$data_comprobante["sri_clave_acceso_serie_punto_emision"].'</ptoEmi>
                <secuencial>'.$data_comprobante["sri_clave_acceso_secuencial"].'</secuencial>
                <dirMatriz>'.$data_comprobante["emp_direccion_matriz"].'</dirMatriz>
            </infoTributaria>
            <infoFactura>
                <fechaEmision>'.date("d/m/Y",strtotime($data_comprobante["fechaActual_4"])).'</fechaEmision>
                <dirEstablecimiento>'.$data_comprobante["emp_direccion_matriz"].'</dirEstablecimiento>
                <obligadoContabilidad>'.($data_comprobante["emp_obli_contabilidad"] == 1 ? "SI" : "NO").'</obligadoContabilidad>
                <tipoIdentificacionComprador>'.$data_comprobante["cli_tipo_identificacion"].'</tipoIdentificacionComprador>
                <razonSocialComprador>'.$data_comprobante["cli_nombres"].'</razonSocialComprador>
                <identificacionComprador>'.$data_comprobante["cli_identificacion"].'</identificacionComprador>
                <direccionComprador>'.$data_comprobante["cli_direccion"].'</direccionComprador>';
    $xml .= '<totalSinImpuestos>'.$pos_total_sub_total.'</totalSinImpuestos>';
    $xml .= '<totalDescuento>'.$pos_total_descuento.'</totalDescuento>';        
    $xml .= '<totalConImpuestos>';
    $xml .= $xml_total_impuesto;
    $importeTotal = round($pos_total_comprobante,2);
    $xml.='</totalConImpuestos>        
          <propina>0.00</propina>        
          <importeTotal>'.$importeTotal.'</importeTotal>
          <moneda>DOLAR</moneda>
          <pagos>
              <pago>
                  <formaPago>'.$data_comprobante["fop_id_forma_pago"].'</formaPago>
                  <total>'.$importeTotal.'</total>
                  <plazo>1</plazo>
                  <unidadTiempo>Dias</unidadTiempo>
              </pago>            
          </pagos>
          <valorRetIva>0.00</valorRetIva>
          <valorRetRenta>0.00</valorRetRenta>
          </infoFactura>
          <detalles>';
    $xml.=$xml_detalles;
    $xml.='</detalles>
            <infoAdicional>
                <campoAdicional nombre="Direccion">'.$data_comprobante["cli_direccion"].'</campoAdicional>
                <campoAdicional nombre="Telefono">'.$data_comprobante["cli_telefono"].'</campoAdicional>        
                <campoAdicional nombre="Email">'.$data_comprobante["cli_correo"].'</campoAdicional>
            </infoAdicional>
          </factura>';

    $nombre = "../../comprobantesGenerados/".$data_comprobante["sri_clave_acceso"].".xml";
    $archivo = fopen($nombre, "w+");
    if (fwrite($archivo, $xml)) {
      $data_result["cargaXML"] = "cargaOK";
      $data_result["clave_acceso_sri"] = $data_comprobante["sri_clave_acceso"];
    }
    else {
      $data_result["cargaXML"] = "cargaError";
      $data_result["clave_acceso_sri"] = "";
    }
    fclose($archivo);

    return $data_result["cargaXML"]."&&&&".$data_result["clave_acceso_sri"];
 
  }   
}