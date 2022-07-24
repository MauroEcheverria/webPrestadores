<?php
  require_once("../../../controller/sesion.class.php");
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $sql="SELECT * FROM dct_sistema_tbl_empresa;";
    $query=$pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["emp_id_empresa"];
			$return_array[1] = $row["emp_ruc"];
			$return_array[2] = $row["emp_empresa"];
			$return_array[3] = $row["emp_vigencia_desde"];
      $return_array[4] = $row["emp_vigencia_hasta"];
			$return_array[5] = $row["emp_estado"];
      $return_array[6] = null;
			array_push($return,$return_array);
		}
		$return = array(
					"recordsTotal"    => $query->rowCount(),
					"recordsFiltered" => $query->rowCount(),
					"data"            => $return
		);	
		echo json_encode($return);
  } catch (\PDOException $e) {
      echo $e->getMessage();
  }
?>