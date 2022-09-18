<?php

/* 
Author Joel Jalón
 */

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


    if ($_POST["tipo_form_prod"] == "New") {
        
        $arrayImp = [];
        $codigoIva = null;
        $codigoIce = null;
        $codigoIbr = null;
        
        $tarifaIva = null;
        $tarifaIce = null;
        $tarifaIbr = null;
        
        if (isset($_POST["slcIva"]) && $_POST["slcIva"] !="")
        {
            array_push($arrayImp, $_POST["slcIva"]);
            $codigoIva = $CODIGO_IVA;
            $tarifaIva = $_POST["slcIva"];
        }
            
        
        if (isset($_POST["slcIce"]) && $_POST["slcIce"] !="")
        {
            array_push($arrayImp, $_POST["slcIce"]);
            $codigoIce = $CODIGO_ICE;
            $tarifaIce = $_POST["slcIce"];
        }
        
        if (isset($_POST["slcIbr"]) && $_POST["slcIbr"] !="")
        {
            array_push($arrayImp, $_POST["slcIbr"]);
            $codigoIbr = $CODIGO_IRBPNR;
            $tarifaIbr = $_POST["slcIbr"];
        }
        
        
        if(count(array_unique($arrayImp))<count($arrayImp))
        {
            $data_result["message"] = "error_negocio";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = "No se pueden ingresar impuestos duplicados!";
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
            $data_result["numLineaCodigo"] = __LINE__;
            echo json_encode($data_result);
            return;
        }

        /*
        //validar impuestos duplicados
        $objJson = json_decode($_POST["Impuestos"]);
        $arrayDuplicados = array_unique($objJson,SORT_REGULAR);
        */

        //validar precio
        try {

            $decimalValido = isset($_POST["pPrecioUnitario"]) && filter_var($_POST["pPrecioUnitario"], FILTER_VALIDATE_FLOAT);
            
            if (!$decimalValido){
                $data_result["message"] = "error_negocio";
                $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
                $data_result["dataModal_2"] = 'Información';
                $data_result["dataModal_3"] = "valor de precio unitario es incorrecto! ";
                $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
                $data_result["numLineaCodigo"] = __LINE__;
                echo json_encode($data_result);
                return;
            }
            $puFormateado = number_format($_POST["pPrecioUnitario"], 2, '.', '');
            
        } catch (Exception $exn) {
            //echo $exn->getTraceAsString();
            $data_result["message"] = "error_negocio";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = "valor de precio unitario es incorrecto! ".$exn->getMessage();
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
            $data_result["numLineaCodigo"] = __LINE__;
            echo json_encode($data_result);
            return;
        }



        //validar datos duplicados
        //codigo
        $sqlV = "select p.prs_codigo_item, p.prs_codigo_auxiliar, p.prs_descripcion_item
                    from dct_pos_tbl_producto_servicio p
                    where p.emp_id_empresa = :emp_id_empresa
                    and (
                                    upper(trim(p.prs_codigo_item)) = upper(trim(:prs_codigo_item))
                    )
                    ;";
        $queryV = $pdo->prepare($sqlV);
        $queryV->bindValue(':emp_id_empresa', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEmpresaP"]), PDO::PARAM_INT);
        $queryV->bindValue(':prs_codigo_item', cleanData("siLimite", 5, "noMayuscula", $_POST["pCodigoItem"]), PDO::PARAM_STR);
        $queryV->execute();
        $rowsV = $queryV->fetchAll();
        if (isset($rowsV) && sizeof($rowsV) > 0) {
            $data_result["message"] = "error_negocio";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = "El código ingresado ya se encuentra registrado en el sistema.";
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
            $data_result["numLineaCodigo"] = __LINE__;
            echo json_encode($data_result);
            return;
        }
        
        //codigo auxiliar
        if (isset($_POST["pCodigoAuxiliar"]) && $_POST["pCodigoAuxiliar"]!="" )
        {
            $sqlV = "select p.prs_codigo_item, p.prs_codigo_auxiliar, p.prs_descripcion_item
                    from dct_pos_tbl_producto_servicio p
                    where p.emp_id_empresa = :emp_id_empresa
                    and (
                         upper(trim(p.prs_codigo_auxiliar)) = upper(trim(:prs_codigo_auxiliar))
                    )
                    ;";
            $queryV = $pdo->prepare($sqlV);
            $queryV->bindValue(':emp_id_empresa', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEmpresaP"]), PDO::PARAM_INT);
            $queryV->bindValue(':prs_codigo_auxiliar', cleanData("siLimite", 5, "noMayuscula", $_POST["pCodigoAuxiliar"]), PDO::PARAM_STR);
            $queryV->execute();
            $rowsV = $queryV->fetchAll();
            if (isset($rowsV) && sizeof($rowsV) > 0) {
                $data_result["message"] = "error_negocio";
                $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
                $data_result["dataModal_2"] = 'Información';
                $data_result["dataModal_3"] = "El código auxiliar ingresado ya se encuentra registrado en el sistema.";
                $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
                $data_result["numLineaCodigo"] = __LINE__;
                echo json_encode($data_result);
                return;
            }
        }
 
        //ingreso registro
        $sql_2 = "insert into dct_pos_tbl_producto_servicio(emp_id_empresa,prs_codigo_item,prs_codigo_auxiliar,prs_descripcion_item,prs_valor_unitario
                        ,prs_iva_cod_impuesto,prs_iva_cod_tarifa,prs_ice_cod_impuesto,prs_ice_cod_tarifa,prs_irbpnr_cod_impuesto,prs_irbpnr_cod_tarifa
                        ,prs_estado,prs_usuario_creacion,prs_fecha_creacion,prs_ip_creacion)
                        values (
                        :emp_id_empresa,:prs_codigo_item,:prs_codigo_auxiliar,:prs_descripcion_item,:prs_valor_unitario
                        ,:prs_iva_cod_impuesto,:prs_iva_cod_tarifa,:prs_ice_cod_impuesto,:prs_ice_cod_tarifa,:prs_irbpnr_cod_impuesto,:prs_irbpnr_cod_tarifa
                        ,1,:prs_usuario_creacion,now(),:prs_ip_creacion
                        );";
        $query_2 = $pdo->prepare($sql_2);
        $query_2->bindValue(':emp_id_empresa', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEmpresaP"]), PDO::PARAM_INT);
        $query_2->bindValue(':prs_codigo_item', cleanData("siLimite", 300, "noMayuscula", $_POST["pCodigoItem"]), PDO::PARAM_STR);
        $query_2->bindValue(':prs_codigo_auxiliar', cleanData("siLimite", 300, "noMayuscula", $_POST["pCodigoAuxiliar"]), PDO::PARAM_STR);
        $query_2->bindValue(':prs_descripcion_item', cleanData("siLimite", 300, "noMayuscula", $_POST["pDescripcion"]), PDO::PARAM_STR);
        $query_2->bindValue(':prs_valor_unitario', cleanData("noLimite", 0, "noMayuscula", $_POST["pPrecioUnitario"]));
        $query_2->bindValue(':prs_iva_cod_impuesto', cleanData("noLimite", 0, "noMayuscula", $codigoIva), PDO::PARAM_INT);
        $query_2->bindValue(':prs_iva_cod_tarifa', cleanData("noLimite", 0, "noMayuscula", $tarifaIva), PDO::PARAM_INT);
        $query_2->bindValue(':prs_ice_cod_impuesto', cleanData("noLimite", 0, "noMayuscula", $codigoIce), PDO::PARAM_INT);
        $query_2->bindValue(':prs_ice_cod_tarifa', cleanData("noLimite", 0, "noMayuscula", $tarifaIce), PDO::PARAM_INT);
        $query_2->bindValue(':prs_irbpnr_cod_impuesto', cleanData("noLimite", 0, "noMayuscula", $codigoIbr), PDO::PARAM_INT);
        $query_2->bindValue(':prs_irbpnr_cod_tarifa', cleanData("noLimite", 0, "noMayuscula", $tarifaIbr), PDO::PARAM_INT);
        
        $query_2->bindValue(':prs_usuario_creacion', cleanData("siLimite", 13, "noMayuscula", $dataSesion["cod_system_user"]), PDO::PARAM_STR);
        $query_2->bindValue(':prs_ip_creacion', getRealIP(), PDO::PARAM_STR);
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
        $data_result["dataModal_3"] = 'Producto registado de manera correcta.';
        $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-dismiss="modal">Cerrar</button>';
        $data_result["numLineaCodigo"] = __LINE__;
        echo json_encode($data_result);
        
        
    } else if ($_POST["tipo_form_prod"] == "Old") {
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

