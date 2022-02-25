<?php
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();
    $sql="SELECT app.apl_id_aplicacion, app.apl_aplicacion
          FROM dct_sistema_tbl_aplicacion app
          WHERE app.apl_id_aplicacion NOT IN (SELECT rp.rla_id_aplicacion
          FROM dct_sistema_tbl_rol_aplicacion rp
          WHERE rp.rla_id_rol = :rla_id_rol
          AND rp.rla_estado = 'AC')
          AND app.apl_estado = TRUE
          ORDER BY 1;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':rla_id_rol',cleanData("noLimite",0,"noMayuscula",$_POST["sys_selec_roles"]),PDO::PARAM_INT); 
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["apl_id_aplicacion"];
			$return_array[1] = $row["apl_aplicacion"];
			array_push($return,$return_array);
		}
		echo json_encode($return);
  } catch (\PDOException $e) {
      echo $e->getMessage();
  }
?> 