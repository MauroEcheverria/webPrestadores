<?php
  require_once("../../controller/sesion.class.php");
  require_once("../../controller/funcionesCore.php");
  require_once("../../dctDatabase/Connection.php");
  require_once("../../dctDatabase/Parameter.php");
  require_once('nusoap.php');
  //app_error_reporting($app_error_reporting);
  header("Content-Type: text/plain");
  try {
    $sesion = new sesion();
    $dataSesion = $sesion->get('dataSesion');
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

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
        AND wsr_descripcion = 'RECEPCION'
        AND wsr_estado = 1;";
    $query_ws=$pdo->prepare($sql_ws);
    $query_ws->bindValue(':wsr_tipo_ambiente',$row_empresa["wsr_tipo_ambiente"],PDO::PARAM_INT);
    $query_ws->execute();
    $row_ws = $query_ws->fetch(\PDO::FETCH_ASSOC);

    $content = file_get_contents("../../webPosOperaciones/comprobantesFirmados/".$_POST["claveAcceso"].".xml");
    $mensaje = base64_encode($content);

    $servicio = $row_ws["wsr_url_1"];
    $parametros = array();
    $parametros['xml'] = $mensaje;

    $client = new nusoap_client($servicio);
    $client->soap_defencoding = 'utf-8';
    $result = $client->call("validarComprobante",$parametros,$row_ws["wsr_url_2"]); 

    if (!empty($result['estado'])) {
      $sri_estado = utf8_decode($result['estado']);
    }
    else {
      $sri_estado = "";
    }
    if (!empty($result['comprobantes']['comprobante']['claveAcceso'])) {
      $sri_clave_acceso = utf8_decode($result['comprobantes']['comprobante']['claveAcceso']);
    }
    else {
      $sri_clave_acceso = "";
    }
    if (!empty($result['comprobantes']['comprobante']['mensajes']['mensaje']['mensaje'])) {
      $sri_mensaje = utf8_decode($result['comprobantes']['comprobante']['mensajes']['mensaje']['mensaje']);
    }
    else {
      $sri_mensaje = "";
    }
    if (!empty($result['comprobantes']['comprobante']['mensajes']['mensaje']['identificador'])) {
      $sri_identificador = utf8_decode($result['comprobantes']['comprobante']['mensajes']['mensaje']['identificador']);
    }
    else {
      $sri_identificador = "";
    }
    if (!empty($result['comprobantes']['comprobante']['mensajes']['mensaje']['informacionAdicional'])) {
      $sri_info_adicional = utf8_decode($result['comprobantes']['comprobante']['mensajes']['mensaje']['informacionAdicional']);
    }
    else {
      $sri_info_adicional = "";
    }

    $data_result["sri_estado"] = $sri_estado;
    $data_result["sri_clave_acceso"] = $sri_clave_acceso;
    $data_result["sri_mensaje"] = $sri_mensaje;
    $data_result["sri_identificador"] = $sri_identificador;
    $data_result["sri_info_adicional"] = $sri_info_adicional;

    if ($client->fault) {
      $data_result["message"] = "error_client_default";
      echo json_encode($data_result);
    } else {
      if ($client->getError()) {
        $data_result["message"] = "error_client_get_error";
        echo json_encode($data_result);
      } else {
        if ($result['estado'] == 'RECIBIDA') {
          $data_result["message"] = "validacion_comprobante_correcta";
          echo json_encode($data_result);
        }
        else if ($result['estado'] == 'DEVUELTA') {
          $data_result["message"] = "se_elimina_archivos";
          echo json_encode($data_result);
        }
        else {
          $data_result["message"] = "validacion_no_identificada";
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
























    