<?php

require_once("../../../controller/sesion.class.php");
require_once("../../../controller/funcionesCore.php");
require_once("../../../dctDatabase/Connection.php");
require_once("../../../dctDatabase/Parameter.php");
app_error_reporting($app_error_reporting);
try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $sql = "select
					em.emp_id_empresa, 
					em.emp_empresa, 
					em.emp_ruc, 
					em.emp_vigencia_desde, 
					em.emp_vigencia_hasta, 
					c.ctg_descripcion tipo_plan,
					em.em_archivo_fact_elec,
					em.emp_estado, 
					em.ctg_id_catalogo,
                    em.emp_nom_comercial,
                    em.emp_contrib_especial,
                    em.emp_direccion_matriz,
                    ifnull(em.emp_obli_contabilidad,'NO') emp_obli_contabilidad,
                    em.wsr_tipo_ambiente,
                    s.ser_factura_serie,
                    s.ser_nota_credito_serie,
                    s.ser_nota_debito_serie,
                    s.ser_guia_remision_serie,
                    s.ser_comp_ret_serie
			FROM dct_sistema_tbl_empresa em
            inner join dct_sistema_tbl_catalogo c
				on em.ctg_id_catalogo = c.ctg_id_catalogo
			inner join dct_pos_tbl_empresa_serial s
				on em.emp_id_empresa = s.emp_id_empresa;";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
    $return = array();
    foreach ($row as $row) {
        $return_array[0] = $row["emp_id_empresa"];
        $return_array[1] = $row["emp_ruc"];
        $return_array[2] = $row["emp_empresa"];
        
        $return_array[3] = $row["emp_nom_comercial"];
        $return_array[4] = $row["emp_contrib_especial"];
        $return_array[5] = $row["emp_direccion_matriz"];
        $return_array[6] = $row["ser_factura_serie"];
        $return_array[7] = $row["ser_nota_credito_serie"];
        $return_array[8] = $row["ser_nota_debito_serie"];
        $return_array[9] = $row["ser_guia_remision_serie"];
        $return_array[10] = $row["ser_comp_ret_serie"];
        $return_array[11] = $row["emp_obli_contabilidad"];
        $return_array[12] = $row["wsr_tipo_ambiente"];
        
        $return_array[13] = $row["emp_vigencia_desde"];
        $return_array[14] = $row["emp_vigencia_hasta"];
        $return_array[15] = $row["tipo_plan"];
        $return_array[16] = $row["em_archivo_fact_elec"];
        $return_array[17] = $row["emp_estado"];
        $return_array[18] = null;
        $return_array[19] = $row["ctg_id_catalogo"];
        
        
        /*
        $return_array[3] = $row["emp_vigencia_desde"];
        $return_array[4] = $row["emp_vigencia_hasta"];
        $return_array[5] = $row["tipo_plan"];
        $return_array[6] = $row["em_archivo_fact_elec"];
        $return_array[7] = $row["emp_estado"];
        $return_array[8] = null;
        $return_array[9] = $row["ctg_id_catalogo"];
        */
        array_push($return, $return_array);
    }
    $return = array(
        "recordsTotal" => $query->rowCount(),
        "recordsFiltered" => $query->rowCount(),
        "data" => $return
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