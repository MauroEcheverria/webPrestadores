<?php
  require_once("../../../controller/sesion.class.php");
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
  	$sesion = new sesion();
    $dataSesion = $sesion->get('dataSesion');
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $trans_desde_hasta = explode(" - ",cleanData("noLimite",0,"noMayuscula",$_POST["trans_desde_hasta"]));

    if ($dataSesion["id_role"] == 1) {
    	$sql="SELECT 
						ca.ftr_id_factura_transaccion,
						ca.ftr_sri_clave_acceso,
						(SELECT em.emp_ruc  FROM dct_sistema_tbl_empresa em WHERE em.emp_id_empresa  = ca.emp_id_empresa) emp_ruc,
						(SELECT em.emp_empresa  FROM dct_sistema_tbl_empresa em WHERE em.emp_id_empresa  = ca.emp_id_empresa) emp_empresa,
						(SELECT cl.cli_identificacion  FROM dct_pos_tbl_cientes cl WHERE cl.cli_id_cliente   = ca.cli_id_cliente) cli_identificacion,
						(SELECT CONCAT(IFNULL(cli_nombre_1,''),' ',IFNULL(cli_nombre_2,''),' ',IFNULL(cli_apellido_1,''),' ',IFNULL(cli_apellido_2,'')) 
						FROM dct_pos_tbl_cientes cl WHERE cl.cli_id_cliente = ca.cli_id_cliente) cli_nombres,
						CAST(ca.ftr_fecha_creacion AS DATE) ftr_fecha_creacion,
						CONCAT(ca.ftr_establecimiento,'-',ca.ftr_punto_emision,'-',ca.ftr_num_comprobante) num_comprobante,
						CASE 
						WHEN ftr_estado_transaccion = 'TMP' THEN 'TEMPORAL'
						WHEN ftr_estado_transaccion = 'PPR' THEN 'EN PROCESAMIENTO'
						WHEN ftr_estado_transaccion = 'AUT' THEN 'AUTORIZADO'
						WHEN ftr_estado_transaccion = 'NAT' THEN 'NO AUTORIZADO'
						WHEN ftr_estado_transaccion = 'DVT' THEN 'DEVUELTO' 
						ELSE 'NO DEFINIDO'END ftr_estado_transaccion
						FROM dct_pos_tbl_factura_transaccion ca
						WHERE CAST(ca.ftr_fecha_creacion AS DATE) BETWEEN :fechaDesde AND :fechaHasta;";
	    $query=$pdo->prepare($sql);
	    $query->bindValue(':fechaDesde',$trans_desde_hasta[0],PDO::PARAM_STR);
	    $query->bindValue(':fechaHasta',$trans_desde_hasta[1],PDO::PARAM_STR);
	    $query->execute();
    }
    else {
    	$sql="SELECT 
						ca.ftr_id_factura_transaccion,
						ca.ftr_sri_clave_acceso,
						(SELECT em.emp_ruc  FROM dct_sistema_tbl_empresa em WHERE em.emp_id_empresa = ca.emp_id_empresa) emp_ruc,
						(SELECT em.emp_empresa  FROM dct_sistema_tbl_empresa em WHERE em.emp_id_empresa = ca.emp_id_empresa) emp_empresa,
						(SELECT cl.cli_identificacion  FROM dct_pos_tbl_cientes cl WHERE cl.cli_id_cliente = ca.cli_id_cliente) cli_identificacion,
						(SELECT CONCAT(IFNULL(cli_nombre_1,''),' ',IFNULL(cli_nombre_2,''),' ',IFNULL(cli_apellido_1,''),' ',IFNULL(cli_apellido_2,'')) 
						FROM dct_pos_tbl_cientes cl WHERE cl.cli_id_cliente = ca.cli_id_cliente) cli_nombres,
						CAST(ca.ftr_fecha_creacion AS DATE) ftr_fecha_creacion,
						CONCAT(ca.ftr_establecimiento,'-',ca.ftr_punto_emision,'-',ca.ftr_num_comprobante) num_comprobante,
						CASE 
						WHEN ftr_estado_transaccion = 'TMP' THEN 'TEMPORAL'
						WHEN ftr_estado_transaccion = 'PPR' THEN 'EN PROCESAMIENTO'
						WHEN ftr_estado_transaccion = 'AUT' THEN 'AUTORIZADO'
						WHEN ftr_estado_transaccion = 'NAT' THEN 'NO AUTORIZADO' 
						WHEN ftr_estado_transaccion = 'DVT' THEN 'DEVUELTO' 
						ELSE 'NO DEFINIDO'END ftr_estado_transaccion
						FROM dct_pos_tbl_factura_transaccion ca
						WHERE CAST(ca.ftr_fecha_creacion AS DATE) BETWEEN :fechaDesde AND :fechaHasta
						AND emp_id_empresa=:emp_id_empresa;";
	    $query=$pdo->prepare($sql);
	    $query->bindValue(':fechaDesde',$trans_desde_hasta[0],PDO::PARAM_STR);
	    $query->bindValue(':fechaHasta',$trans_desde_hasta[1],PDO::PARAM_STR);
	    $query->bindValue(':emp_id_empresa',$dataSesion["usr_id_empresa"],PDO::PARAM_STR);
	    $query->execute();
    }

    $row = $query->fetchAll();
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["ftr_id_factura_transaccion"];
			$return_array[1] = $row["ftr_sri_clave_acceso"];
			$return_array[2] = $row["emp_ruc"];
			$return_array[3] = $row["emp_empresa"];
			$return_array[4] = $row["cli_identificacion"];
			$return_array[5] = $row["cli_nombres"];
			$return_array[6] = $row["ftr_fecha_creacion"];
			$return_array[7] = $row["num_comprobante"];
			$return_array[8] = $row["ftr_estado_transaccion"];
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