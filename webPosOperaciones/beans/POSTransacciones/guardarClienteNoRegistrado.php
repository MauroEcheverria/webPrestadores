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
		$pdo->beginTransaction();
		
		$sql="INSERT INTO dct_pos_tbl_cientes(emp_id_empresa, cli_tipo_identificacion, cli_identificacion, cli_nombre_1, 
			cli_nombre_2, cli_apellido_1, cli_apellido_2, cli_correo, cli_direccion, cli_telefono, cli_placa, cli_estado,
			cli_usuario_creacion, cli_fecha_creacion, cli_ip_creacion)
	    	VALUES (:emp_id_empresa, :cli_tipo_identificacion, :cli_identificacion, :cli_nombre_1, :cli_nombre_2, 
	    		:cli_apellido_1, :cli_apellido_2, :cli_correo, :cli_direccion, :cli_telefono, :cli_placa, 1,
	    		:cli_usuario_creacion, now(), :cli_ip_creacion);";
    $query=$pdo->prepare($sql);
    $query->bindValue(':cli_tipo_identificacion',cleanData("siLimite",2,"noMayuscula",$_POST["cli_tipo_identificacion"]),PDO::PARAM_INT);
    $query->bindValue(':cli_identificacion',cleanData("siLimite",13,"noMayuscula",$_POST["cli_identificacion_form"]),PDO::PARAM_INT);
    $query->bindValue(':cli_nombre_1',cleanData("siLimite",10,"noMayuscula",$_POST["cli_nombre_1"]),PDO::PARAM_STR);
    $query->bindValue(':cli_nombre_2',cleanData("siLimite",10,"noMayuscula",$_POST["cli_nombre_2"]),PDO::PARAM_STR);
    $query->bindValue(':cli_apellido_1',cleanData("siLimite",10,"noMayuscula",$_POST["cli_apellido_1"]),PDO::PARAM_STR);
    $query->bindValue(':cli_apellido_2',cleanData("siLimite",10,"noMayuscula",$_POST["cli_apellido_2"]),PDO::PARAM_STR); 
    $query->bindValue(':cli_correo',cleanData("siLimite",50,"noMayuscula",$_POST["cli_correo"]),PDO::PARAM_STR);
    $query->bindValue(':cli_direccion',cleanData("siLimite",150,"noMayuscula",$_POST["cli_direccion"]),PDO::PARAM_STR);
    $query->bindValue(':cli_telefono',cleanData("siLimite",10,"noMayuscula",$_POST["cli_telefono"]),PDO::PARAM_STR);
    $query->bindValue(':cli_placa',cleanData("siLimite",8,"noMayuscula",$_POST["cli_placa"]),PDO::PARAM_STR); 
    $query->bindValue(':emp_id_empresa',cleanData("noLimite",0,"noMayuscula",$dataSesion["usr_id_empresa"]),PDO::PARAM_INT); 
    $query->bindValue(':cli_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
    $query->bindValue(':cli_ip_creacion',getRealIP(),PDO::PARAM_STR);
    $query->execute();

    $sql_1="SELECT cli_id_cliente, cli_tipo_identificacion, cli_identificacion, 
		    	CONCAT(IFNULL(cli_nombre_1,''),' ',IFNULL(cli_nombre_2,''),' ',IFNULL(cli_apellido_1,''),' ',IFNULL(cli_apellido_2,'')) cli_nombres, 
		    	cli_correo, cli_direccion, cli_telefono, cli_placa
        FROM dct_pos_tbl_cientes
        WHERE cli_identificacion = :cli_identificacion
        AND emp_id_empresa = :usr_id_empresa;";
    $query_1=$pdo->prepare($sql_1);
    $query_1->bindValue(':cli_identificacion',cleanData("siLimite",13,"noMayuscula",$_POST["cli_identificacion_form"]),PDO::PARAM_INT);
    $query_1->bindValue(':usr_id_empresa',cleanData("noLimite",0,"noMayuscula",$dataSesion["usr_id_empresa"]),PDO::PARAM_INT); 
    $query_1->execute();
    $row_1 = $query_1->fetch(\PDO::FETCH_ASSOC);

		if($query) {
			$pdo->commit();
			$data_result["message"] = "saveOK";
			$data_result["data_row"] = $row_1;
			$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
			$data_result["dataModal_2"] = 'Información';
			$data_result["dataModal_3"] = 'Cliente registado de manera correcta.';
			$data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-dismiss="modal">Cerrar</button>';
	    $data_result["numLineaCodigo"] = __LINE__;
			echo json_encode($data_result);	
		}
		else {
			$pdo->rollBack();
			$data_result["message"] = "saveError";
			$data_result["numLineaCodigo"] = __LINE__;
			echo json_encode($data_result);
		}
			
	} catch (Exception $ex) {
		$data_result["message"] = "salidaExcepcionCatch";
		$data_result["codError"] = $ex->getCode();
		$data_result["msjError"] = $ex->getMessage();
		$data_result["numLineaCodigo"] = __LINE__;
		echo json_encode($data_result);
	}
?>