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

		if (!tokenSesionValido()) { return; }
			
		if ($_POST["tipo_form_sist_emp_apl"] == "New") {
			$sql_2="INSERT INTO dct_sistema_tbl_aplicacion_empresa(ape_id_aplicacion,ape_id_empresa,ape_estado,ape_usuario_creacion,ape_fecha_creacion,ape_ip_creacion)
		    	VALUES (:ape_id_aplicacion,:ape_id_empresa,1,:ape_usuario_creacion,now(),:ape_ip_creacion);";
	    $query_2=$pdo->prepare($sql_2);          
	    $query_2->bindValue(':ape_id_aplicacion',cleanData("noLimite",0,"noMayuscula",$_POST["apl_aplicacion_1"]),PDO::PARAM_INT);
	    $query_2->bindValue(':ape_id_empresa',cleanData("noLimite",0,"noMayuscula",$_POST["emp_empresa_1"]),PDO::PARAM_INT);
	    $query_2->bindValue(':ape_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
	    $query_2->bindValue(':ape_ip_creacion',getRealIP(),PDO::PARAM_STR);
	    $query_2->execute();

	    if($query_2) {
				$pdo->commit();
				$data_result["message"] = "saveOK";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
	      $data_result["dataModal_2"] = 'Información';
	      $data_result["dataModal_3"] = 'Rol registado de manera correcta.';
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
		}
		else if ($_POST["tipo_form_sist_emp_apl"] == "Old") {
			$sql_2="UPDATE dct_sistema_tbl_aplicacion_empresa 
			SET ape_estado=:ape_estado,ape_usuario_modificacion=:ape_usuario_modificacion,
			ape_fecha_modificacion=now(),ape_ip_modificacion=:ape_ip_modificacion 
			WHERE ape_id_aplicacion = :ape_id_aplicacion AND ape_id_empresa = :ape_id_empresa ;";
	    $query_2=$pdo->prepare($sql_2);
	    $query_2->bindValue(':ape_id_aplicacion',cleanData("noLimite",0,"noMayuscula",$_POST["ape_id_aplicacion"]),PDO::PARAM_INT); 
	    $query_2->bindValue(':ape_id_empresa',cleanData("noLimite",0,"noMayuscula",$_POST["ape_id_empresa"]),PDO::PARAM_INT); 
	    $query_2->bindValue(':ape_estado',cleanData("noLimite",0,"noMayuscula",$_POST["ape_estado"]),PDO::PARAM_INT);
	    $query_2->bindValue(':ape_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
	    $query_2->bindValue(':ape_ip_modificacion',getRealIP(),PDO::PARAM_STR);
	    $query_2->execute();

	    if($query_2) {
				$pdo->commit();
				$data_result["message"] = "saveOK";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
	      $data_result["dataModal_2"] = 'Información';
	      $data_result["dataModal_3"] = 'Rol modificado de manera correcta.';
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
		}
		else {
			$data_result["message"] = "error_admin_perfil";
			$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
			$data_result["dataModal_2"] = 'Información';
			$data_result["dataModal_3"] = "Se presentó un inconveninete al registar al perfíl. Refresque el APP Web e intentelo nuevamente.";
			$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
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