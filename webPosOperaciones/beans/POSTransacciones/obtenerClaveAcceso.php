<?php
  require_once("../../../controller/sesion.class.php");
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $trans_desde_hasta = explode(" - ",cleanData("noLimite",0,"noMayuscula",$_POST["trans_desde_hasta"]));
    $sql="SELECT 
					ca.cla_id_clave_acceso,
					ca.cla_sri_clave_acceso,
					(SELECT em.emp_ruc  FROM dct_sistema_tbl_empresa em WHERE em.emp_id_empresa  = ca.emp_id_empresa) emp_ruc,
					(SELECT em.emp_empresa  FROM dct_sistema_tbl_empresa em WHERE em.emp_id_empresa  = ca.emp_id_empresa) emp_empresa,
					(SELECT cl.cli_identificacion  FROM dct_pos_tbl_cientes cl WHERE cl.cli_id_cliente   = ca.cli_id_cliente) cli_identificacion,
					(SELECT cl.cli_nombres  FROM dct_pos_tbl_cientes cl WHERE cl.cli_id_cliente   = ca.cli_id_cliente) cli_nombres,
					CAST(ca.cla_fecha_creacion AS DATE) cla_fecha_creacion,
					CONCAT(ca.cla_establecimiento,'-',ca.cla_punto_emision,'-',ca.cla_num_comprobante) num_comprobante,
					CASE 
					WHEN cla_estado_comprobante = 'PPR' THEN 'EN PROCESAMIENTO'
					WHEN cla_estado_comprobante = 'AUT' THEN 'AUTORIZADO'
					WHEN cla_estado_comprobante = 'NAT' THEN 'NO AUTORIZADO' 
					ELSE 'NO DEFINIDO'END cla_estado_comprobante
					FROM dct_pos_tbl_clave_acceso ca
					WHERE CAST(ca.cla_fecha_creacion AS DATE) BETWEEN :fechaDesde AND :fechaHasta;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':fechaDesde',$trans_desde_hasta[0],PDO::PARAM_STR);
    $query->bindValue(':fechaHasta',$trans_desde_hasta[1],PDO::PARAM_STR);
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["cla_id_clave_acceso"];
			$return_array[1] = $row["cla_sri_clave_acceso"];
			$return_array[2] = $row["emp_ruc"];
			$return_array[3] = $row["emp_empresa"];
      $return_array[4] = $row["cli_identificacion"];
      $return_array[5] = $row["cli_nombres"];
      $return_array[6] = $row["cla_fecha_creacion"];
			$return_array[7] = $row["num_comprobante"];
			$return_array[8] = $row["cla_estado_comprobante"];
      $return_array[9] = null;
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