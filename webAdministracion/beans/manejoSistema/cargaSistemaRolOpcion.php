<?php
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

    $sql_1="SELECT opc_id_opcion,CONCAT((SELECT apl.apl_aplicacion 
        FROM dct_sistema_tbl_aplicacion apl 
        WHERE apl.apl_id_aplicacion = opc_id_aplicacion),' - ',opc_opcion) opc_opcion 
          FROM dct_sistema_tbl_opcion
          WHERE opc_id_opcion  NOT IN (SELECT rlo_id_opcion 
          FROM dct_sistema_tbl_rol_opcion
          WHERE rlo_id_rol  = :rlo_id_rol)";
    $query_1=$pdo->prepare($sql_1);
    $query_1->bindValue(':rlo_id_rol',cleanData("noLimite",0,"noMayuscula",$_POST["dataSelect"]),PDO::PARAM_INT); 
    $query_1->execute();
    $row_1 = $query_1->fetchAll();

    if($query_1) {

      $rpta_1="<option value=''>Seleccione una opción</option>";
      foreach ($row_1 as $row_1) {
        $rpta_1.="<option value='".$row_1["opc_id_opcion"]."'>".$row_1["opc_opcion"]."</option>";
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