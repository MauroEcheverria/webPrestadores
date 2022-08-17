<?php
class enviarXML {
  public function envioXML($data_comprobante,$pdo) {
    if ($comprobante == 1) {

      $sql_comprobante_detalle="SELECT prs_id_prod_serv,fdt_cantidad
                                FROM dct_pos_tbl_factura_detalle 
                                WHERE ftr_id_factura_transaccion = :ftr_id_factura_transaccion;";
      $query_comprobante_detalle=$pdo->prepare($sql_comprobante_detalle);
      $query_comprobante_detalle->bindValue(':ftr_id_factura_transaccion',$data_comprobante["ftr_id_factura_transaccion"],PDO::PARAM_INT);
      $query_comprobante_detalle->execute();
      $row_comprobante_detalle = $query_comprobante_detalle->fetchAll();

      $xml_detalles = '';
      $totalDescuentos = 0;
      $totalSinImpuestos = 0;

      foreach ($row_comprobante_detalle as $row_comprobante_detalle) {

        $sql_producto_detalle="SELECT prs_codigo_item, prs_descripcion_item, prs_valor_unitario, 
                              prs_descuento, prs_iva_cod_impuesto, prs_iva_cod_tarifa, prs_iva_porcentaje,
                              prs_ice_cod_impuesto, prs_ice_cod_tarifa, prs_ice_porcentaje, prs_estado,
                              prs_det_nombre_1, prs_det_valor_1, prs_det_nombre_2, prs_det_valor_2, 
                              prs_det_nombre_3, prs_det_valor_3
                              FROM dct_pos_tbl_producto_servicio 
                              WHERE prs_id_prod_serv = :prs_id_prod_serv;";
        $query_producto_detalle=$pdo->prepare($sql_producto_detalle);
        $query_producto_detalle->bindValue(':prs_id_prod_serv',$row_comprobante_detalle["prs_id_prod_serv"],PDO::PARAM_INT);
        $query_producto_detalle->execute();
        $row_producto_detalle = $query_producto_detalle->fetch(\PDO::FETCH_ASSOC);

        $totalDescuento = $row_producto_detalle["prs_valor_unitario"] * $row_producto_detalle["prs_descuento"] / 100;
        $totalDescuentos += $totalDescuento;
        $totalConDescuento = $row_producto_detalle["prs_valor_unitario"] - $totalDescuento;
        $totalSinImpuestos += $totalConDescuento;

        $xml_detalles .= '<detalle>
                          <codigoPrincipal>'.$row_producto_detalle["prs_codigo_item"].'</codigoPrincipal>
                          <codigoAuxiliar>'.$row_producto_detalle["prs_codigo_item"].'</codigoAuxiliar>
                          <descripcion>'.$row_producto_detalle["prs_descripcion_item"].'</descripcion>
                          <cantidad>'.$row_comprobante_detalle["fdt_cantidad"].'</cantidad>
                          <precioUnitario>'.$row_producto_detalle["prs_valor_unitario"].'</precioUnitario>            
                          <descuento>'.$totalDescuento.'</descuento>
                          <precioTotalSinImpuesto>'.$totalConDescuento.'</precioTotalSinImpuesto>
                          <detallesAdicionales>';
                            if( $row_producto_detalle["prs_det_nombre_1"] != "" && $row_producto_detalle["prs_det_valor_1"] != "" ) {
                              $xml_detalles .= '<detAdicional nombre="'.$row_producto_detalle["prs_det_nombre_1"].'" valor="'.$row_producto_detalle["prs_det_valor_1"].'"/>';
                            }
                            if( $row_producto_detalle["prs_det_nombre_2"] != "" && $row_producto_detalle["prs_det_valor_2"] != "" ) {
                              $xml_detalles .= '<detAdicional nombre="'.$row_producto_detalle["prs_det_nombre_2"].'" valor="'.$row_producto_detalle["prs_det_valor_2"].'"/>';
                            }
                            if( $row_producto_detalle["prs_det_nombre_3"] != "" && $row_producto_detalle["prs_det_valor_3"] != "" ) {
                              $xml_detalles .= '<detAdicional nombre="'.$row_producto_detalle["prs_det_nombre_3"].'" valor="'.$row_producto_detalle["prs_det_valor_3"].'"/>';
                            }
        $xml_detalles .='</detallesAdicionales>';


        
        
        $acum_total_iva = 0;
        $acum_total_ice = 0;
        $acum_total_irbpnr = 0;

        $acum_base_imponible_iva = 0;

        $impuesto_iva = false;
        $impuesto_ice = false;
        $impuesto_irbpnr = false;

        

        $xml_detalles .='<impuestos>';
        if($row_producto_detalle["prs_iva_cod_impuesto"] == 2) {
          $impuesto_iva = true;
          $total_item_iva = $totalConDescuento * $row_producto_detalle["prs_iva_porcentaje"] / 100;
          $acum_total_iva += $total_item_iva;
          $acum_base_imponible_iva += $totalConDescuento;
          $xml_detalles .= '<impuesto>
                              <codigo>'.$row_producto_detalle["prs_iva_cod_impuesto"].'</codigo>
                              <codigoPorcentaje>'.$row_producto_detalle["prs_iva_cod_tarifa"].'</codigoPorcentaje>
                              <tarifa>'.$row_producto_detalle["prs_iva_porcentaje"].'</tarifa>
                              <baseImponible>'.$totalConDescuento.'</baseImponible>
                              <valor>'.$total_item_iva.'</valor>
                            </impuesto>';
        }
        if($row_producto_detalle["prs_ice_cod_impuesto"] == 3) {
          $impuesto_ice = true;
          $total_item_ice = $totalConDescuento * $row_producto_detalle["prs_ice_porcentaje"] / 100;
          $acum_total_ice += $total_item_ice;
          $xml_detalles .= '<impuesto>
                              <codigo>'.$row_producto_detalle["prs_ice_cod_impuesto"].'</codigo>
                              <codigoPorcentaje>'.$row_producto_detalle["prs_ice_cod_tarifa"].'</codigoPorcentaje>
                              <tarifa>'.$row_producto_detalle["prs_ice_porcentaje"].'</tarifa>
                              <baseImponible>'.$totalConDescuento.'</baseImponible>
                              <valor>'.$total_item_ice.'</valor>
                            </impuesto>';
        }
        if($row_producto_detalle["prs_irbpnr_cod_impuesto"] == 5){
          $impuesto_irbpnr = true;
          $base_imponible_irbpnr += $campo['baseImponible_irbpnr'];
          $valor_irbpnr += $campo['valor_irbpnr'];
          $xml_detalles .= '<impuesto>
                            <codigo>'.$campo['codigo_irbpnr'].'</codigo>
                            <codigoPorcentaje>'.$campo['codigoPorcentaje_irbpnr'].'</codigoPorcentaje>
                            <tarifa>'.$campo['tarifa_irbpnr'].'</tarifa>
                            <baseImponible>'.$campo['baseImponible_irbpnr'].'</baseImponible>
                            <valor>'.$campo['valor_irbpnr'].'</valor>
                            </impuesto>';
        }
        $xml_detalles .= '</impuestos>';
        $xml_detalles .= '</detalle>';
      }


      /*$xml = '<?xml version="1.0" encoding="UTF-8"?>
              <factura id="comprobante" version="1.0.0">
              <infoTributaria>
                  <ambiente>'.$data_comprobante["sri_clave_acceso_tipo_ambiente"]e.'</ambiente>
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
                  <fechaEmision>'.date("d/m/Y",strtotime($fechaActual_4)).'</fechaEmision>
                  <dirEstablecimiento>'.$data_comprobante["emp_direccion_matriz"].'</dirEstablecimiento>
                  <contribuyenteEspecial>'.$data_comprobante["emp_contrib_especial"].'</contribuyenteEspecial>
                  <obligadoContabilidad>'.$data_comprobante["emp_obli_contabilidad"].'</obligadoContabilidad>
                  <tipoIdentificacionComprador>'.$data_comprobante["cli_tipo_identificacion"].'</tipoIdentificacionComprador>
                  <guiaRemision></guiaRemision>
                  <razonSocialComprador>'.$data_comprobante["cli_nombres"].'</razonSocialComprador>
                  <identificacionComprador>'.$data_comprobante["cli_identificacion"].'</identificacionComprador>
                  <direccionComprador>'.$data_comprobante["cli_direccion"].'</direccionComprador>';
      $xml .= '<totalSinImpuestos>'.$total.'</totalSinImpuestos>';
      $xml .= '<totalDescuento>'.$totalDescuentos.'</totalDescuento>';        
      $xml .= '<totalConImpuestos>
                <totalImpuesto>
                    <codigo>2</codigo>
                    <codigoPorcentaje>0</codigoPorcentaje>
                    <baseImponible>'.$base_imponible_0.'</baseImponible>
                    <tarifa>0</tarifa>                
                    <valor>0.00</valor>
                </totalImpuesto>';
      if($total_iva_12>0) {
        $xml .= '<totalImpuesto>
                  <codigo>2</codigo>
                  <codigoPorcentaje>2</codigoPorcentaje>
                  <baseImponible>'.$base_imponible_12.'</baseImponible>
                  <tarifa>0</tarifa>                
                  <valor>'.$total_iva_12.'</valor>
                </totalImpuesto>';
      }
      if($impuesto_ice == true) {
        foreach($array_ice as $k => $v) {
          $impuesto_cabecera_ice = '<codigo>3</codigo>
          <codigoPorcentaje>'.$k.'</codigoPorcentaje>                        
          <baseImponible>'.$v['base_imponible'].'</baseImponible>
          <tarifa>'.$v['tarifa'].'</tarifa>
          <valor>'.$v['valor'].'</valor>';
          $xml .= '<totalImpuesto>'.$impuesto_cabecera_ice.'</totalImpuesto>';
        }
      }
      if($impuesto_irbpnr== true) {
        $xml .= '<totalImpuesto>'.$impuesto_cabecera_irbpnr.'</totalImpuesto>';
      } 
      $importeTotal = $base_imponible_0 + $base_imponible_12 + $total_iva_12;
      $xml.='</totalConImpuestos>        
                <propina>0.00</propina>        
                <importeTotal>'.$importeTotal.'</importeTotal>
                <moneda>DOLAR</moneda>
                <pagos>
                    <pago>
                        <formaPago>20</formaPago>
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
                    <campoAdicional nombre="Direccion">'.$direccion.'</campoAdicional>
                    <campoAdicional nombre="Telefono">'.$telefono.'</campoAdicional>        
                    <campoAdicional nombre="Email">'.$email.'</campoAdicional>
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

      return $data_result["cargaXML"]."&&&&".$data_result["clave_acceso_sri"];*/
    }
  }   
}