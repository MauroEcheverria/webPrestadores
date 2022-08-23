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
			
			if ($_POST["tipo_form_sist_apl"] == "New") {
				$data_result["message"] = "error_admin_perfil";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
				$data_result["dataModal_2"] = 'Información';
				$data_result["dataModal_3"] = "Se presentó un inconveninete al registar al perfíl. Refresque el APP Web e intentelo nuevamente.";
				$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
				$data_result["numLineaCodigo"] = __LINE__;
				echo json_encode($data_result);
			}
			else if ($_POST["tipo_form_sist_apl"] == "Old") {
				$sql_2="UPDATE dct_sistema_tbl_aplicacion 
				SET apl_estado=:apl_estado,apl_usuario_modificacion=:apl_usuario_modificacion,
				apl_fecha_modificacion=now(),apl_ip_modificacion=:apl_ip_modificacion 
				WHERE apl_id_aplicacion = :apl_id_aplicacion;";
		    $query_2=$pdo->prepare($sql_2);
		    $query_2->bindValue(':apl_id_aplicacion',cleanData("noLimite",0,"noMayuscula",$_POST["apl_id_aplicacion"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':apl_estado',cleanData("noLimite",0,"noMayuscula",$_POST["apl_estado"]),PDO::PARAM_INT);
		    $query_2->bindValue(':apl_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':apl_ip_modificacion',getRealIP(),PDO::PARAM_STR);
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