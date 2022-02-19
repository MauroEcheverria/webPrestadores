<?php
  require_once("../../../controller/misFunciones.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();
    $sql="SELECT app.apl_id_aplicacion, app.apl_aplicacion
          FROM dct_sistema_tbl_aplicacion app, dct_sistema_tbl_rol_aplicacion rp
          WHERE app.apl_id_aplicacion = rp.rla_id_aplicacion
          AND rp.rla_id_rol = :rla_id_rol
          AND app.apl_estado = TRUE
          AND rp.rla_estado = 'A'
          ORDER BY 1;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':rla_id_rol', cleanData("noLimite",0,"noMayuscula",$_POST["sys_selec_roles"])); 
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["apl_id_aplicacion"];
			$return_array[1] = $row["apl_aplicacion"];
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