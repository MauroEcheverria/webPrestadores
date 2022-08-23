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

		if (isset($_POST["csrf"]) && hash_equals($_SESSION["token_csrf"],$_POST["csrf"])) {
			
			if ($_POST["tipo_form_sist_rol"] == "New") {
				$sql_2="INSERT INTO dct_sistema_tbl_rol(rol_rol,rol_estado,rol_usuario_creacion,rol_fecha_creacion,rol_ip_creacion)
			    	VALUES (:rol_rol,1,:rol_usuario_creacion,now(),:rol_ip_creacion);";
		    $query_2=$pdo->prepare($sql_2);          
		    $query_2->bindValue(':rol_rol',cleanData("siLimite",30,"noMayuscula",$_POST["rol_rol"]),PDO::PARAM_STR);
		    $query_2->bindValue(':rol_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':rol_ip_creacion',getRealIP(),PDO::PARAM_STR);
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
			else if ($_POST["tipo_form_sist_rol"] == "Old") {
				$sql_2="UPDATE dct_sistema_tbl_rol 
				SET rol_estado=:rol_estado,rol_usuario_modificacion=:rol_usuario_modificacion,
				rol_fecha_modificacion=now(),rol_ip_modificacion=:rol_ip_modificacion 
				WHERE rol_id_rol = :rol_id_rol;";
		    $query_2=$pdo->prepare($sql_2);
		    $query_2->bindValue(':rol_id_rol',cleanData("noLimite",0,"noMayuscula",$_POST["rol_id_rol"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':rol_estado',cleanData("noLimite",0,"noMayuscula",$_POST["rol_estado"]),PDO::PARAM_INT);
		    $query_2->bindValue(':rol_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':rol_ip_modificacion',getRealIP(),PDO::PARAM_STR);
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
				
		}
		else {
			$data_result["message"] = "token_csrf_error";
			$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
			$data_result["dataModal_2"] = 'Información';
			$data_result["dataModal_3"] = "Token de seguridad inválido, refresque el aplicativo WEB.";
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