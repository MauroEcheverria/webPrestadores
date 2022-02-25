<?php
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();
    $sql="SELECT rol_id_rol, rol_rol 
    FROM dct_sistema_tbl_rol
    WHERE rol_estado = TRUE
    AND rol_id_rol NOT IN (1)
    ORDER BY 2;";
    $query=$pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["rol_id_rol"];
			$return_array[1] = $row["rol_rol"];
			array_push($return,$return_array);
		}
		echo json_encode($return);
  } catch (\PDOException $e) {
      echo $e->getMessage();
  }
?> 