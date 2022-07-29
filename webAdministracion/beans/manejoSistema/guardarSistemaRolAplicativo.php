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
			
			if ($_POST["tipo_form_sist_rol_apl"] == "New") {
				$sql_2="INSERT INTO dct_sistema_tbl_rol_aplicacion(rla_id_rol,rla_id_aplicacion,rla_estado,rla_usuario_creacion,rla_fecha_creacion,rla_ip_creacion)
			    	VALUES (:rla_id_rol,:rla_id_aplicacion,1,:rla_usuario_creacion,now(),:rla_ip_creacion);";
		    $query_2=$pdo->prepare($sql_2);          
		    $query_2->bindValue(':rla_id_rol',cleanData("noLimite",0,"noMayuscula",$_POST["rol_rol_2"]),PDO::PARAM_INT);
		    $query_2->bindValue(':rla_id_aplicacion',cleanData("noLimite",0,"noMayuscula",$_POST["apl_aplicacion_2"]),PDO::PARAM_INT);
		    $query_2->bindValue(':rla_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':rla_ip_creacion',getRealIP(),PDO::PARAM_STR);
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
			else if ($_POST["tipo_form_sist_rol_apl"] == "Old") {
				$sql_2="UPDATE dct_sistema_tbl_rol_aplicacion 
				SET rla_estado=:rla_estado,rla_usuario_modificacion=:rla_usuario_modificacion,
				rla_fecha_modificacion=now(),rla_ip_modificacion=:rla_ip_modificacion 
				WHERE rla_id_rol = :rla_id_rol AND rla_id_aplicacion = :rla_id_aplicacion ;";
		    $query_2=$pdo->prepare($sql_2);
		    $query_2->bindValue(':rla_id_rol',cleanData("noLimite",0,"noMayuscula",$_POST["rla_id_rol"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':rla_id_aplicacion',cleanData("noLimite",0,"noMayuscula",$_POST["rla_id_aplicacion"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':rla_estado',cleanData("noLimite",0,"noMayuscula",$_POST["rla_estado"]),PDO::PARAM_INT);
		    $query_2->bindValue(':rla_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':rla_ip_modificacion',getRealIP(),PDO::PARAM_STR);
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

	} catch (\PDOException $e) {
	  echo $e->getMessage();
	}
?>