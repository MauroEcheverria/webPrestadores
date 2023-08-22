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
    
    //id empresa de persona logueada
    $idEmpresaUserLogin = !isset($dataSesion["usr_id_empresa"]) ? null : $dataSesion["usr_id_empresa"];

    $sql = "select est.est_id_empresa_establecimiento, emp.emp_id_empresa
                ,emp.emp_empresa
                ,est.est_nombre
                ,est.est_cod_establecimiento
                ,est.est_direccion_emisor
                ,est.est_es_matriz
                ,est.est_estado
        from dct_pos_tbl_empresa_establecimiento est
        inner join dct_sistema_tbl_empresa emp
                on emp.emp_id_empresa = est.emp_id_empresa
        where emp.emp_id_empresa = ifnull(:emp_id_empresa, emp.emp_id_empresa)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':emp_id_empresa', $idEmpresaUserLogin, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetchAll();
    $return_array = array();
    $return = array();
    foreach ($row as $row) {
        $return_array[0] = $row["est_id_empresa_establecimiento"];
        $return_array[1] = $row["emp_id_empresa"];
        $return_array[2] = $row["emp_empresa"];
        $return_array[3] = $row["est_cod_establecimiento"];
        $return_array[4] = $row["est_direccion_emisor"];
        $return_array[5] = $row["est_nombre"];
        $return_array[6] = $row["est_es_matriz"];
        $return_array[7] = $row["est_estado"];
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