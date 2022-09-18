<?php


/**
 * Description of obtenerProductos
 *
 * @author joel
 */
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
    
    $isSuAdmin = (isset($dataSesion["id_role"]) && $dataSesion["id_role"] == 1);
    
     if (!$isSuAdmin)
    {
        //id empresa de persona logueada
        $idEmpresaUserLogin = !isset($dataSesion["usr_id_empresa"]) ? -1 : $dataSesion["usr_id_empresa"];  
    }
    else
    {
        $idEmpresaUserLogin = isset($_POST["slcEmpresa"]) && $_POST["slcEmpresa"] !=""  ? $_POST["slcEmpresa"] : null;
    }

    $sql = "select p.prs_id_prod_serv, p.emp_id_empresa, e.emp_empresa
            ,p.prs_codigo_item, p.prs_codigo_auxiliar, p.prs_descripcion_item, p.prs_valor_unitario,p.prs_estado
            ,ifnull(concat(iva.trf_porcentaje ,' - ', iva.trf_descripcion ),'-') desc_iva
            ,ifnull(concat(ice.trf_porcentaje ,' - ', ice.trf_descripcion ),'-') desc_ice
            ,ifnull(concat(irb.trf_porcentaje ,' - ', irb.trf_descripcion ),'-') desc_irb
            ,p.prs_iva_cod_impuesto,p.prs_ice_cod_impuesto,p.prs_irbpnr_cod_impuesto
            ,p.prs_iva_cod_tarifa,p.prs_ice_cod_tarifa,p.prs_irbpnr_cod_tarifa
            from dct_pos_tbl_producto_servicio p
            inner join dct_sistema_tbl_empresa e
                    on e.emp_id_empresa = p.emp_id_empresa
            left join dct_pos_tbl_tarifa_impuesto iva
                    on iva.imp_codigo = p.prs_iva_cod_impuesto
                and iva.trf_codigo = p.prs_iva_cod_tarifa
            left join dct_pos_tbl_tarifa_impuesto ice
                    on ice.imp_codigo = p.prs_ice_cod_impuesto
                and ice.trf_codigo = p.prs_ice_cod_tarifa
            left join dct_pos_tbl_tarifa_impuesto irb
                    on irb.imp_codigo = p.prs_irbpnr_cod_impuesto
                and irb.trf_codigo = p.prs_irbpnr_cod_tarifa
            where e.emp_id_empresa = ifnull(:emp_id_empresa, e.emp_id_empresa);
            ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':emp_id_empresa', $idEmpresaUserLogin, PDO::PARAM_INT);
    $query->execute();
    $rows = $query->fetchAll();
    $return_array = array();
    $return = array();
    foreach ($rows as $row) {
        $return_array[0] = $row["prs_id_prod_serv"];
        $return_array[1] = $row["emp_id_empresa"];
        $return_array[2] = $row["emp_empresa"];
        $return_array[3] = $row["prs_codigo_item"];
        $return_array[4] = $row["prs_codigo_auxiliar"];
        $return_array[5] = $row["prs_descripcion_item"];
        $return_array[6] = $row["prs_valor_unitario"];
        $return_array[7] = $row["desc_iva"];
        $return_array[8] = $row["desc_ice"];
        $return_array[9] = $row["desc_irb"];
        $return_array[10] = $row["prs_estado"];
        $return_array[11] = $row["prs_iva_cod_impuesto"];
        $return_array[12] = $row["prs_ice_cod_impuesto"];
        $return_array[13] = $row["prs_irbpnr_cod_impuesto"];
        $return_array[14] = $row["prs_iva_cod_tarifa"];
        $return_array[15] = $row["prs_ice_cod_tarifa"];
        $return_array[16] = $row["prs_irbpnr_cod_tarifa"];
        
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