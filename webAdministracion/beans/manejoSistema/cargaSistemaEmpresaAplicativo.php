<?php
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

    $sql_1="SELECT apl_id_aplicacion ,apl_aplicacion 
          FROM dct_sistema_tbl_aplicacion
          WHERE apl_id_aplicacion  NOT IN (SELECT ape_id_aplicacion 
          FROM dct_sistema_tbl_aplicacion_empresa
          WHERE ape_id_empresa = :ape_id_empresa)";
    $query_1=$pdo->prepare($sql_1);
    $query_1->bindValue(':ape_id_empresa',cleanData("noLimite",0,"noMayuscula",$_POST["dataSelect"]),PDO::PARAM_INT); 
    $query_1->execute();
    $row_1 = $query_1->fetchAll();

    if($query_1) {

      $rpta_1="<option value=''>Seleccione una opción</option>";
      foreach ($row_1 as $row_1) {
        $rpta_1.="<option value='".$row_1["apl_id_aplicacion"]."'>".$row_1["apl_aplicacion"]."</option>";
      }

      $data_result["message"] = "saveOK";
      $data_result["dataSelect"] = $rpta_1;
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