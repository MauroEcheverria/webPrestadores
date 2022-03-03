<?php
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

    $sql_1="SELECT rol_id_rol,rol_rol 
    FROM dct_sistema_tbl_rol
    WHERE rol_estado = 'AC'
    AND rol_id_rol NOT IN (1);";
    $query_1=$pdo->prepare($sql_1);
    $query_1->execute();
    $row_1 = $query_1->fetchAll();

    $sql_2="SELECT emp_id_empresa,emp_empresa 
    FROM dct_sistema_tbl_empresa
    WHERE emp_estado = 'AC';";
    $query_2=$pdo->prepare($sql_2);
    $query_2->execute();
    $row_2 = $query_2->fetchAll();

    $rpta_1="<option value=''>Seleccione una opción</option>";
    foreach ($row_1 as $row_1) {
      $rpta_1.="<option value='".$row_1["rol_id_rol"]."'>".$row_1["rol_rol"]."</option>";
    }

    $rpta_2="<option value=''>Seleccione una opción</option>";
    foreach ($row_2 as $row_2) {
      $rpta_2.="<option value='".$row_2["emp_id_empresa"]."'>".$row_2["emp_empresa"]."</option>";
    }

    if($query_1 && $query_2) {
      $data_result["message"] = "saveOK";
      $data_result["roles"] = $rpta_1;
      $data_result["empresas"] = $rpta_2;
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