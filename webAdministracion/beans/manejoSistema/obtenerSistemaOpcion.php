<?php
  require_once("../../../controller/sesion.class.php");
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $sql="SELECT * FROM dct_sistema_tbl_opcion;";
    $query=$pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["opc_id_opcion"];
			$return_array[1] = $row["opc_opcion"];
      $return_array[2] = $row["opc_ruta"];

      $sql_apl="SELECT apl_aplicacion
                FROM dct_sistema_tbl_aplicacion
                WHERE apl_id_aplicacion = :apl_id_aplicacion;";
      $query_apl=$pdo->prepare($sql_apl);
      $query_apl->bindValue(':apl_id_aplicacion', $row["opc_id_aplicacion"],PDO::PARAM_INT);
      $query_apl->execute();
      $row_apl = $query_apl->fetch(\PDO::FETCH_ASSOC);

      $return_array[3] = $row_apl["apl_aplicacion"];
      $return_array[4] = $row["opc_orden"];
			$return_array[5] = $row["opc_estado"];
      $return_array[6] = null;
      $return_array[7] = $row["opc_id_aplicacion"];
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