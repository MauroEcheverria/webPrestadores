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

		if (isset($_POST["csrf"]) && hash_equals($_SESSION["token_csrf"],$_POST["csrf"])) {
			
			if ($_POST["tipo_form_sist_rol_opc"] == "New") {
				$sql_2="INSERT INTO dct_sistema_tbl_rol_opcion(rlo_id_rol,rlo_id_opcion,rlo_estado,rlo_usuario_creacion,rlo_fecha_creacion,rlo_ip_creacion)
			    	VALUES (:rlo_id_rol,:rlo_id_opcion,1,:rlo_usuario_creacion,now(),:rlo_ip_creacion);";
		    $query_2=$pdo->prepare($sql_2);          
		    $query_2->bindValue(':rlo_id_rol',cleanData("noLimite",0,"noMayuscula",$_POST["rol_rol_3"]),PDO::PARAM_INT);
		    $query_2->bindValue(':rlo_id_opcion',cleanData("noLimite",0,"noMayuscula",$_POST["opc_opcion_3"]),PDO::PARAM_INT);
		    $query_2->bindValue(':rlo_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':rlo_ip_creacion',getRealIP(),PDO::PARAM_STR);
		    $query_2->execute();

		    if($query_2) {
					$pdo->commit();
					$data_result["message"] = "saveOK";
					$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
		      $data_result["dataModal_2"] = 'Información';
		      $data_result["dataModal_3"] = 'Rol registado de manera correcta.';
		      $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
					echo json_encode($data_result);
				}
				else {
					$pdo->rollBack();
					$data_result["message"] = "saveError";
					echo json_encode($data_result);
				}
			}
			else if ($_POST["tipo_form_sist_rol_opc"] == "Old") {
				$sql_2="UPDATE dct_sistema_tbl_rol_opcion 
				SET rlo_estado=:rlo_estado,rlo_usuario_modificacion=:rlo_usuario_modificacion,
				rlo_fecha_modificacion=now(),rlo_ip_modificacion=:rlo_ip_modificacion 
				WHERE rlo_id_rol = :rlo_id_rol AND rlo_id_opcion = :rlo_id_opcion ;";
		    $query_2=$pdo->prepare($sql_2);
		    $query_2->bindValue(':rlo_id_rol',cleanData("noLimite",0,"noMayuscula",$_POST["rlo_id_rol"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':rlo_id_opcion',cleanData("noLimite",0,"noMayuscula",$_POST["rlo_id_opcion"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':rlo_estado',cleanData("noLimite",0,"noMayuscula",$_POST["rlo_estado"]),PDO::PARAM_INT);
		    $query_2->bindValue(':rlo_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':rlo_ip_modificacion',getRealIP(),PDO::PARAM_STR);
		    $query_2->execute();

		    if($query_2) {
					$pdo->commit();
					$data_result["message"] = "saveOK";
					$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
		      $data_result["dataModal_2"] = 'Información';
		      $data_result["dataModal_3"] = 'Rol modificado de manera correcta.';
		      $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
					echo json_encode($data_result);
				}
				else {
					$pdo->rollBack();
					$data_result["message"] = "saveError";
					echo json_encode($data_result);
				}
			}
			else {
				$data_result["message"] = "error_admin_perfil";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
				$data_result["dataModal_2"] = 'Información';
				$data_result["dataModal_3"] = "Se presentó un inconveninete al registar al perfíl. Refresque el APP Web e intentelo nuevamente.";
				$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
				echo json_encode($data_result);
			}	
				
		}
		else {
			$data_result["message"] = "token_csrf_error";
			$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
			$data_result["dataModal_2"] = 'Información';
			$data_result["dataModal_3"] = "Token de seguridad inválido, refresque el aplicativo WEB.";
			$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
			echo json_encode($data_result);
		}		

	} catch (Exception $ex) {
		$data_result["message"] = "salidaExcepcionCatch";
		$data_result["codError"] = $ex->getCode();
		$data_result["msjError"] = $ex->getMessage();
		echo json_encode($data_result);
	}
?>