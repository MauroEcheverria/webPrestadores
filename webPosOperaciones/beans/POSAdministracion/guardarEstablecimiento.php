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


    if ($_POST["tipo_form_est"] == "New") {

        //validar datos duplicados
        $sqlV = "select est.est_id_empresa_establecimiento, emp.emp_id_empresa
                                                    ,emp.emp_empresa
                                    from dct_pos_tbl_empresa_establecimiento est
                                    inner join dct_sistema_tbl_empresa emp
                                            on emp.emp_id_empresa = est.emp_id_empresa
                                    where emp.emp_id_empresa = :emp_id_empresa
                                    and (upper(est.est_codigo) = upper(:est_codigo)
                                    or upper(trim(est.est_nombre)) = upper(trim(:est_nombre))
                                    );";
        $queryV = $pdo->prepare($sqlV);
        $queryV->bindValue(':est_codigo', cleanData("siLimite", 60, "noMayuscula", $_POST["estCodigo"]), PDO::PARAM_STR);
        $queryV->bindValue(':est_nombre', cleanData("siLimite", 300, "noMayuscula", $_POST["estNombre"]), PDO::PARAM_STR);
        $queryV->bindValue(':emp_id_empresa', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEmpresa"]), PDO::PARAM_INT);
        $queryV->execute();
        $rowsV = $queryV->fetchAll();
        if (isset($rowsV) && sizeof($rowsV) > 0) {
            $data_result["message"] = "error_negocio";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = "El código ingresado o el nombre del establecimiento, ya se encuentra registrado en el sistema.";
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
            $data_result["numLineaCodigo"] = __LINE__;
            echo json_encode($data_result);
            return;
        }

        //validar matriz
        if ($_POST["chkMatriz"] == 1)
        {
            $sqlM = "select est.est_id_empresa_establecimiento, emp.emp_id_empresa
                                                    ,emp.emp_empresa
                                                    ,est.est_nombre
                                    from dct_pos_tbl_empresa_establecimiento est
                                    inner join dct_sistema_tbl_empresa emp
                                            on emp.emp_id_empresa = est.emp_id_empresa
                                    where emp.emp_id_empresa = :emp_id_empresa
                                    and est.est_estado = 1
                                    and est.est_es_matriz = 1";
            $queryM = $pdo->prepare($sqlM);
            $queryM->bindValue(':emp_id_empresa', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEmpresa"]), PDO::PARAM_INT);
            $queryM->execute();
            $rowsM = $queryM->fetchAll();
            if (isset($rowsM) && sizeof($rowsM) > 0) {
                $data_result["message"] = "error_negocio";
                $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
                $data_result["dataModal_2"] = 'Información';
                $data_result["dataModal_3"] = "Ya existe otro establecimiento asignado como matríz";
                $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
                $data_result["numLineaCodigo"] = __LINE__;
                echo json_encode($data_result);
                return;
            }
        }
        

        //ingreso establecimiento
        $sql_2 = "insert into dct_pos_tbl_empresa_establecimiento(
                                        emp_id_empresa,est_codigo, est_nombre, est_direccion_emisor, est_es_matriz, est_estado
                                        ,est_usuario_creacion,est_fecha_creacion,est_ip_creacion
                                        )
                                        values(
                                        :emp_id_empresa,:est_codigo, :est_nombre, :est_direccion_emisor, :est_es_matriz, 1
                                        ,:est_usuario_creacion,now(),:est_ip_creacion
                                        );";
        $query_2 = $pdo->prepare($sql_2);
        $query_2->bindValue(':emp_id_empresa', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEmpresa"]), PDO::PARAM_INT);
        $query_2->bindValue(':est_codigo', cleanData("siLimite", 60, "noMayuscula", $_POST["estCodigo"]), PDO::PARAM_STR);
        $query_2->bindValue(':est_nombre', cleanData("siLimite", 300, "noMayuscula", $_POST["estNombre"]), PDO::PARAM_STR);
        $query_2->bindValue(':est_direccion_emisor', cleanData("siLimite", 300, "noMayuscula", $_POST["estDireccion"]), PDO::PARAM_STR);
        $query_2->bindValue(':est_es_matriz', cleanData("noLimite", 0, "noMayuscula", $_POST["chkMatriz"]), PDO::PARAM_INT);
        $query_2->bindValue(':est_usuario_creacion', cleanData("siLimite", 13, "noMayuscula", $dataSesion["cod_system_user"]), PDO::PARAM_STR);
        $query_2->bindValue(':est_ip_creacion', getRealIP(), PDO::PARAM_STR);
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
        
        
    } else if ($_POST["tipo_form_est"] == "Old") {
        //validar datos duplicados
        $sqlV = "select est.est_id_empresa_establecimiento, emp.emp_id_empresa
                                                    ,emp.emp_empresa
                                    from dct_pos_tbl_empresa_establecimiento est
                                    inner join dct_sistema_tbl_empresa emp
                                            on emp.emp_id_empresa = est.emp_id_empresa
                                    where emp.emp_id_empresa = :emp_id_empresa
                                    and est.est_id_empresa_establecimiento != :est_id_empresa_establecimiento
                                    and (upper(est.est_codigo) = upper(:est_codigo)
                                    or upper(trim(est.est_nombre)) = upper(trim(:est_nombre))
                                    );";
        $queryV = $pdo->prepare($sqlV);
        $queryV->bindValue(':est_codigo', cleanData("siLimite", 60, "noMayuscula", $_POST["estCodigo"]), PDO::PARAM_STR);
        $queryV->bindValue(':est_nombre', cleanData("siLimite", 300, "noMayuscula", $_POST["estNombre"]), PDO::PARAM_STR);
        $queryV->bindValue(':emp_id_empresa', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEmpresa"]), PDO::PARAM_INT);
        $queryV->bindValue(':est_id_empresa_establecimiento', cleanData("noLimite", 0, "noMayuscula", $_POST["id_establecimiento"]), PDO::PARAM_INT);
        $queryV->execute();
        $rowsV = $queryV->fetchAll();
        if (isset($rowsV) && sizeof($rowsV) > 0) {
            $data_result["message"] = "error_negocio";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = "El código ingresado o el nombre del establecimiento, ya se encuentra registrado en el sistema.";
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
            $data_result["numLineaCodigo"] = __LINE__;
            echo json_encode($data_result);
            return;
        }
        
        //ACTUALIZAR establecimiento
        $sql_2 = "update dct_pos_tbl_empresa_establecimiento
                    set 
                    est_codigo = :est_codigo,
                    est_nombre = :est_nombre,
                    est_direccion_emisor = :est_direccion_emisor, 
                    est_estado = :est_estado,
                    est_fecha_modificacion = now(),
                    est_ip_modificacion = :est_ip_modificacion,
                    est_usuario_modificacion = :est_usuario_modificacion
                    where est_id_empresa_establecimiento = :est_id_empresa_establecimiento;";
        $query_2 = $pdo->prepare($sql_2);
        $query_2->bindValue(':est_codigo', cleanData("siLimite", 60, "noMayuscula", $_POST["estCodigo"]), PDO::PARAM_STR);
        $query_2->bindValue(':est_nombre', cleanData("siLimite", 300, "noMayuscula", $_POST["estNombre"]), PDO::PARAM_STR);
        $query_2->bindValue(':est_direccion_emisor', cleanData("siLimite", 300, "noMayuscula", $_POST["estDireccion"]), PDO::PARAM_STR);
        $query_2->bindValue(':est_estado', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEstado"]), PDO::PARAM_INT);
        $query_2->bindValue(':est_usuario_modificacion', cleanData("siLimite", 13, "noMayuscula", $dataSesion["cod_system_user"]), PDO::PARAM_STR);
        $query_2->bindValue(':est_ip_modificacion', getRealIP(), PDO::PARAM_STR);
        $query_2->bindValue(':est_id_empresa_establecimiento', cleanData("noLimite", 0, "noMayuscula", $_POST["id_establecimiento"]), PDO::PARAM_INT);
        $query_2->execute();

        //actualizar matriz
        if ($_POST["chkMatriz"] == 1)
        {
            $sqlU = "update dct_pos_tbl_empresa_establecimiento
                        set est_es_matriz = 0
                        where emp_id_empresa = :emp_id_empresa;";
            $queryU = $pdo->prepare($sqlU);
            $queryU->bindValue(':emp_id_empresa', cleanData("noLimite", 0, "noMayuscula", $_POST["slcEmpresa"]), PDO::PARAM_INT);
            $queryU->execute();
            
             $sqlU = "update dct_pos_tbl_empresa_establecimiento
                        set est_es_matriz = 1
                        where est_id_empresa_establecimiento = :est_id_empresa_establecimiento;";
            $queryU = $pdo->prepare($sqlU);
            $queryU->bindValue(':est_id_empresa_establecimiento', cleanData("noLimite", 0, "noMayuscula", $_POST["id_establecimiento"]), PDO::PARAM_INT);
            $queryU->execute();
        }

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