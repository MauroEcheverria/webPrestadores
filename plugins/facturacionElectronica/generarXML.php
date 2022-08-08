<?php
class enviarXML {
  public function envioXML($id,$comprobante,$pdo) {
    if ($comprobante == 1) {

      $sql = "select * 
              from datos_cabecera_electronica 
              inner join detalle_factura_electronica on datos_cabecera_electronica.orden_no = detalle_factura_electronica.orden_no
              where datos_cabecera_electronica.id_comprobante=" . $id;
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $array = $stmt->fetchAll();

      $xml_detalles = '';
      $total_iva_12 = 0;
      $base_imponible_12 = 0;
      $base_imponible_ice = 0;
      $base_imponible_irbpnr = 0;
      $valor_ice = 0;
      $valor_irbpnr = 0;
      $base_imponible_0 = 0;
      $total_iva_0 = 0;
      $sub_total = 0;
      $impuesto_ice = false;
      $impuesto_irbpnr = false;
      $impuesto_cabecera_ice= '';
      $impuesto_cabecera_irbpnr = '';
      $array_cod_ice= array();
      $array_ice = array();
      foreach ($array as $campo) {
        $sub_total += $campo['total'];
        $denominacion_comercial = $campo['item'];
        $xml_detalles .='<detalle>
                        <codigoPrincipal>' . $campo['id_tabla'] . '</codigoPrincipal>
                        <codigoAuxiliar>' . $campo['id_tabla'] . '</codigoAuxiliar>
                        <descripcion>' . $denominacion_comercial . '</descripcion>
                        <cantidad>' . $campo['cantidad'] . '</cantidad>
                        <precioUnitario>' . $campo['precio_u'] . '</precioUnitario>            
                        <descuento>0</descuento>
                        <precioTotalSinImpuesto>' . $campo['total'] . '</precioTotalSinImpuesto>
                        <detallesAdicionales>
                            <detAdicional nombre="denominacion_tipo_producto" valor="Tipo Producto"></detAdicional>
                            <detAdicional nombre="denominacion_categoria" valor="Categoria"></detAdicional>
                        </detallesAdicionales>';
        $xml_detalles .= '<impuestos>';
        if($campo['iva'] == '0') {
          $base_imponible_0 += $campo['total'];
          $xml_detalles .= '<impuesto>
                            <codigo>2</codigo>
                            <codigoPorcentaje>0</codigoPorcentaje>
                            <tarifa>0</tarifa>
                            <baseImponible>' . $campo['total'] . '</baseImponible>
                            <valor>0</valor>
                            </impuesto>';
        }
        else {
          $totalProductoConImpuesto = $campo['total'] * $campo['iva'];
          $totalProductoConImpuesto = $totalProductoConImpuesto/100;
          $total_iva_12 += $totalProductoConImpuesto;
          $base_imponible_12 += $campo['total'];
          $xml_detalles .= '<impuesto>
                            <codigo>2</codigo>
                            <codigoPorcentaje>2</codigoPorcentaje>
                            <tarifa>12</tarifa>
                            <baseImponible>' . $campo['total'] . '</baseImponible>
                            <valor>'.$totalProductoConImpuesto.'</valor>
                            </impuesto>';
        }
        if($campo['ice'] == '1') {
          $impuesto_ice = true;
          $xml_detalles .= '<impuesto>
                            <codigo>' . $campo['codigo_ice'] . '</codigo>
                            <codigoPorcentaje>' . $campo['codigoPorcentaje_ice'] . '</codigoPorcentaje>
                            <tarifa>' . $campo['tarifa_ice'] . '</tarifa>
                            <baseImponible>' . $campo['baseImponible_ice'] . '</baseImponible>
                            <valor>'.$campo['valor_ice'].'</valor>
                            </impuesto>';
          array_push($array_cod_ice,  $campo['codigoPorcentaje_ice'] );
          $codigoPorcentaje_ice = $campo['codigoPorcentaje_ice'];
          $cod_porce = array_search($campo['codigoPorcentaje_ice'], $array_cod_ice);
          $array_ice[$codigoPorcentaje_ice]['base_imponible'] += $campo['baseImponible_ice'];
          $array_ice[$codigoPorcentaje_ice]['valor'] += $campo['valor_ice'];
          $array_ice[$codigoPorcentaje_ice]['tarifa'] = $campo['tarifa_ice'];
        }
        if($campo['irbpnr'] == '1'){
          $impuesto_irbpnr = true;
          $base_imponible_irbpnr += $campo['baseImponible_irbpnr'];
          $valor_irbpnr += $campo['valor_irbpnr'];
          $xml_detalles .= '<impuesto>
                            <codigo>' . $campo['codigo_irbpnr'] . '</codigo>
                            <codigoPorcentaje>' . $campo['codigoPorcentaje_irbpnr'] . '</codigoPorcentaje>
                            <tarifa>' . $campo['tarifa_irbpnr'] . '</tarifa>
                            <baseImponible>' . $campo['baseImponible_irbpnr'] . '</baseImponible>
                            <valor>'.$campo['valor_irbpnr'].'</valor>
                            </impuesto>';
          $impuesto_cabecera_irbpnr .= '<codigo>' . $campo['codigo_irbpnr'] . '</codigo>
                                        <codigoPorcentaje>' . $campo['codigoPorcentaje_irbpnr'] . '</codigoPorcentaje>                        
                                        <baseImponible>' . $campo['baseImponible_irbpnr'] . '</baseImponible>
                                        <tarifa>' . $campo['tarifa_irbpnr'] . '</tarifa>
                                        <valor>'.$campo['valor_irbpnr'].'</valor>';
        }
        $xml_detalles .= '</impuestos></detalle>';
      }
      
      $sql = "select * from datos_cabecera_electronica where datos_cabecera_electronica.id_comprobante='$id' ";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $factura = $stmt->fetchAll();
      foreach ($factura as $campo) {
        $campo['tipo_comporbante'] = 1;
        $nombre_comercial_empresa = $campo['nombre_comercial'];
        $razon_social_empresa = $campo['razon_social'];
        $direccion_empresa = $campo['direccion_matriz'];
        $direccion_sucursal = $campo['direccion_matriz'];
        $telefono_empresa = $campo['telefono'];
        $email_empresa = $campo['correo'];
        $nro_documento_empresa = $campo['ruc_empresa'];
        $obligado_llevar_contabilidad = $campo['obligado'];
        $nro_comprovante = $campo['secuencial'];
        $codigo_establecimiento = $campo['establecimiento'];
        $codigo_punto_emision = $campo['punto_emi'];
        $fecha_emision = $campo['fecha'];
        $id_tipo_ambiente = $campo['ambiente'];
        $id_tipo_emision = 1;
        $id_tipo_documento = str_pad($campo['tipo_identificacion'], '1', '0', STR_PAD_LEFT);
        $razon_social = $campo['razon_social'];
        $razon_social_comprador = $campo['cliente'];
        $nro_documento = $campo['ruc'];
        $direccion = $campo['direccion'];
        $subtotal_sin_impuesto = $sub_total;
        $totaliva = 0;
        $descuento = 0;
        $subtotal_con_impuesto = $sub_total;
        $impuesto = 0;
        $total = $sub_total;
        $direccion = $campo['direccion'];
        $telefono = $campo['telefono'];
        $email = $campo['correo'];

        $sri_clave_acceso_fecha_emison = date('dmY', strtotime($campo['fecha']));
        $sri_clave_acceso_tipo_comprobante = str_pad($campo['tipo_comporbante'],'2','0',STR_PAD_LEFT);
        $sri_clave_acceso_ruc = $campo['ruc_empresa'];
        $sri_clave_acceso_tipo_ambiente = $campo['ambiente'];
        $sri_clave_acceso_serie_establecimiento = $campo['establecimiento'];
        $sri_clave_acceso_serie_punto_emision = $campo['punto_emi'];
        $sri_clave_acceso_secuencial = str_pad($campo['secuencial'],'9','0',STR_PAD_LEFT);
        $sri_clave_acceso_cod_numerico = str_pad($campo['id'],'8','0',STR_PAD_LEFT);
        $sri_clave_acceso_tipo_emision = 1;
        $sri_clave_acceso_verificador = $this->validar_clave($sri_clave_acceso_fecha_emison.
                                                            $sri_clave_acceso_tipo_comprobante.
                                                            $sri_clave_acceso_ruc.
                                                            $sri_clave_acceso_tipo_ambiente.
                                                            $sri_clave_acceso_serie_establecimiento.
                                                            $sri_clave_acceso_serie_punto_emision.
                                                            $sri_clave_acceso_secuencial.
                                                            $sri_clave_acceso_cod_numerico.
                                                            $sri_clave_acceso_tipo_emision);
        $sri_clave_acceso = $sri_clave_acceso_fecha_emison.
                            $sri_clave_acceso_tipo_comprobante.
                            $sri_clave_acceso_ruc.
                            $sri_clave_acceso_tipo_ambiente.
                            $sri_clave_acceso_serie_establecimiento.
                            $sri_clave_acceso_serie_punto_emision.
                            $sri_clave_acceso_secuencial.
                            $sri_clave_acceso_cod_numerico.
                            $sri_clave_acceso_tipo_emision.
                            $sri_clave_acceso_verificador;
      }

      $xml = '<?xml version="1.0" encoding="UTF-8"?>
              <factura id="comprobante" version="1.0.0">
              <infoTributaria>
                  <ambiente>' . $id_tipo_ambiente . '</ambiente>
                  <tipoEmision>' . $id_tipo_emision . '</tipoEmision>
                  <razonSocial>' . $razon_social_empresa . '</razonSocial>
                  <nombreComercial>' . $nombre_comercial_empresa . '</nombreComercial>
                  <ruc>' . $nro_documento_empresa . '</ruc>
                  <claveAcceso>' . $sri_clave_acceso . '</claveAcceso>
                  <codDoc>01</codDoc>
                  <estab>' . $codigo_establecimiento . '</estab>
                  <ptoEmi>' . $codigo_punto_emision . '</ptoEmi>
                  <secuencial>' . str_pad($campo['secuencial'], '9', '0', STR_PAD_LEFT) . '</secuencial>
                  <dirMatriz>' . $direccion_empresa . '</dirMatriz>
              </infoTributaria>
              <infoFactura>
                  <fechaEmision>' . date("d/m/Y", strtotime($fecha_emision)) . '</fechaEmision>
                  <dirEstablecimiento>' . $direccion_sucursal . '</dirEstablecimiento>
                  <obligadoContabilidad>' . $obligado_llevar_contabilidad . '</obligadoContabilidad>       
                  <tipoIdentificacionComprador>0' . $id_tipo_documento . '</tipoIdentificacionComprador>
                  <razonSocialComprador>' . $razon_social_comprador . '</razonSocialComprador>
                  <identificacionComprador>' . $nro_documento . '</identificacionComprador>
                  <direccionComprador>' . $direccion . '</direccionComprador>';
      $xml .= '<totalSinImpuestos>' . $total . '</totalSinImpuestos>';
      $xml .= '<totalDescuento>' . $descuento . '</totalDescuento>';        
      $xml .= '<totalConImpuestos>
                <totalImpuesto>
                    <codigo>2</codigo>
                    <codigoPorcentaje>0</codigoPorcentaje>
                    <baseImponible>' . $base_imponible_0 . '</baseImponible>
                    <tarifa>0</tarifa>                
                    <valor>0.00</valor>
                </totalImpuesto>';
      if($total_iva_12>0) {
        $xml .= '<totalImpuesto>
                  <codigo>2</codigo>
                  <codigoPorcentaje>2</codigoPorcentaje>
                  <baseImponible>' . $base_imponible_12 . '</baseImponible>
                  <tarifa>0</tarifa>                
                  <valor>'.$total_iva_12.'</valor>
                </totalImpuesto>';
      }
      if($impuesto_ice == true) {
        foreach($array_ice as $k => $v) {
          $impuesto_cabecera_ice = '<codigo>3</codigo>
          <codigoPorcentaje>' . $k . '</codigoPorcentaje>                        
          <baseImponible>' . $v['base_imponible'] . '</baseImponible>
          <tarifa>' . $v['tarifa'] . '</tarifa>
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
                <importeTotal>' . $importeTotal . '</importeTotal>
                <moneda>DOLAR</moneda>
                <pagos>
                    <pago>
                        <formaPago>20</formaPago>
                        <total>' . $importeTotal . '</total>
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
                    <campoAdicional nombre="Direccion">' . $direccion . '</campoAdicional>
                    <campoAdicional nombre="Telefono">' . $telefono . '</campoAdicional>        
                    <campoAdicional nombre="Email">' . $email . '</campoAdicional>
                </infoAdicional>
            </factura>';

      $nombre = "../../comprobantesGenerados/".$sri_clave_acceso.".xml";
      $archivo = fopen($nombre, "w+");
      if (fwrite($archivo, $xml)) {
        $data_result["cargaXML"] = "cargaOK";
        $data_result["clave_acceso_sri"] = $sri_clave_acceso;
      }
      else {
        $data_result["cargaXML"] = "cargaError";
        $data_result["clave_acceso_sri"] = "";
      }
      fclose($archivo);

      return $data_result["cargaXML"]."&&&&".$data_result["clave_acceso_sri"];
    }
         
    if ($comprobante == 4) {
            
      $sql = "select * 
              from datos_cabecera_electronica 
              inner join detalle_nota_electronica on datos_cabecera_electronica.nota_no = detalle_nota_electronica.nota_no 
              where datos_cabecera_electronica.id_comprobante=" . $id;
      
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $array = $stmt->fetchAll();

      $xml_detalles = '';
      $total_iva_12 = 0;
      $base_imponible_12 = 0;
      $base_imponible_0 = 0;
      $total_iva_0 = 0;
      $sub_total = 0;
      foreach ($array as $campo) {
        $sub_total += $campo['total'];
        $denominacion_comercial = $campo['item'];

        $xml_detalles .='<detalle>
                        <codigoInterno>' . $campo['id_tabla'] . '</codigoInterno>
                        <codigoAdicional>' . $campo['id_tabla'] . '</codigoAdicional>
                        <descripcion>' . $denominacion_comercial . '</descripcion>
                        <cantidad>' . $campo['cantidad'] . '</cantidad>
                        <precioUnitario>' . $campo['precio_u'] . '</precioUnitario>            
                        <descuento>0</descuento>
                        <precioTotalSinImpuesto>' . $campo['total'] . '</precioTotalSinImpuesto>
                        <detallesAdicionales>
                            <detAdicional nombre="honorario" valor="1"></detAdicional>
                        </detallesAdicionales>
                        <impuestos>
                            <impuesto>
                                <codigo>2</codigo>
                                <codigoPorcentaje>0</codigoPorcentaje>
                                <tarifa>0</tarifa>
                                <baseImponible>' . $campo['total'] . '</baseImponible>
                                <valor>0.00</valor>
                            </impuesto>
                        </impuestos>
                        </detalle>';
      }

      $sql = "select * from datos_cabecera_electronica 
      inner join datos_nota_credito 
      where datos_cabecera_electronica.id_comprobante='$id' ";

      $stmt = $pdo->prepare($sql);
      $stmt->execute();

      $factura = $stmt->fetchAll();
      foreach ($factura as $campo) {

        $nombre_comercial_empresa = $campo['nombre_comercial'];
        $razon_social_empresa = $campo['razon_social'];
        $direccion_empresa = $campo['direccion_matriz'];
        $direccion_sucursal = $campo['direccion_matriz'];
        $telefono_empresa = $campo['telefono'];
        $email_empresa = $campo['correo'];
        $nro_documento_empresa = $campo['ruc_empresa'];
        $obligado_llevar_contabilidad = $campo['obligado'];

        $nro_comprovante = $campo['secuencial'];
        $codigo_establecimiento = $campo['establecimiento'];
        $codigo_punto_emision = $campo['punto_emi'];
        $fecha_emision = $campo['fecha'];

        $cod_doc_modiicado = str_pad($campo['codDocmodificado'], '1', '0', STR_PAD_LEFT);
        $num_doc_modificado = $codigo_establecimiento . '-' . $codigo_punto_emision . '-' . $campo['numDocModificado'];
        $fechaEmisionDocSustento = date('d/m/Y', strtotime($campo['fechaEmisionDocSustento']));
        $total_sin_impuestos = $campo['total_sin_impuestos'];
        $valor_modificacion = $campo['valorModificacion'];

        $id_tipo_ambiente = $campo['ambiente'];
        $id_tipo_emision = 1;

        $id_tipo_documento = str_pad($campo['tipo_identificacion'], '1', '0', STR_PAD_LEFT);

        $razon_social = $campo['razon_social'];
        $razon_social_comprador = $campo['razonSocial'];
        $identificacionComprador = $campo['identificacionComprador'];

        $nro_documento = $campo['ruc'];
        $direccion = $campo['direccion'];
        $subtotal_sin_impuesto = $sub_total;
        $totaliva = 0;
        $descuento = 0;
        $subtotal_con_impuesto = $sub_total;
        $impuesto = 0;
        $total = $sub_total;

        $direccion = $campo['direccion'];
        $telefono = $campo['telefono'];
        $email = $campo['correo'];

        $sri_clave_acceso_fecha_emison = date('dmY', strtotime($campo['fecha']));
        $sri_clave_acceso_tipo_comprobante = str_pad($campo['tipo_comporbante'],'2','0',STR_PAD_LEFT);
        $sri_clave_acceso_ruc = $campo['ruc_empresa'];
        $sri_clave_acceso_tipo_ambiente = $campo['ambiente'];
        $sri_clave_acceso_serie_establecimiento = $campo['establecimiento'];
        $sri_clave_acceso_serie_punto_emision = $campo['punto_emi'];
        $sri_clave_acceso_secuencial = str_pad($campo['secuencial'],'9','0',STR_PAD_LEFT);
        $sri_clave_acceso_cod_numerico = str_pad($campo['id'],'8','0',STR_PAD_LEFT);
        $sri_clave_acceso_tipo_emision = 1;
        $sri_clave_acceso_verificador = $this->validar_clave($sri_clave_acceso_fecha_emison.
                                                            $sri_clave_acceso_tipo_comprobante.
                                                            $sri_clave_acceso_ruc.
                                                            $sri_clave_acceso_tipo_ambiente.
                                                            $sri_clave_acceso_serie_establecimiento.
                                                            $sri_clave_acceso_serie_punto_emision.
                                                            $sri_clave_acceso_secuencial.
                                                            $sri_clave_acceso_cod_numerico.
                                                            $sri_clave_acceso_tipo_emision);
        $sri_clave_acceso = $sri_clave_acceso_fecha_emison.
                            $sri_clave_acceso_tipo_comprobante.
                            $sri_clave_acceso_ruc.
                            $sri_clave_acceso_tipo_ambiente.
                            $sri_clave_acceso_serie_establecimiento.
                            $sri_clave_acceso_serie_punto_emision.
                            $sri_clave_acceso_secuencial.
                            $sri_clave_acceso_cod_numerico.
                            $sri_clave_acceso_tipo_emision.
                            $sri_clave_acceso_verificador;
      }

      $xml = '<?xml version="1.0" encoding="UTF-8"?>
                <notaCredito id="comprobante" version="1.0.0">
                    <infoTributaria>
                        <ambiente>' . $id_tipo_ambiente . '</ambiente>
                        <tipoEmision>' . $id_tipo_emision . '</tipoEmision>
                        <razonSocial>' . $razon_social_empresa . '</razonSocial>
                        <nombreComercial>' . $nombre_comercial_empresa . '</nombreComercial>
                        <ruc>' . $nro_documento_empresa . '</ruc>
                        <claveAcceso>' . $sri_clave_acceso . '</claveAcceso>
                        <codDoc>04</codDoc>
                        <estab>' . $codigo_establecimiento . '</estab>
                        <ptoEmi>' . $codigo_punto_emision . '</ptoEmi>
                        <secuencial>' . str_pad($campo['secuencial'], '9', '0', STR_PAD_LEFT) . '</secuencial>
                        <dirMatriz>' . $direccion_empresa . '</dirMatriz>
                    </infoTributaria>
                    <infoNotaCredito>
                        <fechaEmision>' . date("d/m/Y", strtotime($fecha_emision)) . '</fechaEmision>
                        <dirEstablecimiento>' . $direccion_sucursal . '</dirEstablecimiento>
                            <tipoIdentificacionComprador>0' . $id_tipo_documento . '</tipoIdentificacionComprador>
                            <razonSocialComprador>' . $razon_social_comprador . '</razonSocialComprador>
                                <identificacionComprador>' . $identificacionComprador . '</identificacionComprador>
                        <obligadoContabilidad>' . $obligado_llevar_contabilidad . '</obligadoContabilidad>       
                        <codDocModificado>0' . $cod_doc_modiicado . '</codDocModificado>
                        <numDocModificado>' . $num_doc_modificado . '</numDocModificado>
                        <fechaEmisionDocSustento>' . $fechaEmisionDocSustento . '</fechaEmisionDocSustento>';
      $xml.='<totalSinImpuestos>' . $total_sin_impuestos . '</totalSinImpuestos>'
              . '<valorModificacion>' . $valor_modificacion . '</valorModificacion>'
              . '<moneda>DOLAR</moneda>';
      $xml .= '       
        <totalConImpuestos>
        <totalImpuesto>
            <codigo>2</codigo>
            <codigoPorcentaje>0</codigoPorcentaje>
            <baseImponible>' . $total_sin_impuestos . '</baseImponible>               
            <valor>0.00</valor>
        </totalImpuesto>';
      $xml.=' </totalConImpuestos>        
              <motivo>PRUEBA NC</motivo>
              </infoNotaCredito>
              <detalles>';

      $xml.=$xml_detalles;
      $xml.='</detalles>
                <infoAdicional>
                    <campoAdicional nombre="Direccion">' . $direccion . '</campoAdicional>
                    <campoAdicional nombre="Telefono">' . $telefono . '</campoAdicional>        
                    <campoAdicional nombre="Email">' . $email . '</campoAdicional>
                </infoAdicional>
            </notaCredito>';

      $nombre = "../../comprobantesGenerados/".$sri_clave_acceso.".xml";
      $archivo = fopen($nombre, "w+");
      if (fwrite($archivo, $xml)) {
        $data_result["cargaXML"] = "cargaOK";
        $data_result["clave_acceso_sri"] = $sri_clave_acceso;
      }
      else {
        $data_result["cargaXML"] = "cargaError";
        $data_result["clave_acceso_sri"] = "";
      }
      fclose($archivo);

      return $data_result["cargaXML"]."&&&&".$data_result["clave_acceso_sri"];

    }

    if ($comprobante == 5) {

      $sql = "select * from datos_cabecera_electronica inner join datos_nota_debito where datos_cabecera_electronica.id_comprobante='$id' ";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $factura = $stmt->fetchAll();

      $sub_total = 0;
      foreach ($factura as $campo) {
        $campo['tipo_comporbante'] = 5;
        $nombre_comercial_empresa = $campo['nombre_comercial'];
        $razon_social_empresa = $campo['razon_social'];
        $direccion_empresa = $campo['direccion_matriz'];
        $direccion_sucursal = $campo['direccion_matriz'];
        $telefono_empresa = $campo['telefono'];
        $email_empresa = $campo['correo'];
        $nro_documento_empresa = $campo['ruc_empresa'];
        $obligado_llevar_contabilidad = $campo['obligado'];

        $nro_comprovante = $campo['secuencial'];
        $codigo_establecimiento = $campo['establecimiento'];
        $codigo_punto_emision = $campo['punto_emi'];
        $fecha_emision = $campo['fecha'];

        $cod_doc_modiicado = str_pad($campo['codDocmodificado'], '1', '0', STR_PAD_LEFT);
        $num_doc_modificado = $codigo_establecimiento . '-' . $codigo_punto_emision . '-' . $campo['numDocModificado'];
        $fechaEmisionDocSustento = date('d/m/Y', strtotime($campo['fechaEmisionDocSustento']));
        $total_sin_impuestos = $campo['total_sin_impuestos'];

        $id_tipo_ambiente = $campo['ambiente'];
        $id_tipo_emision = 1;

        $id_tipo_documento = str_pad(5, '1', '0', STR_PAD_LEFT);

        $razon_social = $campo['razon_social'];
        $razon_social_comprador = $campo['razonSocialComprador'];
        $identificacionComprador = $campo['identificacionComprador'];

        $nro_documento = $campo['ruc'];
        $direccion = $campo['direccion'];
        $subtotal_sin_impuesto = $sub_total;
        $totaliva = 0;
        $descuento = 0;
        $subtotal_con_impuesto = $sub_total;
        $impuesto = 0;
        $total = $sub_total;

        $direccion = $campo['direccion'];
        $telefono = $campo['telefono'];
        $email = $campo['correo'];

        $sri_clave_acceso_fecha_emison = date('dmY', strtotime($campo['fecha']));
        $sri_clave_acceso_tipo_comprobante = str_pad($campo['tipo_comporbante'],'2','0',STR_PAD_LEFT);
        $sri_clave_acceso_ruc = $campo['ruc_empresa'];
        $sri_clave_acceso_tipo_ambiente = $campo['ambiente'];
        $sri_clave_acceso_serie_establecimiento = $campo['establecimiento'];
        $sri_clave_acceso_serie_punto_emision = $campo['punto_emi'];
        $sri_clave_acceso_secuencial = str_pad($campo['secuencial'],'9','0',STR_PAD_LEFT);
        $sri_clave_acceso_cod_numerico = str_pad($campo['id'],'8','0',STR_PAD_LEFT);
        $sri_clave_acceso_tipo_emision = 1;
        $sri_clave_acceso_verificador = $this->validar_clave($sri_clave_acceso_fecha_emison.
                                                            $sri_clave_acceso_tipo_comprobante.
                                                            $sri_clave_acceso_ruc.
                                                            $sri_clave_acceso_tipo_ambiente.
                                                            $sri_clave_acceso_serie_establecimiento.
                                                            $sri_clave_acceso_serie_punto_emision.
                                                            $sri_clave_acceso_secuencial.
                                                            $sri_clave_acceso_cod_numerico.
                                                            $sri_clave_acceso_tipo_emision);
        $sri_clave_acceso = $sri_clave_acceso_fecha_emison.
                            $sri_clave_acceso_tipo_comprobante.
                            $sri_clave_acceso_ruc.
                            $sri_clave_acceso_tipo_ambiente.
                            $sri_clave_acceso_serie_establecimiento.
                            $sri_clave_acceso_serie_punto_emision.
                            $sri_clave_acceso_secuencial.
                            $sri_clave_acceso_cod_numerico.
                            $sri_clave_acceso_tipo_emision.
                            $sri_clave_acceso_verificador;
      }

      $xml = '<?xml version="1.0" encoding="UTF-8"?>
                <notaDebito id="comprobante" version="1.0.0">
                    <infoTributaria>
                        <ambiente>' . $id_tipo_ambiente . '</ambiente>
                        <tipoEmision>' . $id_tipo_emision . '</tipoEmision>
                        <razonSocial>' . $razon_social_empresa . '</razonSocial>
                        <nombreComercial>' . $nombre_comercial_empresa . '</nombreComercial>
                        <ruc>' . $nro_documento_empresa . '</ruc>
                        <claveAcceso>' . $sri_clave_acceso . '</claveAcceso>
                        <codDoc>05</codDoc>
                        <estab>' . $codigo_establecimiento . '</estab>
                        <ptoEmi>' . $codigo_punto_emision . '</ptoEmi>
                        <secuencial>' . str_pad($campo['secuencial'], '9', '0', STR_PAD_LEFT) . '</secuencial>
                        <dirMatriz>' . $direccion_empresa . '</dirMatriz>
                    </infoTributaria>
                    <infoNotaDebito>
                        <fechaEmision>' . date("d/m/Y", strtotime($fecha_emision)) . '</fechaEmision>
                        <dirEstablecimiento>' . $direccion_sucursal . '</dirEstablecimiento>
                            <tipoIdentificacionComprador>0' . $id_tipo_documento . '</tipoIdentificacionComprador>
                            <razonSocialComprador>' . $razon_social_comprador . '</razonSocialComprador>
                                <identificacionComprador>' . $identificacionComprador . '</identificacionComprador>
                        <obligadoContabilidad>' . $obligado_llevar_contabilidad . '</obligadoContabilidad>       
                        <codDocModificado>0' . $cod_doc_modiicado . '</codDocModificado>
                        <numDocModificado>' . $num_doc_modificado . '</numDocModificado>
                        <fechaEmisionDocSustento>' . $fechaEmisionDocSustento . '</fechaEmisionDocSustento>';
      $xml.='<totalSinImpuestos>' . $total_sin_impuestos . '</totalSinImpuestos>';
      $xml .= '<impuestos>
                <impuesto>
                    <codigo>2</codigo>
                    <codigoPorcentaje>0</codigoPorcentaje>
                     <tarifa>0</tarifa>
                    <baseImponible>' . $total_sin_impuestos . '</baseImponible>               
                    <valor>0.00</valor>
                </impuesto>';
      $xml.=' </impuestos>        
              <valorTotal>' . $total_sin_impuestos . '</valorTotal>
              <pagos>
                  <pago>
                      <formaPago>01</formaPago>
                      <total>'. $total_sin_impuestos .'</total>
                      <plazo>12</plazo>
                      <unidadTiempo>Días</unidadTiempo>
                  </pago>
              </pagos>
              </infoNotaDebito>';
      $xml.='<motivos>
                    <motivo>
                        <razon>RIDE</razon>
                        <valor>'. $total_sin_impuestos .'</valor>
                    </motivo>
                </motivos>
                <infoAdicional>
                    <campoAdicional nombre="Direccion">' . $direccion . '</campoAdicional>
                    <campoAdicional nombre="Telefono">' . $telefono . '</campoAdicional>        
                    <campoAdicional nombre="Email">' . $email . '</campoAdicional>
                </infoAdicional>
            </notaDebito>';

      $nombre = "../../comprobantesGenerados/".$sri_clave_acceso.".xml";
      $archivo = fopen($nombre, "w+");
      if (fwrite($archivo, $xml)) {
        $data_result["cargaXML"] = "cargaOK";
        $data_result["clave_acceso_sri"] = $sri_clave_acceso;
      }
      else {
        $data_result["cargaXML"] = "cargaError";
        $data_result["clave_acceso_sri"] = "";
      }
      fclose($archivo);

      return $data_result["cargaXML"]."&&&&".$data_result["clave_acceso_sri"];
    }

    if ($comprobante == 6) {

      $sql = "select * from datos_cabecera_electronica  inner join detalle_guia_electronica on datos_cabecera_electronica.orden_no = detalle_guia_electronica.orden_no where datos_cabecera_electronica.id_comprobante=" . $id;
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $array = $stmt->fetchAll();

      $xml_detalles = '';
      $total_iva_12 = 0;
      $base_imponible_12 = 0;
      $base_imponible_0 = 0;
      $total_iva_0 = 0;
      $sub_total = 0;
      foreach ($array as $campo) {
          $xml_detalles .='<detalle>
                        <codigoInterno>' . $campo['id'] . '</codigoInterno>
                        <codigoAdicional>' . $campo['id'] . '</codigoAdicional>
                        <descripcion>' . $campo['productos'] . '</descripcion>
                        <cantidad>' . $campo['cantidad'] . '</cantidad>
                        <detallesAdicionales>
                            <detAdicional nombre="honorario" valor="1"></detAdicional>
                        </detallesAdicionales>
                        </detalle>';
      }

      $sql = "select * from datos_cabecera_electronica 
              inner join datos_guia_electronica on datos_cabecera_electronica.orden_no = datos_guia_electronica.orden_no 
              where datos_cabecera_electronica.id_comprobante=" . $id;

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $factura = $stmt->fetchAll();

      foreach ($factura as $campo) {
        $campo['tipo_comporbante'] = 6;
        $nombre_comercial_empresa = $campo['nombre_comercial'];
        $razon_social_empresa = $campo['razon_social'];
        $direccion_empresa = $campo['direccion_matriz'];
        $direccion_sucursal = $campo['direccion_matriz'];
        $telefono_empresa = $campo['telefono'];
        $email_empresa = $campo['correo'];
        $nro_documento_empresa = $campo['ruc_empresa'];
        $obligado_llevar_contabilidad = $campo['obligado'];

        $nro_comprovante = $campo['secuencial'];
        $codigo_establecimiento = $campo['establecimiento'];
        $codigo_punto_emision = $campo['punto_emi'];

        $dir_establecimiento = $campo['direccion'];
        $dir_partida = $campo['punto_partida'];
        $razon_social_transportista = $campo['t_nombre'];
        $tipo_identificacion_transportista = str_pad($campo['tipo_ident_transport'], '2', '0', STR_PAD_LEFT);
        $rucTransportista = $campo['t_ci'];
        $obligado_llevar_contabilidad_transportista = $campo['t_contabilidad'];
        $fechaIniTransporte = date('d/m/Y', strtotime($campo['t_f_inicio']));
        $fechaFinTransporte = date('d/m/Y', strtotime($campo['t_f_final']));
        $placa = $campo['t_placa'];

        $identificacion_destinatario = $campo['d_ruc'];
        $razon_social_destinatario = $campo['d_razon_social'];
        $dir_destinatario = $campo['d_punto_llegada'];
        $motivo_traslado = $campo['motivo_translado'];
        $docAduaneroUnico = 99999999999999999;
        $codEstabDestino = 999;
        $ruta = 'RUTA_1';
        $codDocSustento = str_pad($campo['cod_doc'], '2', '0', STR_PAD_LEFT);
        $numDocSustento = $campo['establecimiento'] . '-' . $campo['punto_emi'] . '-' . str_pad($id, '9', '0', STR_PAD_LEFT);
        $numAutDocSustento = '2323232323233333333333333332222222222222222222222';
        $fechaEmisionDocSustento = date('d/m/Y', strtotime($campo['fecha']));

        $id_tipo_ambiente = $campo['ambiente'];
        $id_tipo_emision = 1;

        $id_tipo_documento = str_pad($campo['tipo_identificacion'], '1', '0', STR_PAD_LEFT);
        $razon_social = $campo['razon_social'];
        $nro_documento = $campo['ruc'];
        $direccion = $campo['direccion'];
        $subtotal_sin_impuesto = $sub_total;
        $totaliva = 0;
        $descuento = 0;
        $subtotal_con_impuesto = $sub_total;
        $impuesto = 0;
        $total = $sub_total;

        $direccion = $campo['direccion'];
        $telefono = $campo['telefono'];
        $email = $campo['correo'];

        $sri_clave_acceso_fecha_emison = date('dmY', strtotime($campo['fecha']));
        $sri_clave_acceso_tipo_comprobante = str_pad($campo['tipo_comporbante'],'2','0',STR_PAD_LEFT);
        $sri_clave_acceso_ruc = $campo['ruc_empresa'];
        $sri_clave_acceso_tipo_ambiente = $campo['ambiente'];
        $sri_clave_acceso_serie_establecimiento = $campo['establecimiento'];
        $sri_clave_acceso_serie_punto_emision = $campo['punto_emi'];
        $sri_clave_acceso_secuencial = str_pad($campo['secuencial'],'9','0',STR_PAD_LEFT);
        $sri_clave_acceso_cod_numerico = str_pad($campo['id'],'8','0',STR_PAD_LEFT);
        $sri_clave_acceso_tipo_emision = 1;
        $sri_clave_acceso_verificador = $this->validar_clave($sri_clave_acceso_fecha_emison.
                                                            $sri_clave_acceso_tipo_comprobante.
                                                            $sri_clave_acceso_ruc.
                                                            $sri_clave_acceso_tipo_ambiente.
                                                            $sri_clave_acceso_serie_establecimiento.
                                                            $sri_clave_acceso_serie_punto_emision.
                                                            $sri_clave_acceso_secuencial.
                                                            $sri_clave_acceso_cod_numerico.
                                                            $sri_clave_acceso_tipo_emision);
        $sri_clave_acceso = $sri_clave_acceso_fecha_emison.
                            $sri_clave_acceso_tipo_comprobante.
                            $sri_clave_acceso_ruc.
                            $sri_clave_acceso_tipo_ambiente.
                            $sri_clave_acceso_serie_establecimiento.
                            $sri_clave_acceso_serie_punto_emision.
                            $sri_clave_acceso_secuencial.
                            $sri_clave_acceso_cod_numerico.
                            $sri_clave_acceso_tipo_emision.
                            $sri_clave_acceso_verificador;
      }

      $xml = '<?xml version="1.0" encoding="UTF-8"?>
              <guiaRemision id="comprobante" version="1.0.0">
              <infoTributaria>
                  <ambiente>' . $id_tipo_ambiente . '</ambiente>
                  <tipoEmision>' . $id_tipo_emision . '</tipoEmision>
                  <razonSocial>' . $razon_social_empresa . '</razonSocial>
                  <nombreComercial>' . $nombre_comercial_empresa . '</nombreComercial>
                  <ruc>' . $nro_documento_empresa . '</ruc>
                  <claveAcceso>' . $sri_clave_acceso . '</claveAcceso>
                  <codDoc>06</codDoc>
                  <estab>' . $codigo_establecimiento . '</estab>
                  <ptoEmi>' . $codigo_punto_emision . '</ptoEmi>
                  <secuencial>' . str_pad($campo['secuencial'],'9','0',STR_PAD_LEFT) . '</secuencial>
                  <dirMatriz>' . $direccion_empresa . '</dirMatriz>
              </infoTributaria>
              <infoGuiaRemision>
                  <dirEstablecimiento>' . $dir_establecimiento . '</dirEstablecimiento>
                  <dirPartida>' . $dir_partida . '</dirPartida>       
                  <razonSocialTransportista>' . $razon_social_transportista . '</razonSocialTransportista>
                  <tipoIdentificacionTransportista>' . $tipo_identificacion_transportista . '</tipoIdentificacionTransportista>
                      <rucTransportista>' . $rucTransportista . '</rucTransportista>
                  <obligadoContabilidad>' . $obligado_llevar_contabilidad_transportista . '</obligadoContabilidad>
                  <fechaIniTransporte>' . $fechaIniTransporte . '</fechaIniTransporte>
                  <fechaFinTransporte>' . $fechaFinTransporte . '</fechaFinTransporte>
                  <placa>' . $placa . '</placa>';
      $xml .= '</infoGuiaRemision><destinatarios>
               <destinatario>
                  <identificacionDestinatario>' . $identificacion_destinatario . '</identificacionDestinatario>
                  <razonSocialDestinatario>' . $razon_social_destinatario . '</razonSocialDestinatario>
                  <dirDestinatario>' . $dir_destinatario . '</dirDestinatario>
                  <motivoTraslado>' . $motivo_traslado . '</motivoTraslado>                
                  <docAduaneroUnico>' . $docAduaneroUnico . '</docAduaneroUnico>
                  <codEstabDestino>' . $codEstabDestino . '</codEstabDestino>
                  <ruta>' . $ruta . '</ruta>
                  <codDocSustento>' . $codDocSustento . '</codDocSustento>
                  <numDocSustento>' . $numDocSustento . '</numDocSustento>
                  <numAutDocSustento>' . $numAutDocSustento . '</numAutDocSustento>
                  <fechaEmisionDocSustento>' . $fechaEmisionDocSustento . '</fechaEmisionDocSustento>';
      $xml.='<detalles>';
      $xml.=$xml_detalles;
      $xml.='</detalles>
                          </destinatario>
                          </destinatarios>
              <infoAdicional>
                  <campoAdicional nombre="Direccion">' . $direccion . '</campoAdicional>
                  <campoAdicional nombre="Telefono">' . $telefono . '</campoAdicional>        
                  <campoAdicional nombre="Email">' . $email . '</campoAdicional>
              </infoAdicional>
              </guiaRemision>';

      $nombre = "../../comprobantesGenerados/".$sri_clave_acceso.".xml";
      $archivo = fopen($nombre, "w+");
      if (fwrite($archivo, $xml)) {
        $data_result["cargaXML"] = "cargaOK";
        $data_result["clave_acceso_sri"] = $sri_clave_acceso;
      }
      else {
        $data_result["cargaXML"] = "cargaError";
        $data_result["clave_acceso_sri"] = "";
      }
      fclose($archivo);

      return $data_result["cargaXML"]."&&&&".$data_result["clave_acceso_sri"];
    }
        
    if ($comprobante == 7) {

      $sql = "select * from datos_retencion_electronica inner join detalle_retencion_electronica on datos_retencion_electronica.orden_no = detalle_retencion_electronica.orden_no where datos_retencion_electronica.id_comprobante=" . $id;
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $array = $stmt->fetchAll();

      $xml_detalles = '';
      $total_iva_12 = 0;
      $base_imponible_12 = 0;
      $base_imponible_0 = 0;
      $total_iva_0 = 0;
      $sub_total = 0;
      foreach ($array as $campo) {
        $fecha_emision_sustento = date('d/m/Y', strtotime($campo['fecha_emision']));
        $xml_detalles .='<impuesto>
                                <codigo>' . $campo['codigo'] . '</codigo>
                                <codigoRetencion>' . $campo['codigo_retencion'] . '</codigoRetencion>
                                <baseImponible>' . $campo['base_imponible'] . '</baseImponible>
                                <porcentajeRetener>' . $campo['porcentaje_retencion'] . '</porcentajeRetener>
                                <valorRetenido>' . $campo['valor_retenido'] . '</valorRetenido>            
                                <codDocSustento>01</codDocSustento>
                                <numDocSustento>' . str_pad($campo['id_comprobante'], '15', '0', STR_PAD_LEFT) . '</numDocSustento>
                                <fechaEmisionDocSustento>' . $fecha_emision_sustento . '</fechaEmisionDocSustento>
                        </impuesto>';
      }

      $sql = "select * from datos_cabecera_electronica 
              inner join datos_retencion_electronica on datos_cabecera_electronica.orden_no = datos_retencion_electronica.orden_no 
              where datos_cabecera_electronica.id_comprobante='$id'";

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $factura = $stmt->fetchAll();
      foreach ($factura as $campo) {
        $campo['tipo_comporbante'] = 7;
        $nombre_comercial_empresa = $campo['nombre_comercial'];
        $razon_social_empresa = $campo['razon_social'];
        $direccion_empresa = $campo['direccion'];
        $direccion_sucursal = $campo['dir_matriz'];
        $telefono_empresa = $campo['telefono'];
        $email_empresa = $campo['correo'];
        $nro_documento_empresa = $campo['ruc_empresa'];
        $obligado_llevar_contabilidad = $campo['obligado_contabilidad'];

        $nro_comprovante = $campo['secuencial'];
        $codigo_establecimiento = str_pad($campo['estab'], '3', '0', STR_PAD_LEFT);
        $codigo_punto_emision = str_pad($campo['pto_emi'], '3', '0', STR_PAD_LEFT);
        $fecha_emision = $campo['fecha_emision'];
        $periodoFiscal = $campo['periodo_fiscal'];
        $tipoIdentificacionSujetoRetenido = str_pad($campo['tipo_identificacion_sujeto_retenido'], '2', '0', STR_PAD_LEFT);
        $razonSocialSujetoRetenido = $campo['razon_social_sujeto_retenido'];
        $identificación_sujeto_retenido = $campo['identificacion_sujeto_retenido'];

        $id_tipo_ambiente = $campo['ambiente'];
        $id_tipo_emision = 1;

        $id_tipo_documento = str_pad($campo['tipo_identificacion'], '1', '0', STR_PAD_LEFT);
        $razon_social = $campo['razon_social'];
        $nro_documento = $campo['ruc'];
        $direccion = $campo['direccion'];
        $subtotal_sin_impuesto = $sub_total;
        $totaliva = 0;
        $descuento = 0;
        $subtotal_con_impuesto = $sub_total;
        $impuesto = 0;
        $total = $sub_total;

        $direccion = $campo['direccion'];
        $telefono = $campo['telefono'];
        $email = $campo['correo'];

        $sri_clave_acceso_fecha_emison = date('dmY', strtotime($campo['fecha']));
        $sri_clave_acceso_tipo_comprobante = str_pad($campo['tipo_comporbante'],'2','0',STR_PAD_LEFT);
        $sri_clave_acceso_ruc = $campo['ruc_empresa'];
        $sri_clave_acceso_tipo_ambiente = $campo['ambiente'];
        $sri_clave_acceso_serie_establecimiento = $campo['establecimiento'];
        $sri_clave_acceso_serie_punto_emision = $campo['punto_emi'];
        $sri_clave_acceso_secuencial = str_pad($campo['secuencial'],'9','0',STR_PAD_LEFT);
        $sri_clave_acceso_cod_numerico = str_pad($campo['id'],'8','0',STR_PAD_LEFT);
        $sri_clave_acceso_tipo_emision = 1;
        $sri_clave_acceso_verificador = $this->validar_clave($sri_clave_acceso_fecha_emison.
                                                            $sri_clave_acceso_tipo_comprobante.
                                                            $sri_clave_acceso_ruc.
                                                            $sri_clave_acceso_tipo_ambiente.
                                                            $sri_clave_acceso_serie_establecimiento.
                                                            $sri_clave_acceso_serie_punto_emision.
                                                            $sri_clave_acceso_secuencial.
                                                            $sri_clave_acceso_cod_numerico.
                                                            $sri_clave_acceso_tipo_emision);
        $sri_clave_acceso = $sri_clave_acceso_fecha_emison.
                            $sri_clave_acceso_tipo_comprobante.
                            $sri_clave_acceso_ruc.
                            $sri_clave_acceso_tipo_ambiente.
                            $sri_clave_acceso_serie_establecimiento.
                            $sri_clave_acceso_serie_punto_emision.
                            $sri_clave_acceso_secuencial.
                            $sri_clave_acceso_cod_numerico.
                            $sri_clave_acceso_tipo_emision.
                            $sri_clave_acceso_verificador;
      }

      $xml = '<?xml version="1.0" encoding="UTF-8"?>
                <comprobanteRetencion id="comprobante" version="1.0.0">
                    <infoTributaria>
                        <ambiente>' . $id_tipo_ambiente . '</ambiente>
                        <tipoEmision>' . $id_tipo_emision . '</tipoEmision>
                        <razonSocial>' . $razon_social_empresa . '</razonSocial>
                        <nombreComercial>' . $nombre_comercial_empresa . '</nombreComercial>
                        <ruc>' . $nro_documento_empresa . '</ruc>
                        <claveAcceso>' . $sri_clave_acceso . '</claveAcceso>
                        <codDoc>07</codDoc>
                        <estab>' . $codigo_establecimiento . '</estab>
                        <ptoEmi>' . $codigo_punto_emision . '</ptoEmi>
                        <secuencial>' . str_pad($campo['secuencial'],'9','0',STR_PAD_LEFT) . '</secuencial>
                        <dirMatriz>' . $direccion_sucursal . '</dirMatriz>
                        </infoTributaria><infoCompRetencion>
                        <fechaEmision>' . date("d/m/Y", strtotime($campo['fecha'])) . '</fechaEmision>
                        <dirEstablecimiento>' . $direccion_empresa . '</dirEstablecimiento>
                        <obligadoContabilidad>' . $obligado_llevar_contabilidad . '</obligadoContabilidad>       
                        <tipoIdentificacionSujetoRetenido>' . $tipoIdentificacionSujetoRetenido . '</tipoIdentificacionSujetoRetenido>
                        
                        <razonSocialSujetoRetenido>' . $razonSocialSujetoRetenido . '</razonSocialSujetoRetenido>
                        <identificacionSujetoRetenido>' . $identificación_sujeto_retenido . '</identificacionSujetoRetenido>
                        <periodoFiscal>' . date("m/Y", strtotime($periodoFiscal)) . '</periodoFiscal>';
      $xml.='</infoCompRetencion><impuestos>';
      $xml.=$xml_detalles;
      $xml.='</impuestos>
              <infoAdicional>
                  <campoAdicional nombre="Direccion">' . $direccion . '</campoAdicional>
                  <campoAdicional nombre="Telefono">' . $telefono . '</campoAdicional>        
                  <campoAdicional nombre="Email">' . $email . '</campoAdicional>
              </infoAdicional>
          </comprobanteRetencion>';

     $nombre = "../../comprobantesGenerados/".$sri_clave_acceso.".xml";
      $archivo = fopen($nombre, "w+");
      if (fwrite($archivo, $xml)) {
        $data_result["cargaXML"] = "cargaOK";
        $data_result["clave_acceso_sri"] = $sri_clave_acceso;
      }
      else {
        $data_result["cargaXML"] = "cargaError";
        $data_result["clave_acceso_sri"] = "";
      }
      fclose($archivo);

      return $data_result["cargaXML"]."&&&&".$data_result["clave_acceso_sri"];
    }

  }
  public function validar_clave($clave) {
    if ($clave == "") {
      $verificado = false;
      return $verificado;
    }
    $x = 2;
    $sumatoria = 0;
    for ($i = strlen($clave) - 1; $i >= 0; $i--) {
      if ($x > 7) {
          $x = 2;
      }
      $sumatoria = $sumatoria + ($clave[$i] * $x);
      $x++;
    }
    $digito = $sumatoria % 11;
    $digito = 11 - $digito;
    switch ($digito) {
      case 10:
        $digito = "1";
        break;
      case 11:
        $digito = "0";
        break;
    }
    return $digito;
  }
}
?>