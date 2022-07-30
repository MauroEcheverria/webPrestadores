<?php
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $sql="SELECT usr_cod_usuario FROM dct_sistema_tbl_usuario;";
    $query=$pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll();
    $cont=0;
		foreach ($row as $row) {
			if ($row["usr_cod_usuario"] == $_POST["cedula"]) {$cont++;}
		}
		if($cont==0) {		
      $data_result["message"] = "userOK";
      $data_result["numLineaCodigo"] = __LINE__;
      echo json_encode($data_result);
		}
		else {
      $data_result["message"] = "userError";
      $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
      $data_result["dataModal_2"] = 'Información';
      $data_result["dataModal_3"] = 'La cédula o pasaporte ingresado ya se encuentra registrado en nuestro sistema. Si tiene inconvenientes favor escribir a info@dreconstec.com';
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