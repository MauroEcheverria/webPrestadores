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


    if ($_POST["tipo_form_vinc"] == "New") {
        
        //validar datos duplicados
        //codigo
        $sqlV = "select usr_cod_usuario
                    from dct_pos_tbl_usuario_est_pun_emi uv
                    where uv.usr_cod_usuario = :usr_cod_usuario
                    and uv.uep_estado = 1;";
        $queryV = $pdo->prepare($sqlV);
        $queryV->bindValue(':usr_cod_usuario', cleanData("siLimite", 13, "noMayuscula", $_POST["slcUsuariosVinc"]), PDO::PARAM_STR);
        $queryV->execute();
        $rowsV = $queryV->fetchAll();
        if (isset($rowsV) && sizeof($rowsV) > 0) {
            $data_result["message"] = "error_negocio";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = "Ya existe una configuracion activa para el usuario ".$_POST["slcUsuariosVinc"];
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
            $data_result["numLineaCodigo"] = __LINE__;
            echo json_encode($data_result);
            return;
        }

        //ingreso registro
        $sql_2 = "insert into dct_pos_tbl_usuario_est_pun_emi
                    (usr_cod_usuario,est_id_empresa_establecimiento,epe_id_empresa_punto_emision,
                    uep_estado,uep_usuario_creacion,uep_fecha_creacion,uep_ip_creacion)
                    values
                    (:usr_cod_usuario,:est_id_empresa_establecimiento,:epe_id_empresa_punto_emision,
                    1,:uep_usuario_creacion,now(),:uep_ip_creacion);";
        $query_2 = $pdo->prepare($sql_2);

        $query_2->bindValue(':usr_cod_usuario', cleanData("siLimite", 13, "noMayuscula", $_POST["slcUsuariosVinc"]), PDO::PARAM_STR);
        $query_2->bindValue(':est_id_empresa_establecimiento', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEstablecimientoVinc"]), PDO::PARAM_INT);
        $query_2->bindValue(':epe_id_empresa_punto_emision', cleanData("noLimite", 0, "noMayuscula", $_POST["slcPtoEmisionVinc"]), PDO::PARAM_INT);
        $query_2->bindValue(':uep_usuario_creacion', cleanData("siLimite", 13, "noMayuscula", $dataSesion["cod_system_user"]), PDO::PARAM_STR);
        $query_2->bindValue(':uep_ip_creacion', getRealIP(), PDO::PARAM_STR);
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
        $data_result["dataModal_3"] = 'Vinculación registada correctamente';
        $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-dismiss="modal">Cerrar</button>';
        $data_result["numLineaCodigo"] = __LINE__;
        echo json_encode($data_result);
        
        
    } else if ($_POST["tipo_form_vinc"] == "Old") {
        //validar datos duplicados
        //validar datos duplicados
        //codigo
        $sqlV = "select usr_cod_usuario
                    from dct_pos_tbl_usuario_est_pun_emi uv
                    where uv.usr_cod_usuario = :usr_cod_usuario
                    and uv.uep_estado = 1
                    and uep_id_usuario_epe != :uep_id_usuario_epe;";
        $queryV = $pdo->prepare($sqlV);
        $queryV->bindValue(':usr_cod_usuario', cleanData("siLimite", 13, "noMayuscula", $_POST["slcUsuariosVinc"]), PDO::PARAM_STR);
        $queryV->bindValue(':uep_id_usuario_epe', cleanData("noLimite", 0, "noMayuscula", $_POST["uep_id_usuario_epe"]), PDO::PARAM_INT);
        $queryV->execute();
        $rowsV = $queryV->fetchAll();
        if (isset($rowsV) && sizeof($rowsV) > 0) {
            $data_result["message"] = "error_negocio";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = "Ya existe una configuracion activa para el usuario ".$_POST["slcUsuariosVinc"];
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
            $data_result["numLineaCodigo"] = __LINE__;
            echo json_encode($data_result);
            return;
        }
        
        //ACTUALIZAR
        $sql_2 = "update dct_pos_tbl_usuario_est_pun_emi
                    set est_id_empresa_establecimiento = :est_id_empresa_establecimiento,
                    epe_id_empresa_punto_emision = :epe_id_empresa_punto_emision,
                    uep_estado = :uep_estado,
                    uep_usuario_modificacion = :uep_usuario_modificacion,
                    uep_fecha_modificacion = now(),
                    uep_ip_modificacion = :uep_ip_modificacion,
                    where uep_id_usuario_epe = :uep_id_usuario_epe;
                    ";
        $query_2 = $pdo->prepare($sql_2);
        $query_2->bindValue(':est_id_empresa_establecimiento', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEstablecimientoVinc"]), PDO::PARAM_INT);
        $query_2->bindValue(':epe_id_empresa_punto_emision', cleanData("noLimite", 0, "noMayuscula", $_POST["slcPtoEmisionVinc"]), PDO::PARAM_INT);
        $query_2->bindValue(':uep_estado', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEstadoUsrVinc"]), PDO::PARAM_INT);
        $query_2->bindValue(':uep_usuario_modificacion', cleanData("siLimite", 13, "noMayuscula", $dataSesion["cod_system_user"]), PDO::PARAM_STR);
        $queryV->bindValue(':uep_id_usuario_epe', cleanData("noLimite", 0, "noMayuscula", $_POST["uep_id_usuario_epe"]), PDO::PARAM_INT);
        $query_2->bindValue(':uep_ip_modificacion', getRealIP(), PDO::PARAM_STR);
        $query_2->execute();

         $pdo->commit();
            $data_result["message"] = "saveOK";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = 'Registro modificado de manera correcta.';
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

