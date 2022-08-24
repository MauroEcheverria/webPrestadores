<?php
  require_once("../../../controller/sesion.class.php");
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $sesion = new sesion();
    $dataSesion = $sesion->get('dataSesion');
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();

    $sql="SELECT cli_identificacion FROM dct_pos_tbl_cientes WHERE emp_id_empresa = :emp_id_empresa;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':emp_id_empresa',cleanData("noLimite",0,"noMayuscula",$dataSesion["usr_id_empresa"]),PDO::PARAM_INT); 
    $query->execute();
    $row = $query->fetchAll();
    
    $cont=0;
		foreach ($row as $row) {
			if ($row["cli_identificacion"] == $_POST["cli_identificacion_form"]) {$cont++;}
		}
		if($cont==0) {		
      $data_result["message"] = "saveOK";
      $data_result["numLineaCodigo"] = __LINE__;
      echo json_encode($data_result);
		}
		else {
      $data_result["message"] = "userError";
      $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
      $data_result["dataModal_2"] = 'Información';
      $data_result["dataModal_3"] = 'La identificación del cliente ya se encuentra registrada en nuestro sistema.';
      $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
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