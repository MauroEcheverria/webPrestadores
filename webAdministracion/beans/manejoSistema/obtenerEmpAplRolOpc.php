<?php
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

    $sql_1="SELECT emp_id_empresa,emp_empresa 
    FROM dct_sistema_tbl_empresa;";
    $query_1=$pdo->prepare($sql_1);
    $query_1->execute();
    $row_1 = $query_1->fetchAll();

    $sql_2="SELECT apl_id_aplicacion ,apl_aplicacion 
    FROM dct_sistema_tbl_aplicacion;";
    $query_2=$pdo->prepare($sql_2);
    $query_2->execute();
    $row_2 = $query_2->fetchAll();

    $sql_3="SELECT rol_id_rol,rol_rol 
    FROM dct_sistema_tbl_rol;";
    $query_3=$pdo->prepare($sql_3);
    $query_3->execute();
    $row_3 = $query_3->fetchAll();

    $sql_4="SELECT opc_id_opcion,
    CONCAT((SELECT apl.apl_aplicacion 
      FROM dct_sistema_tbl_aplicacion apl 
      WHERE apl.apl_id_aplicacion = opc_id_aplicacion),' - ',opc_opcion) opc_opcion
    FROM dct_sistema_tbl_opcion;";
    $query_4=$pdo->prepare($sql_4);
    $query_4->execute();
    $row_4 = $query_4->fetchAll();

    $rpta_1="<option value=''>Seleccione una opción</option>";
    foreach ($row_1 as $row_1) {
      $rpta_1.="<option value='".$row_1["emp_id_empresa"]."'>".$row_1["emp_empresa"]."</option>";
    }

    $rpta_2="<option value=''>Seleccione una opción</option>";
    foreach ($row_2 as $row_2) {
      $rpta_2.="<option value='".$row_2["apl_id_aplicacion"]."'>".$row_2["apl_aplicacion"]."</option>";
    }

    $rpta_3="<option value=''>Seleccione una opción</option>";
    foreach ($row_3 as $row_3) {
      $rpta_3.="<option value='".$row_3["rol_id_rol"]."'>".$row_3["rol_rol"]."</option>";
    }

    $rpta_4="<option value=''>Seleccione una opción</option>";
    foreach ($row_4 as $row_4) {
      $rpta_4.="<option value='".$row_4["opc_id_opcion"]."'>".$row_4["opc_opcion"]."</option>";
    }

    if($query_1 && $query_2) {
      $data_result["message"] = "saveOK";
      $data_result["dataEmpresa"] = $rpta_1;
      $data_result["dataAplicacion"] = $rpta_2;
      $data_result["dataRol"] = $rpta_3;
      $data_result["dataOpcion"] = $rpta_4;
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