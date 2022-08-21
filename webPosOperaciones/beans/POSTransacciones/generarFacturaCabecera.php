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

			$sql="SELECT ftr_id_factura_transaccion, emp_id_empresa
						FROM dct_pos_tbl_factura_transaccion
						WHERE usr_cod_usuario = :usr_cod_usuario_1
						AND ftr_estado_transaccion = 'TMP'
						AND emp_id_empresa = (SELECT usr_id_empresa 
						FROM dct_sistema_tbl_usuario 
						WHERE usr_cod_usuario = :usr_cod_usuario_2);";
	    $query=$pdo->prepare($sql);
	    $query->bindValue(':usr_cod_usuario_1',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
	    $query->bindValue(':usr_cod_usuario_2',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
	    $query->execute();
			
			if ( $query->rowCount() == 0 ) {

				$sql_2="INSERT INTO dct_pos_tbl_factura_transaccion(emp_id_empresa, usr_cod_usuario, ftr_estado_transaccion, 
								ftr_estado, ftr_usuario_creacion, ftr_fecha_creacion, ftr_ip_creacion)
			    			VALUES (:emp_id_empresa, :usr_cod_usuario, 'TMP', 1, :ftr_usuario_creacion, now(), :ftr_ip_creacion);";
		    $query_2=$pdo->prepare($sql_2);          
		    $query_2->bindValue(':emp_id_empresa',cleanData("siLimite",13,"noMayuscula",$dataSesion["usr_id_empresa"]),PDO::PARAM_INT);
		    $query_2->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':ftr_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':ftr_ip_creacion',getRealIP(),PDO::PARAM_STR);
		    $query_2->execute();

		    if($query_2) {
					$pdo->commit();
					$data_result["message"] = "saveOK";
					$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
		      $data_result["dataModal_2"] = 'Información';
		      $data_result["dataModal_3"] = 'Transacción registra de manera correcta.';
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
				$data_result["message"] = "fact_transaccion_registrada";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
				$data_result["dataModal_2"] = 'Información';
				$data_result["dataModal_3"] = "Se detecta una transacción iniciada. Favor refresque la página WEB";
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