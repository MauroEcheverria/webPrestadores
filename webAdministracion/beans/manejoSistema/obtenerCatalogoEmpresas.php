<?php
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

    $sql_1="SELECT ctg_id_catalogo,ctg_descripcion 
          FROM dct_sistema_tbl_catalogo
          WHERE ctg_estado = 1
          AND ctg_tipo = 'EMPRE';";
    $query_1=$pdo->prepare($sql_1);
    $query_1->execute();
    $row_1 = $query_1->fetchAll();

    $rpta_1="<option value=''>Seleccione una opción</option>";
    foreach ($row_1 as $row_1) {
      $rpta_1.="<option value='".$row_1["ctg_id_catalogo"]."'>".$row_1["ctg_descripcion"]."</option>";
    }

    if($query_1) {
      $data_result["message"] = "saveOK";
      $data_result["catag"] = $rpta_1;
      echo json_encode($data_result);
    }
    else {
      $data_result["message"] = "saveError";
      echo json_encode($data_result);
    }

  } catch (\PDOException $e) {
      echo $e->getMessage();
  }
?> 