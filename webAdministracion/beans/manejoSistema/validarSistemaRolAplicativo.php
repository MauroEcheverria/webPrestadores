<?php
  require_once("../../../controller/sesion.class.php");
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $sql="SELECT rla_estado
          FROM dct_sistema_tbl_rol_aplicacion
          WHERE rla_id_rol = :rla_id_rol
          AND rla_id_aplicacion =:rla_id_aplicacion;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':rla_id_rol',$_POST["rol_rol_2"],PDO::PARAM_INT);
    $query->bindValue(':rla_id_aplicacion',$_POST["apl_aplicacion_2"],PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(\PDO::FETCH_ASSOC);
    if ($query->rowCount() == 0) {
      $data_result["message"] = "regNulo";
      $data_result["numLineaCodigo"] = __LINE__;
      echo json_encode($data_result);
    }
    else {
      $data_result["message"] = "regRepetido";
      $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
      $data_result["dataModal_2"] = 'Información';
      $data_result["dataModal_3"] = 'Las opciones seleccionadas ya se encuentran registradas, revise la tabla.';
      $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
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