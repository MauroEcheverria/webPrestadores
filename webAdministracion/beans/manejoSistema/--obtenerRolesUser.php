<?php
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  use PostgreSQL\Connection as Connection;
  try {
    $pdo = Connection::get()->connect();
    $pdo->beginTransaction();
    $sql="SELECT app.id_application, app.aplication
          FROM system.application app
          WHERE app.id_application NOT IN (SELECT rp.id_application
          FROM system.role_app rp
          WHERE rp.id_role = :id_role)
          AND app.status = 1
          ORDER BY 1;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':id_role',cleanData("noLimite",0,"noMayuscula",$_POST["sys_selec_roles"]),PDO::PARAM_INT); 
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["id_application"];
			$return_array[1] = $row["aplication"];
			array_push($return,$return_array);
		}
		echo json_encode($return);
  } catch (\PDOException $e) {
      echo $e->getMessage();
  }
?> 