<?php
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  require_once("../../../controller/sesion.class.php");
  require_once('../../../plugins/apiWhatsapp/ultramsg.class.php');
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
      if ($_FILES["em_archivo_fact_elec"]["size"] <= 3145728) {
        $valid_extensions = array("P12","p12");
        $imageFileType = strtolower(pathinfo($_FILES['em_archivo_fact_elec']['name'],PATHINFO_EXTENSION));
        if(in_array(strtolower($imageFileType), $valid_extensions)) {

          $temp_nombre_archivo = $_POST["emp_ruc"].".p12";
          //$location = __DIR__."../../../uploadP12/".$temp_nombre_archivo;
          $location = "C:\\\\xampp\\\\htdocs\\\\GIT\\\\webPrestadores\\\\webPosOperaciones\\\\uploadP12\\\\".$temp_nombre_archivo;

          $sql_up="UPDATE dct_sistema_tbl_empresa 
                  SET em_archivo_fact_elec=:em_archivo_fact_elec,em_pass_fct_elec=:em_pass_fct_elec,
                  em_usuario_modificacion=:em_usuario_modificacion,
                  em_fecha_modificacion=now(),em_ip_modificacion=:em_ip_modificacion 
                  WHERE emp_id_empresa = :emp_id_empresa";
          $query_up=$pdo->prepare($sql_up);
          $query_up->bindValue(':emp_id_empresa',cleanData("noLimite",0,"noMayuscula",$_POST["emp_id_empresa"]),PDO::PARAM_INT);
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
              $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
              echo json_encode($data_result);
            }
            else {
              $pdo->rollBack();
              $data_result["message"] = "saveError";
              $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
              $data_result["dataModal_2"] = 'Información';
              $data_result["dataModal_3"] = "No se guardo el archivo de manera correcta.";
              $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
              echo json_encode($data_result);
            }

          }
          else {
            $pdo->rollBack();
            $data_result["message"] = "saveError";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = "No se guardo el archivo de manera correcta.";
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
            echo json_encode($data_result);
          }

        }
        else {
          $data_result["message"] = "extNoPermitida";
          $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
          $data_result["dataModal_2"] = 'Información';
          $data_result["dataModal_3"] = "Extensión de firma electrónica no es permitida.";
          $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
          echo json_encode($data_result);
        }
      }
      else {
        $data_result["message"] = "tamanoNoPermitida";
        $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
        $data_result["dataModal_2"] = 'Información';
        $data_result["dataModal_3"] = "El tamaño de la firma electrónica no es el admitido.";
        $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
        echo json_encode($data_result);
      }
    }
    else {
      $data_result["message"] = "noExisteArhivo";
      $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
      $data_result["dataModal_2"] = 'Información';
      $data_result["dataModal_3"] = "Se requiere que suba un archivo.";
      $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
      echo json_encode($data_result);
    }

  } catch (\PDOException $e) {
    echo $e->getMessage();
  }
?> 