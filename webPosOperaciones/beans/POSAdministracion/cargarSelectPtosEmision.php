<?php

require_once("../../../controller/funcionesCore.php");
require_once("../../../dctDatabase/Connection.php");
require_once("../../../dctDatabase/Parameter.php");
require_once("../../../controller/sesion.class.php");
app_error_reporting($app_error_reporting);
try {
    $sesion = new sesion();
    $dataSesion = $sesion->get('dataSesion');
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

    $idEmpresa = $_POST["slcEmpresaPe"];
    $idEstablecimiento = $_POST["slcEstablecimiento"];

    $sql = "select pe.epe_id_empresa_punto_emision, pe.epe_descripcion_punto_emisor
        from dct_pos_tbl_empresa_punto_emision pe
        inner join dct_pos_tbl_empresa_establecimiento est
                on pe.epe_id_empresa_establecimiento = est.est_id_empresa_establecimiento
        inner join dct_sistema_tbl_empresa emp
                on emp.emp_id_empresa = est.emp_id_empresa
        where emp.emp_id_empresa = :emp_id_empresa
        and est.est_id_empresa_establecimiento = :est_id_empresa_establecimiento
        and pe.epe_estado = 1";
    $query = $pdo->prepare($sql);
    $query->bindValue(':emp_id_empresa', $idEmpresa, PDO::PARAM_INT);
    $query->bindValue(':est_id_empresa_establecimiento', $idEstablecimiento, PDO::PARAM_INT);
    $query->execute();
    $rows = $query->fetchAll();

    if (!isset($rows) || sizeof($rows) == 0) {
        $data_result["message"] = "error_negocio";
        $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
        $data_result["dataModal_2"] = 'Información';
        $data_result["dataModal_3"] = "No existe un punto de emisión activo para el establecimiento enviado";
        $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
        $data_result["numLineaCodigo"] = __LINE__;
        echo json_encode($data_result);
        return;
    }

    $rpta_1 = "<option value=''>Seleccione una opción</option>";
    foreach ($rows as $row) {
        $rpta_1.="<option value='" . $row["epe_id_empresa_punto_emision"] . "'>" . $row["epe_descripcion_punto_emisor"] ."</option>";
    }

    $data_result["message"] = "saveOK";
    $data_result["catag"] = $rpta_1;
    $data_result["numLineaCodigo"] = __LINE__;
    echo json_encode($data_result);
} catch (Exception $ex) {
    $data_result["message"] = "salidaExcepcionCatch";
    $data_result["codError"] = $ex->getCode();
    $data_result["msjError"] = $ex->getMessage();
    $data_result["numLineaCodigo"] = __LINE__;
    echo json_encode($data_result);
}
?> 