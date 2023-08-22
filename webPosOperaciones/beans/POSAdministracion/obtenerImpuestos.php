<?php

/* 
Author Joel Jalón
 */

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
    
    

    $sql_1 = "select i.imp_codigo, i.imp_impuesto, i.imp_descripcion
                from dct_pos_tbl_impuesto i;";
    $query_1 = $pdo->prepare($sql_1);
    $query_1->execute();
    $rows = $query_1->fetchAll();

    if (!isset($rows) || sizeof($rows) == 0) {
        $data_result["message"] = "error_negocio";
        $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
        $data_result["dataModal_2"] = 'Información';
        $data_result["dataModal_3"] = "No existen impuestos configurados";
        $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
        $data_result["numLineaCodigo"] = __LINE__;
        echo json_encode($data_result);
        return;
    }

    $rpta_1 = "<option value=''>Seleccione una opción</option>";
    foreach ($rows as $row) {
        $rpta_1.="<option value='" . $row["imp_codigo"] . "'>" . $row["imp_impuesto"] . " - ". $row["imp_descripcion"] . "</option>";
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
