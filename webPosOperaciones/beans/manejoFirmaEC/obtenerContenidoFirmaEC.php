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
    $sql="SELECT em_archivo_fact_elec 
        FROM dct_sistema_tbl_empresa 
        WHERE emp_id_empresa = 
        (SELECT usr_id_empresa 
          FROM dct_sistema_tbl_usuario 
          WHERE usr_cod_usuario = :usr_cod_usuario);";
    $query=$pdo->prepare($sql);
    $query->bindValue(':usr_cod_usuario',$dataSesion["cod_system_user"],PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(\PDO::FETCH_ASSOC);  

    if($query) {
      if ($row["em_archivo_fact_elec"] != "") {
        $data_result["contenidoFirmaEC"] = "<div><img src='../../../dist/img/modal_visto.png' width='30px' heigth='20px'> Al momento ya cuenta con una <strong>Firma Electrónica </strong>registrada en el sistema y su validez es hasta el <strong>2022-12-31</strong></div>";
      }
      else {
        $data_result["contenidoFirmaEC"] = "<div><img src='../../../dist/img/modal_alerta.png' width='30px' heigth='20px'> Al momento <strong>NO </strong> cuenta con una Firma Electrónica registrada, por favor registre una en la siguiente pestaña.</div>";
      }
      $data_result["message"] = "saveOK";
      $data_result["numLineaCodigo"] = __LINE__;
      echo json_encode($data_result);
    }
    else {
      $data_result["message"] = "saveError";
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