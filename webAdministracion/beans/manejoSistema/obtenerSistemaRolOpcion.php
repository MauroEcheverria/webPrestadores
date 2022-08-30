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
          rlo_id_rol , 
          rlo_id_opcion ,
          (SELECT emp.rol_rol FROM dct_sistema_tbl_rol emp WHERE emp.rol_id_rol = rlo_id_rol ) rol_rol,
          (SELECT id.apl_aplicacion FROM dct_sistema_tbl_aplicacion id WHERE id.apl_id_aplicacion = (SELECT rol.opc_id_aplicacion FROM dct_sistema_tbl_opcion rol WHERE rol.opc_id_opcion  = rlo_id_opcion)) apl_aplicacion,
          (SELECT apl.opc_opcion FROM dct_sistema_tbl_opcion apl WHERE apl.opc_id_opcion  = rlo_id_opcion ) opc_opcion,
          rlo_estado 
          FROM dct_sistema_tbl_rol_opcion;";
    $query=$pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["rlo_id_rol"];
			$return_array[1] = $row["rlo_id_opcion"];
			$return_array[2] = $row["rol_rol"];
      $return_array[3] = $row["apl_aplicacion"];
      $return_array[4] = $row["opc_opcion"];
      $return_array[5] = $row["rlo_estado"];
      $return_array[6] = null;
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