<?php
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();
    $sql="SELECT opt.opc_id_opcion, app.apl_aplicacion, opt.opc_opcion
          FROM dct_sistema_tbl_opcion opt, dct_sistema_tbl_aplicacion app, dct_sistema_tbl_rol_aplicacion rp
          WHERE opt.opc_id_aplicacion = app.apl_id_aplicacion
          AND app.apl_id_aplicacion = rp.rla_id_aplicacion
          AND opt.opc_estado = 1
          AND app.apl_estado = 1
          AND opt.opc_id_opcion NOT IN (SELECT ro.rlo_id_opcion
          FROM dct_sistema_tbl_rol_opcion ro, dct_sistema_tbl_opcion opt, dct_sistema_tbl_aplicacion app
          WHERE ro.rlo_id_opcion = opt.opc_id_opcion
          AND opt.opc_id_aplicacion = app.apl_id_aplicacion
          AND ro.rlo_id_rol = :id_role_1
          AND ro.rlo_estado = 1)
          AND rp.rla_id_rol = :id_role_2
          AND rp.rla_estado = 1
          ORDER BY 2,3;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':id_role_1',cleanData("noLimite",0,"noMayuscula",$_POST["sys_selec_roles"]),PDO::PARAM_INT); 
    $query->bindValue(':id_role_2',cleanData("noLimite",0,"noMayuscula",$_POST["sys_selec_roles"]),PDO::PARAM_INT); 
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["opc_id_opcion"];
			$return_array[1] = $row["apl_aplicacion"];
      $return_array[2] = $row["opc_opcion"];
			array_push($return,$return_array);
		}
		echo json_encode($return);
  } catch (\PDOException $e) {
      echo $e->getMessage();
  }
?> 