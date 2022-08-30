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
    $pdo->beginTransaction();
   
    if(isset($_FILES['em_archivo_fact_elec']['name'])){
      /*
      1 MB-> BIT =  1048576
      2 MB-> BIT =  2097152
      3 MB-> BIT =  3145728
      4 MB-> BIT =  4194304
      5 MB-> BIT =  5242880
      */
      if ($_FILES["em_archivo_fact_elec"]["size"] <= 2097152) {
        $valid_extensions = array("P12","p12");
        $imageFileType = strtolower(pathinfo($_FILES['em_archivo_fact_elec']['name'],PATHINFO_EXTENSION));
        if(in_array(strtolower($imageFileType), $valid_extensions)) {

          $sql="SELECT emp_id_empresa, emp_ruc 
            FROM dct_sistema_tbl_empresa 
            WHERE emp_id_empresa = 
            (SELECT usr_id_empresa 
              FROM dct_sistema_tbl_usuario 
              WHERE usr_cod_usuario = :usr_cod_usuario);";
          $query=$pdo->prepare($sql);
          $query->bindValue(':usr_cod_usuario',$dataSesion["cod_system_user"],PDO::PARAM_INT);
          $query->execute();
          $row = $query->fetch(\PDO::FETCH_ASSOC);

          $temp_nombre_archivo = $row["emp_ruc"].".p12";
          $location = "../../cargaFirmaArchivo/".$temp_nombre_archivo;

          $sql_up="UPDATE dct_sistema_tbl_empresa 
                  SET em_archivo_fact_elec=:em_archivo_fact_elec,em_pass_fct_elec=:em_pass_fct_elec,
                  em_usuario_modificacion=:em_usuario_modificacion,
                  em_fecha_modificacion=now(),em_ip_modificacion=:em_ip_modificacion 
                  WHERE emp_id_empresa = :emp_id_empresa";
          $query_up=$pdo->prepare($sql_up);
          $query_up->bindValue(':emp_id_empresa',$row["emp_id_empresa"],PDO::PARAM_INT);
          $query_up->bindValue(':em_archivo_fact_elec',cleanData("siLimite",17,"noMayuscula",$temp_nombre_archivo),PDO::PARAM_STR);
          $query_up->bindValue(':em_pass_fct_elec',cleanData("siLimite",40,"noMayuscula",$_POST["em_pass_fct_elec"]),PDO::PARAM_STR);
          $query_up->bindValue(':em_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
          $query_up->bindValue(':em_ip_modificacion',getRealIP(),PDO::PARAM_STR);
          $query_up->execute();

          if($query_up) {
            if(move_uploaded_file($_FILES['em_archivo_fact_elec']['tmp_name'],$location)){
              $pdo->commit();
              $data_result["message"] = "saveOK";
              $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
              $data_result["dataModal_2"] = 'Información';
              $data_result["dataModal_3"] = 'Firma Electrónica registrada de manera correcta.';
              $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-dismiss="modal">Cerrar</button>';
              $data_result["numLineaCodigo"] = __LINE__;
              echo json_encode($data_result);
            }
            else {
              $pdo->rollBack();
              $data_result["message"] = "saveError";
              $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
              $data_result["dataModal_2"] = 'Información';
              $data_result["dataModal_3"] = "No se guardo el archivo de manera correcta.";
              $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
              $data_result["numLineaCodigo"] = __LINE__;
              echo json_encode($data_result);
            }

          }
          else {
            $pdo->rollBack();
            $data_result["message"] = "saveError";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = "No se guardo el archivo de manera correcta.";
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
            $data_result["numLineaCodigo"] = __LINE__;
            echo json_encode($data_result);
          }

        }
        else {
          $data_result["message"] = "extNoPermitida";
          $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
          $data_result["dataModal_2"] = 'Información';
          $data_result["dataModal_3"] = "Extensión de firma electrónica no es permitida.";
          $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
          $data_result["numLineaCodigo"] = __LINE__;
          echo json_encode($data_result);
        }
      }
      else {
        $data_result["message"] = "tamanoNoPermitida";
        $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
        $data_result["dataModal_2"] = 'Información';
        $data_result["dataModal_3"] = "El tamaño de la firma electrónica no es el admitido.";
        $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
        $data_result["numLineaCodigo"] = __LINE__;
        echo json_encode($data_result);
      }
    }
    else {
      $data_result["message"] = "noExisteArhivo";
      $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
      $data_result["dataModal_2"] = 'Información';
      $data_result["dataModal_3"] = "Se requiere que suba un archivo.";
      $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
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