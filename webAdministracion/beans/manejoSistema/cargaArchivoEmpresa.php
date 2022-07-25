<?php
  error_reporting(0);
  require_once("../../../controller/sesion.class.php");
  require_once("../../../controller/misFunciones.php");
  require_once("../../../database/Connection.php");
  require_once("../../../database/Parameter.php");
  use PostgreSQL\Connection as Connection;
  try {
    $pdo = Connection::get()->connect();
    $pdo->beginTransaction();
   
    if(isset($_FILES['arc_nombre_archivo']['name'])){
      /*
      1 MB-> BIT =  1048576
      2 MB-> BIT =  2097152
      3 MB-> BIT =  3145728
      4 MB-> BIT =  4194304
      5 MB-> BIT =  5242880
      */
      if ($_FILES["arc_nombre_archivo"]["size"] <= 3145728) {
        $valid_extensions = array("pdf","PDF");
        $imageFileType = strtolower(pathinfo($_FILES['arc_nombre_archivo']['name'],PATHINFO_EXTENSION));
        if(in_array(strtolower($imageFileType), $valid_extensions)) {

          $temp_nombre_archivo = str_replace(" ","_",$_FILES['arc_nombre_archivo']['name']);
          $temp_nombre_archivo = str_replace("-","_",$temp_nombre_archivo);
          $temp_nombre_archivo = str_replace(",","_",$temp_nombre_archivo);
          $temp_nombre_archivo = str_replace(".","_",$temp_nombre_archivo);
          $temp_nombre_archivo = str_replace("'","",$temp_nombre_archivo);
          $temp_nombre_archivo = str_replace(".PDF","",$temp_nombre_archivo);
          $temp_nombre_archivo = str_replace(".pdf","",$temp_nombre_archivo);
          $temp_nombre_archivo = str_replace("PDF","",$temp_nombre_archivo);
          $temp_nombre_archivo = str_replace("pdf","",$temp_nombre_archivo);
          $temp_nombre_archivo = strtolower($temp_nombre_archivo);
          $temp_nombre_archivo = $fechaActual_3."_".substr($temp_nombre_archivo,0,75).".pdf";
          $location = __DIR__."../../../uploadFile/".$temp_nombre_archivo;

          /*$sql_crt="SELECT pa.crt_valor_1 
          FROM dct_parametro_tbl_criterio pa 
          WHERE pa.crt_cod_criterio =:crt_cod_criterio
          AND crt_estado = 'A'";
          $query_crt=$pdo->prepare($sql_crt);
          $query_crt->bindValue(':crt_cod_criterio','ARC_MED_PACIENTE'); 
          $query_crt->execute();
          $row_crt = $query_crt->fetch(\PDO::FETCH_ASSOC);

          if ($query->rowCount() < $row_crt["crt_valor_1"]) {*/
            $sql_up="INSERT INTO app_flujo_procesos.seguimiento_archivo(id_cabecera_proceso, id_fase_proceso, id_responsable_proceso, arc_nombre_archivo, arc_estado, arc_fecha_creacion, arc_usuario_creacion, arc_ip_creacion)
                    VALUES (:id_cabecera_proceso, :id_fase_proceso, :id_responsable_proceso, :arc_nombre_archivo, 'A', now(), :arc_usuario_creacion, :arc_ip_creacion)";
            $query_up=$pdo->prepare($sql_up);
            $query_up->bindValue(':id_cabecera_proceso', clean_data($_POST["id_cabecera_proceso"]));
            $query_up->bindValue(':id_fase_proceso', clean_data($_POST["id_fase_proceso"]));
            $query_up->bindValue(':id_responsable_proceso', clean_data($_POST["id_responsable_proceso"]));
            $query_up->bindValue(':arc_nombre_archivo', $temp_nombre_archivo);
            $query_up->bindValue(':arc_usuario_creacion', clean_data($_POST["cod_system_user"]));
            $query_up->bindValue(':arc_ip_creacion', getRealIP());
            $query_up->execute();

            if($query_up) {

              if(move_uploaded_file($_FILES['arc_nombre_archivo']['tmp_name'],$location)){
                $pdo->commit();
                $data_result["message"] = "saveOK";
                echo json_encode($data_result);
              }
              else {
                $pdo->rollBack();
                $data_result["message"] = "saveError";
                echo json_encode($data_result);
              }

            }
            else {
              $pdo->rollBack();
              $data_result["message"] = "saveError";
              echo json_encode($data_result);
            }
          /*}
          else {
            $data_result["message"] = "cantArchivoExcedido";
            echo json_encode($data_result);
          }*/

        }
        else {
          $data_result["message"] = "extNoPermitida";
          echo json_encode($data_result);
        }
      }
      else {
        $data_result["message"] = "tamanoNoPermitida";
        echo json_encode($data_result);
      }
    }
    else {
      $data_result["message"] = "noExisteArhivo";
      echo json_encode($data_result);
    }


  } catch (\PDOException $e) {
      $pdo->rollBack();
      throw $e;
      echo $e->getMessage();
  }
?> 