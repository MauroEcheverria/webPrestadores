<?php
  require_once("../../../controller/misFunciones.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {

    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();

    $sql_1 = "SELECT esp_id_especialidad, esp_especialidad FROM dct_salud_tbl_especialidad WHERE esp_estado = 'A'" ;
    $query_1=$pdo->prepare($sql_1);
    $query_1->execute();
    $row_1 = $query_1->fetchAll();

    $rpta_1="<option value=''>Seleccione una opción</option>";
    foreach ($row_1 as $row_1) {
      $rpta_1.="<option value='".$row_1["esp_id_especialidad"]."'>".$row_1["esp_especialidad"]."</option>";
    }

    $sql_2 = "SELECT usr_cod_usuario, usr_nom_completos FROM dct_sistema_tbl_usuario WHERE usr_id_rol = 4 AND usr_estado = 1" ;
    $query_2=$pdo->prepare($sql_2);
    $query_2->execute();
    $row_2 = $query_2->fetchAll();
    $rpta_2="<option value=''>Seleccione una opción</option>";
    foreach ($row_2 as $row_2) {
      $rpta_2.="<option value='".$row_2["usr_cod_usuario"]."'>".$row_2["usr_nom_completos"]."</option>";
    }

    $data_result["message"] = "saveOK";
    $data_result["rpta_1"] = $rpta_1;
    $data_result["rpta_2"] = $rpta_2;
    echo json_encode($data_result);
  }
  catch(SoapFault $exception){
      echo $exception->getMessage();  
  }
?>