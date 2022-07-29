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
					em.emp_id_empresa, 
					em.emp_empresa, 
					em.emp_ruc, 
					em.emp_vigencia_desde, 
					em.emp_vigencia_hasta, 
					(SELECT ctg_descripcion FROM dct_sistema_tbl_catalogo WHERE ctg_id_catalogo = em.ctg_id_catalogo) tipo_plan,
					em.em_archivo_fact_elec,
					em.emp_estado, 
					em.ctg_id_catalogo
					FROM dct_sistema_tbl_empresa em;";
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
      $return_array[5] = $row["tipo_plan"];
      $return_array[6] = $row["em_archivo_fact_elec"];
			$return_array[7] = $row["emp_estado"];
      $return_array[8] = null;
      $return_array[9] = $row["ctg_id_catalogo"];
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