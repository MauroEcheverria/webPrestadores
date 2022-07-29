<?php
  require_once("../../../controller/sesion.class.php");
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $sql="SELECT * FROM dct_sistema_tbl_aplicacion;";
    $query=$pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["apl_id_aplicacion"];
			$return_array[1] = $row["apl_aplicacion"];
			$return_array[2] = $row["apl_ruta"];
			$return_array[3] = $row["apl_nom_superior"];
      $return_array[4] = $row["apl_nom_inferior"];
			$return_array[5] = $row["apl_id_htm"];
			$return_array[6] = $row["apl_id_imagen"];
			$return_array[7] = $row["apl_estado"];
      $return_array[8] = null;
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
		echo json_encode($data_result);
	}
?>