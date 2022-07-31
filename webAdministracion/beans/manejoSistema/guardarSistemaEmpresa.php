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
			
			if ($_POST["tipo_form_sist_empre"] == "New") {
				$sql_2="INSERT INTO dct_sistema_tbl_empresa(emp_empresa, emp_ruc, emp_estado, emp_vigencia_desde, emp_vigencia_hasta, 
					ctg_id_catalogo, em_usuario_creacion, em_fecha_creacion, em_ip_creacion)
			    	VALUES (:emp_empresa, :emp_ruc, :emp_estado, :emp_vigencia_desde, :emp_vigencia_hasta, 
			    		:ctg_id_catalogo, :em_usuario_creacion, now(), :em_ip_creacion);";
		    $query_2=$pdo->prepare($sql_2);          
		    $query_2->bindValue(':emp_empresa',cleanData("siLimite",80,"noMayuscula",$_POST["emp_empresa"]),PDO::PARAM_STR);
		    $query_2->bindValue(':emp_ruc',cleanData("siLimite",13,"noMayuscula",$_POST["emp_ruc"]),PDO::PARAM_STR);
		    $query_2->bindValue(':emp_estado',cleanData("siLimite",1,"noMayuscula",$_POST["emp_estado"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':emp_vigencia_desde',cleanData("noLimite",0,"noMayuscula",$_POST["emp_vigencia_desde"]),PDO::PARAM_STR);
		    $query_2->bindValue(':emp_vigencia_hasta',cleanData("noLimite",0,"noMayuscula",$_POST["emp_vigencia_hasta"]),PDO::PARAM_STR);
		    $query_2->bindValue(':ctg_id_catalogo',cleanData("noLimite",0,"noMayuscula",$_POST["ctg_id_catalogo"]),PDO::PARAM_INT);
		    $query_2->bindValue(':em_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':em_ip_creacion',getRealIP(),PDO::PARAM_STR);
		    $query_2->execute();

		    if($query_2) {
					$pdo->commit();
					$data_result["message"] = "saveOK";
					$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
		      $data_result["dataModal_2"] = 'Información';
		      $data_result["dataModal_3"] = 'Empresa registada de manera correcta.';
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
			else if ($_POST["tipo_form_sist_empre"] == "Old") {
				$sql_2="UPDATE dct_sistema_tbl_empresa 
				SET emp_empresa=:emp_empresa,emp_ruc=:emp_ruc,emp_estado=:emp_estado,emp_vigencia_desde=:emp_vigencia_desde,
				emp_vigencia_hasta=:emp_vigencia_hasta,ctg_id_catalogo=:ctg_id_catalogo,em_usuario_modificacion=:em_usuario_modificacion,
				em_fecha_modificacion=now(),em_ip_modificacion=:em_ip_modificacion 
				WHERE emp_id_empresa = :emp_id_empresa";
		    $query_2=$pdo->prepare($sql_2);
		    $query_2->bindValue(':emp_id_empresa',cleanData("noLimite",0,"noMayuscula",$_POST["emp_id_empresa"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':emp_empresa',cleanData("siLimite",80,"noMayuscula",$_POST["emp_empresa"]),PDO::PARAM_STR);
		    $query_2->bindValue(':emp_ruc',cleanData("siLimite",13,"noMayuscula",$_POST["emp_ruc"]),PDO::PARAM_STR);
		    $query_2->bindValue(':emp_estado',cleanData("siLimite",1,"noMayuscula",$_POST["emp_estado"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':emp_vigencia_desde',cleanData("noLimite",0,"noMayuscula",$_POST["emp_vigencia_desde"]),PDO::PARAM_STR);
		    $query_2->bindValue(':emp_vigencia_hasta',cleanData("noLimite",0,"noMayuscula",$_POST["emp_vigencia_hasta"]),PDO::PARAM_STR);
		    $query_2->bindValue(':ctg_id_catalogo',cleanData("noLimite",0,"noMayuscula",$_POST["ctg_id_catalogo"]),PDO::PARAM_INT);
		    $query_2->bindValue(':em_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':em_ip_modificacion',getRealIP(),PDO::PARAM_STR);
		    $query_2->execute();

		    if($query_2) {
					$pdo->commit();
					$data_result["message"] = "saveOK";
					$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
		      $data_result["dataModal_2"] = 'Información';
		      $data_result["dataModal_3"] = 'Empresa modificada de manera correcta.';
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