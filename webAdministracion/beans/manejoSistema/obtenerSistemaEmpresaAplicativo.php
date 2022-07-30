<?php
  require_once("../../../controller/sesion.class.php");
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $sql="SELECT 
          ape_id_empresa, 
          ape_id_aplicacion,
          (SELECT emp.emp_empresa FROM dct_sistema_tbl_empresa emp WHERE emp.emp_id_empresa = ape_id_empresa) emp_empresa,
          (SELECT apl.apl_aplicacion FROM dct_sistema_tbl_aplicacion apl WHERE apl.apl_id_aplicacion  = ape_id_aplicacion) apl_aplicacion,
          ape_estado
          FROM dct_sistema_tbl_aplicacion_empresa;";
    $query=$pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["ape_id_empresa"];
			$return_array[1] = $row["ape_id_aplicacion"];
			$return_array[2] = $row["emp_empresa"];
      $return_array[3] = $row["apl_aplicacion"];
      $return_array[4] = $row["ape_estado"];
      $return_array[5] = null;
			array_push($return,$return_array);
		}
		$return = array(
					"recordsTotal"    => $query->rowCount(),
					"recordsFiltered" => $query->rowCount(),
					"data"            => $return
		);	
		echo json_encode($return);
  } catch (Exception $ex) {
    $data_result["message"] = "salidaExcepcionCatch";
    $data_result["codError"] = $ex->getCode();
    $data_result["msjError"] = $ex->getMessage();
    $data_result["numLineaCodigo"] = __LINE__;
    echo json_encode($data_result);
  }
?>