<?php
  require_once("../../controller/sesion.class.php");
  require_once("../../controller/funcionesCore.php");
  require_once("../../dctDatabase/Connection.php");
  require_once("../../dctDatabase/Parameter.php");
  require_once('nusoap.php');
  require_once('generarPDF.php');
  //app_error_reporting($app_error_reporting);
  header("Content-Type: text/plain");
  try {
    $sesion = new sesion();
    $dataSesion = $sesion->get('dataSesion');
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();

    $sql_empresa="SELECT wsr_tipo_ambiente
                  FROM dct_sistema_tbl_empresa 
                  WHERE emp_id_empresa = 
                  (SELECT usr_id_empresa 
                    FROM dct_sistema_tbl_usuario 
                    WHERE usr_cod_usuario = :usr_cod_usuario);";
    $query_empresa=$pdo->prepare($sql_empresa);
    $query_empresa->bindValue(':usr_cod_usuario',$dataSesion["cod_system_user"],PDO::PARAM_INT);
    $query_empresa->execute();
    $row_empresa = $query_empresa->fetch(\PDO::FETCH_ASSOC);

    $sql_ws="SELECT wsr_url_1,wsr_url_2
              FROM dct_pos_tbl_ws_sri 
              WHERE wsr_tipo_ambiente = :wsr_tipo_ambiente
              AND wsr_descripcion = 'AUTORIZACION'
              AND wsr_estado = 1;";
    $query_ws=$pdo->prepare($sql_ws);
    $query_ws->bindValue(':wsr_tipo_ambiente',$row_empresa["wsr_tipo_ambiente"],PDO::PARAM_INT);
    $query_ws->execute();
    $row_ws = $query_ws->fetch(\PDO::FETCH_ASSOC);

    $claveAcceso = $_POST["claveAcceso"];
    $servicio = $row_ws["wsr_url_1"];
    $parametros = array();
    $parametros['claveAccesoComprobante'] = $claveAcceso;
    $client = new nusoap_client($servicio);
    $error = $client->getError();
    $client->soap_defencoding = 'utf-8';
    $result = $client->call("autorizacionComprobante",$parametros,$row_ws["wsr_url_2"]);

    if (!empty($result['autorizaciones']['autorizacion']['estado'])) {
      $sri_estado = utf8_decode($result['autorizaciones']['autorizacion']['estado']);
    }
    else {
      $sri_estado = "";
    }

    if (!empty($result['autorizaciones']['autorizacion']['numeroAutorizacion'])) {
      $sri_num_autorizacion = utf8_decode($result['autorizaciones']['autorizacion']['numeroAutorizacion']);
    }
    else {
      $sri_num_autorizacion = "";
    }

    if (!empty($result['autorizaciones']['autorizacion']['ambiente'])) {
      $sri_ambiente = utf8_decode($result['autorizaciones']['autorizacion']['ambiente']);
    }
    else {
      $sri_ambiente = "";
    }

    if (!empty($result['autorizaciones']['autorizacion']['fechaAutorizacion'])) {
      $sri_fecha_autorizacion = utf8_decode($result['autorizaciones']['autorizacion']['fechaAutorizacion']);
    }
    else {
      $sri_fecha_autorizacion = "";
    }

    if (is_array($result['autorizaciones']['autorizacion']['mensajes'])) {
      $sri_mensaje = $result['autorizaciones']['autorizacion']['mensajes']['mensaje']['mensaje'];
      $sri_identificador = $result['autorizaciones']['autorizacion']['mensajes']['mensaje']['identificador'];
      $sri_informacionAdicional = $result['autorizaciones']['autorizacion']['mensajes']['mensaje']['informacionAdicional'];
    }
    else {
      if (!empty($result['autorizaciones']['autorizacion']['mensajes'])) {
        $sri_mensaje = $result['autorizaciones']['autorizacion']['mensajes'];
      }
      else {
        $sri_mensaje = "";
      }
      $sri_identificador =  "";
      $sri_informacionAdicional =  "";
    }

    $data_result["sri_result"] = $result;
    $data_result["sri_informacionAdicional"] = $sri_informacionAdicional;
    $data_result["sri_estado"] = $sri_estado;
    $data_result["sri_num_autorizacion"] = $sri_num_autorizacion;
    $data_result["sri_ambiente"] = $sri_ambiente;
    $data_result["sri_fecha_autorizacion"] = $sri_fecha_autorizacion;
    $data_result["sri_mensaje"] = $sri_mensaje;
    $data_result["sri_identificador"] = $sri_identificador;

    if ($client->fault) {
      $data_result["message"] = "error_client_default";
      echo json_encode($data_result);
    } else {
      if ($client->getError()) {
        $data_result["message"] = "error_client_get_error";
        echo json_encode($data_result);
      } else {

        if ($result['autorizaciones']['autorizacion']['estado'] == 'AUTORIZADO') {

          //ACTUALIZAR FACTURA CON LOS DATOS DEL SRI
          //$result['autorizaciones']['autorizacion']['fechaAutorizacion']
          //$result['claveAccesoConsultada']

          $comprobante = $client->responseData;
          $xml = str_replace(['&lt;', '&gt;'], ['<', '>'], $comprobante);

          $nombre = "../../webPosOperaciones/comprobantesAutorizados/".$claveAcceso.".xml";
          $file_comprobante = fopen($nombre, "w+");
          if (fwrite($file_comprobante, $xml . PHP_EOL)) {
            $data_result["cargaXML"] = "cargaOK";
          }
          else {
            $data_result["cargaXML"] = "cargaError";
          }
          fclose($file_comprobante);

          //unlink("../../webPosOperaciones/comprobantesGenerados/".$result['claveAccesoConsultada'].".xml");
          //unlink("../../webPosOperaciones/comprobantesFirmados/".$result['claveAccesoConsultada'].".xml");
          
          $dataComprobante = simplexml_load_string($result['autorizaciones']['autorizacion']['comprobante']);
          if ($dataComprobante->infoFactura) {
            $facturaPDF = new generarPDF();
            $facturaPDF->facturaPDF($dataComprobante, $claveAcceso);
          }
          if ($dataComprobante->infoNotaCredito) {
            $facturaPDF = new generarPDF();
            $facturaPDF->notaCreditoPDF($dataComprobante, $claveAcceso);
          }
          if ($dataComprobante->infoCompRetencion) {
            $facturaPDF = new generarPDF();
            $facturaPDF->comprobanteRetencionPDF($dataComprobante, $claveAcceso);
          }
          if ($dataComprobante->infoGuiaRemision) {
            $facturaPDF = new generarPDF();
            $facturaPDF->guiaRemisionPDF($dataComprobante, $claveAcceso);
          }
          if ($dataComprobante->infoNotaDebito) {
            $facturaPDF = new generarPDF();
            $facturaPDF->notaDebitoPDF($dataComprobante, $claveAcceso);
          }

          $data_result["message_1"] = "autorizacion_comprobante_correcta";
          $data_result["message_2"] = "se_elimina_archivos";
          echo json_encode($data_result);
        }
        else if ($result['autorizaciones']['autorizacion']['estado'] == 'NO AUTORIZADO') {
          $data_result["message"] = "autorizacion_no_autorizada";
          echo json_encode($data_result);
        }
        else {
          $data_result["message"] = "autorizacion_no_identificada";
          echo json_encode($data_result);
        }

      }
    }

  } catch (Exception $ex) {
    $data_result["message"] = "salidaExcepcionCatch";
    $data_result["codError"] = $ex->getCode();
    $data_result["msjError"] = $ex->getMessage();
    $data_result["numLineaCodigo"] = __LINE__;
    echo json_encode($data_result);
  }
?>