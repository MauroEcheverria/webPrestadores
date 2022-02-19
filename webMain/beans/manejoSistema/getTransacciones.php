<?php
  require_once("../../../controller/misFunciones.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  require_once("../../../controller/sesion.class.php");
  app_error_reporting($app_error_reporting);
  try {
    $sesion = new sesion();
    $dataSesion = $sesion->get('dataSesion');
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();

    if ($dataSesion["id_role"] == 3) {
      $sql="SELECT 
            /*tt.trt_id, */
            (SELECT dd.dtf_descripcion FROM dct_parametro_tbl_datafast dd WHERE dd.dtf_tipo='RESULT' AND dd.dtf_codigo= tt.trt_code) trt_code,
            tt.trt_description, 
            CASE 
            WHEN tt.trt_estado='AP' THEN 'APROBADA'
            WHEN tt.trt_estado='PE' THEN 'PENDIENTE'
            WHEN tt.trt_estado='NA' THEN 'NO APROBADA'
            ELSE 'NO DEFINIDA' END trt_estado,
            tt.trt_auth_code, 
            /*tt.trt_batch_no, */
            (SELECT dd.dtf_descripcion FROM dct_parametro_tbl_datafast dd WHERE dd.dtf_tipo='RESPONSE' AND dd.dtf_codigo= tt.trt_response) trt_response, 
            (SELECT dd.dtf_descripcion FROM dct_parametro_tbl_datafast dd WHERE dd.dtf_tipo='BANCO' AND dd.dtf_codigo= tt.trt_acquirer_code) trt_acquirer_code, 
            /*tt.trt_reference_no, */
            (SELECT dd.dtf_descripcion FROM dct_parametro_tbl_datafast dd WHERE dd.dtf_tipo='TARJETA' AND dd.dtf_codigo= tt.trt_card_type) trt_card_type, 
            (SELECT pc.cta_costo_atencion FROM dct_salud_tbl_paciente_consulta pc WHERE pc.cta_id_consulta = tt.cta_id_consulta) costo_atencion,
            (SELECT pc.cta_id_descuentos FROM dct_salud_tbl_paciente_consulta pc WHERE pc.cta_id_consulta = tt.cta_id_consulta) cod_promocion,
            (SELECT pc.des_porcentaje FROM dct_salud_tbl_paciente_consulta pc WHERE pc.cta_id_consulta = tt.cta_id_consulta) porcentaje_descuento, 
            tt.trt_base_imp, 
            tt.trt_base_iva, 
            tt.trt_total,
            tt.trt_fecha_creacion
            FROM dct_sistema_tbl_transacciones tt
            WHERE tt.trt_estado NOT IN ('PE') 
            AND tt.cta_id_consulta IN (SELECT cta_id_consulta 
            FROM dct_salud_tbl_paciente_consulta cc
            WHERE cc.pct_id_paciente = (SELECT pp.pct_id_paciente  
            FROM dct_salud_tbl_paciente pp 
            WHERE pp.pct_cedula = :pct_cedula))";
      $query=$pdo->prepare($sql);
      $query->bindValue(':pct_cedula', cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]));
      $query->execute();
      $row = $query->fetchAll();
    }
    else {
      $sql="SELECT 
            /*tt.trt_id, */
            (SELECT dd.dtf_descripcion FROM dct_parametro_tbl_datafast dd WHERE dd.dtf_tipo='RESULT' AND dd.dtf_codigo= tt.trt_code) trt_code,
            tt.trt_description, 
            CASE 
            WHEN tt.trt_estado='AP' THEN 'APROBADA'
            WHEN tt.trt_estado='PE' THEN 'PENDIENTE'
            WHEN tt.trt_estado='NA' THEN 'NO APROBADA'
            ELSE 'NO DEFINIDA' END trt_estado,
            tt.trt_auth_code, 
            /*tt.trt_batch_no, */
            (SELECT dd.dtf_descripcion FROM dct_parametro_tbl_datafast dd WHERE dd.dtf_tipo='RESPONSE' AND dd.dtf_codigo= tt.trt_response) trt_response, 
            (SELECT dd.dtf_descripcion FROM dct_parametro_tbl_datafast dd WHERE dd.dtf_tipo='BANCO' AND dd.dtf_codigo= tt.trt_acquirer_code) trt_acquirer_code, 
            /*tt.trt_reference_no, */
            (SELECT dd.dtf_descripcion FROM dct_parametro_tbl_datafast dd WHERE dd.dtf_tipo='TARJETA' AND dd.dtf_codigo= tt.trt_card_type) trt_card_type,
            (SELECT pc.cta_costo_atencion FROM dct_salud_tbl_paciente_consulta pc WHERE pc.cta_id_consulta = tt.cta_id_consulta) costo_atencion,
            (SELECT pc.cta_id_descuentos FROM dct_salud_tbl_paciente_consulta pc WHERE pc.cta_id_consulta = tt.cta_id_consulta) cod_promocion,
            (SELECT pc.des_porcentaje FROM dct_salud_tbl_paciente_consulta pc WHERE pc.cta_id_consulta = tt.cta_id_consulta) porcentaje_descuento, 
            tt.trt_base_imp, 
            tt.trt_base_iva, 
            tt.trt_total,
            tt.trt_fecha_creacion
            FROM dct_sistema_tbl_transacciones tt
            WHERE tt.trt_estado NOT IN ('PE')";
      $query=$pdo->prepare($sql);
      $query->execute();
      $row = $query->fetchAll();
    }
    
    $return_array = array();
		$return= array();
		foreach ($row as $row) {
			$return_array[0] = $row["trt_code"];
			$return_array[1] = $row["trt_description"];
      $return_array[2] = $row["trt_estado"];
      $return_array[3] = $row["trt_auth_code"];
      $return_array[4] = $row["trt_response"];
      $return_array[5] = $row["trt_acquirer_code"];
      $return_array[6] = $row["trt_card_type"];

      $return_array[7] = $row["costo_atencion"];
      $return_array[8] = $row["cod_promocion"];
      $return_array[9] = $row["porcentaje_descuento"];

      $return_array[10] = $row["trt_base_imp"];
      $return_array[11] = $row["trt_base_iva"];
      $return_array[12] = $row["trt_total"];
      $return_array[13] = $row["trt_fecha_creacion"];
      $return_array[14] = NULL;
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