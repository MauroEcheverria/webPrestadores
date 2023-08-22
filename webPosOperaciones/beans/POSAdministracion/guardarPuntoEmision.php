<?php

require_once("../../../controller/funcionesCore.php");
require_once("../../../dctDatabase/Connection.php");
require_once("../../../dctDatabase/Parameter.php");
require_once("../../../controller/sesion.class.php");
require_once('../../../plugins/apiWhatsapp/ultramsg.class.php');
app_error_reporting($app_error_reporting);
try {
    $sesion = new sesion();
    $dataSesion = $sesion->get('dataSesion');
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

    if (!tokenSesionValido()) {
        return;
    }


    if ($_POST["tipo_form_pe"] == "New") {

        //validar datos duplicados
        $sqlV = "select pe.epe_id_empresa_punto_emision, pe.epe_descripcion_punto_emisor
                from dct_pos_tbl_empresa_punto_emision pe
                        inner join dct_pos_tbl_empresa_establecimiento est
                    on pe.epe_id_empresa_establecimiento = est.est_id_empresa_establecimiento
                where est.est_id_empresa_establecimiento = :est_id_empresa_establecimiento
                and (
                        pe.epe_cod_punto_emision = :epe_cod_punto_emision
                    or 
                    upper(trim(pe.epe_descripcion_punto_emisor)) = upper(trim(:epe_descripcion_punto_emisor))
                );";
        $queryV = $pdo->prepare($sqlV);
        $queryV->bindValue(':est_id_empresa_establecimiento', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEstablecimiento"]), PDO::PARAM_INT);
        $queryV->bindValue(':epe_descripcion_punto_emisor', cleanData("siLimite", 300, "noMayuscula", $_POST["peDescripcion"]), PDO::PARAM_STR);
        $queryV->bindValue(':epe_cod_punto_emision', cleanData("noLimite", 0, "noMayuscula", $_POST["peCodigo"]), PDO::PARAM_INT);
        $queryV->execute();
        $rowsV = $queryV->fetchAll();
        if (isset($rowsV) && sizeof($rowsV) > 0) {
            $data_result["message"] = "error_negocio";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = "El código ingresado o el nombre del punto de emisión, ya se encuentra registrado en el sistema.";
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
            $data_result["numLineaCodigo"] = __LINE__;
            echo json_encode($data_result);
            return;
        }

        //ingreso punto emision
        $sql_2 = "insert into dct_pos_tbl_empresa_punto_emision (
                    epe_id_empresa_establecimiento,epe_cod_punto_emision,epe_descripcion_punto_emisor,epe_estado
                    ,epe_usuario_creacion,epe_fecha_creacion,epe_ip_creacion
                    )
                    values (
                    :epe_id_empresa_establecimiento,:epe_cod_punto_emision,:epe_descripcion_punto_emisor,1
                    ,:epe_usuario_creacion,now(),:epe_ip_creacion
                    );";
        $query_2 = $pdo->prepare($sql_2);
        $query_2->bindValue(':epe_id_empresa_establecimiento', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEstablecimiento"]), PDO::PARAM_INT);
        $query_2->bindValue(':epe_cod_punto_emision', cleanData("noLimite", 0, "noMayuscula", $_POST["peCodigo"]), PDO::PARAM_INT);
        $query_2->bindValue(':epe_descripcion_punto_emisor', cleanData("siLimite", 300, "noMayuscula", $_POST["peDescripcion"]), PDO::PARAM_STR);
        $query_2->bindValue(':epe_usuario_creacion', cleanData("siLimite", 13, "noMayuscula", $dataSesion["cod_system_user"]), PDO::PARAM_STR);
        $query_2->bindValue(':epe_ip_creacion', getRealIP(), PDO::PARAM_STR);
        $query_2->execute();

        if (!$query_2) {
            $pdo->rollBack();
            $data_result["message"] = "saveError";
            $data_result["numLineaCodigo"] = __LINE__;
            echo json_encode($data_result);
            return;
        }

        $pdo->commit();
        $data_result["message"] = "saveOK";
        $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
        $data_result["dataModal_2"] = 'Información';
        $data_result["dataModal_3"] = 'Establecimiento registado de manera correcta.';
        $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-dismiss="modal">Cerrar</button>';
        $data_result["numLineaCodigo"] = __LINE__;
        echo json_encode($data_result);
        
        
    } else if ($_POST["tipo_form_pe"] == "Old") {
        //validar datos duplicados
       
        $sqlV = "select pe.epe_id_empresa_punto_emision, pe.epe_descripcion_punto_emisor
                from dct_pos_tbl_empresa_punto_emision pe
                        inner join dct_pos_tbl_empresa_establecimiento est
                    on pe.epe_id_empresa_establecimiento = est.est_id_empresa_establecimiento
                where est.est_id_empresa_establecimiento = :est_id_empresa_establecimiento
                and pe.epe_id_empresa_punto_emision != :epe_id_empresa_punto_emision
                and (
                        pe.epe_cod_punto_emision = :epe_cod_punto_emision
                    or 
                    upper(trim(pe.epe_descripcion_punto_emisor)) = upper(trim(:epe_descripcion_punto_emisor))
                );";
        
        $queryV = $pdo->prepare($sqlV);
        $queryV->bindValue(':epe_id_empresa_punto_emision', cleanData("noLimite", 0, "noMayuscula", $_POST["peIdPuntoEmision"]), PDO::PARAM_INT);
        $queryV->bindValue(':est_id_empresa_establecimiento', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEstablecimiento"]), PDO::PARAM_INT);
        $queryV->bindValue(':epe_descripcion_punto_emisor', cleanData("siLimite", 300, "noMayuscula", $_POST["peDescripcion"]), PDO::PARAM_STR);
        $queryV->bindValue(':epe_cod_punto_emision', cleanData("noLimite", 0, "noMayuscula", $_POST["peCodigo"]), PDO::PARAM_INT);
        $queryV->execute();
        $rowsV = $queryV->fetchAll();
        if (isset($rowsV) && sizeof($rowsV) > 0) {
            $data_result["message"] = "error_negocio";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = "El código ingresado o el nombre del punto de emisión , ya se encuentra registrado en el sistema.";
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
            $data_result["numLineaCodigo"] = __LINE__;
            echo json_encode($data_result);
            return;
        }
        
        //ACTUALIZAR
        $sql_2 = "update dct_pos_tbl_empresa_punto_emision
                    set epe_cod_punto_emision = :epe_cod_punto_emision,
                    epe_descripcion_punto_emisor = :epe_descripcion_punto_emisor,
                    epe_estado = :epe_estado,
                    epe_fecha_modificacion = now(),
                    epe_usuario_modificacion = :epe_usuario_modificacion,
                    epe_ip_modificacion = :epe_ip_modificacion
                    where epe_id_empresa_punto_emision = :epe_id_empresa_punto_emision;";
        $query_2 = $pdo->prepare($sql_2);
        $query_2->bindValue(':epe_cod_punto_emision', cleanData("noLimite", 0, "noMayuscula", $_POST["peCodigo"]), PDO::PARAM_INT);
        $query_2->bindValue(':epe_descripcion_punto_emisor', cleanData("siLimite", 300, "noMayuscula", $_POST["peDescripcion"]), PDO::PARAM_STR);
        $query_2->bindValue(':epe_estado', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEstadoPe"]), PDO::PARAM_INT);
        $query_2->bindValue(':epe_usuario_modificacion', cleanData("siLimite", 13, "noMayuscula", $dataSesion["cod_system_user"]), PDO::PARAM_STR);
        $query_2->bindValue(':epe_ip_modificacion', getRealIP(), PDO::PARAM_STR);
        $query_2->bindValue(':epe_id_empresa_punto_emision', cleanData("noLimite", 0, "noMayuscula", $_POST["peIdPuntoEmision"]), PDO::PARAM_INT);
        $query_2->execute();

         $pdo->commit();
            $data_result["message"] = "saveOK";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = 'Establecimiento modificado de manera correcta.';
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-dismiss="modal">Cerrar</button>';
            $data_result["numLineaCodigo"] = __LINE__;
            echo json_encode($data_result);
    }
    
    
} catch (Exception $ex) {
    $pdo->rollBack();
    $data_result["message"] = "salidaExcepcionCatch";
    $data_result["codError"] = $ex->getCode();
    $data_result["msjError"] = $ex->getMessage();
    $data_result["numLineaCodigo"] = __LINE__;
    echo json_encode($data_result);
}
?>