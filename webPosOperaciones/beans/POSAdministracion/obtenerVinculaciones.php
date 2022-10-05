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

    $sql = "select uv.uep_id_usuario_epe, e.emp_id_empresa, uv.est_id_empresa_establecimiento, uv.epe_id_empresa_punto_emision
                ,e.emp_empresa, est.est_nombre establecimiento, pe.epe_descripcion_punto_emisor punto_emision
                ,uv.usr_cod_usuario, concat(u.usr_apellido_1,' ',u.usr_apellido_2,' ', u.usr_nombre_1) usuario
                ,uv.uep_estado
                from dct_pos_tbl_usuario_est_pun_emi uv
                inner join dct_pos_tbl_empresa_punto_emision pe on pe.epe_id_empresa_punto_emision = uv.epe_id_empresa_punto_emision
                inner join dct_pos_tbl_empresa_establecimiento est on est.est_id_empresa_establecimiento = uv.est_id_empresa_establecimiento
                inner join dct_sistema_tbl_empresa e on e.emp_id_empresa = est.emp_id_empresa
                inner join dct_sistema_tbl_usuario u on u.usr_cod_usuario = uv.usr_cod_usuario
                where e.emp_id_empresa = ifnull(:emp_id_empresa, e.emp_id_empresa);
            ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':emp_id_empresa', $idEmpresaUserLogin, PDO::PARAM_INT);
    $query->execute();
    $rows = $query->fetchAll();
    $return_array = array();
    $return = array();
    foreach ($rows as $row) {
        $return_array[0] = $row["uep_id_usuario_epe"];
        $return_array[1] = $row["emp_id_empresa"];
        $return_array[2] = $row["est_id_empresa_establecimiento"];
        $return_array[3] = $row["epe_id_empresa_punto_emision"];
        $return_array[4] = $row["usr_cod_usuario"];
        $return_array[5] = $row["usuario"];
        $return_array[6] = $row["emp_empresa"];
        $return_array[7] = $row["establecimiento"];
        $return_array[8] = $row["punto_emision"];
        $return_array[9] = $row["uep_estado"];
        
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
