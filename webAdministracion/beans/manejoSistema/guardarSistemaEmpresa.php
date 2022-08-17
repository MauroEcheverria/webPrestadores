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
                            
                            //validar datos duplicados
                            $sqlV="select count(*)
                                    from dct_sistema_tbl_empresa e
                                    where e.emp_ruc = :emp_ruc
                                    or upper(trim(e.emp_empresa) = upper(trim(:emp_empresa)";
                            $queryV=$pdo->prepare($sqlV);   
                            $queryV->bindValue(':emp_empresa',cleanData("siLimite",300,"noMayuscula",$_POST["emp_empresa"]),PDO::PARAM_STR);
                            $queryV->bindValue(':emp_ruc',cleanData("siLimite",13,"noMayuscula",$_POST["emp_ruc"]),PDO::PARAM_STR);
                            $queryV->execute();
                            $rowsV = $queryV->fetchAll();
                            if (isset($rowsV) && sizeof($rowsV) > 0) {
                                $data_result["message"] = "warning_datos_duplicados";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
				$data_result["dataModal_2"] = 'Información';
				$data_result["dataModal_3"] = "El ruc ingresado o el nombre de la empresa, ya se encuentra registrado en el sistema.";
				$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
				$data_result["numLineaCodigo"] = __LINE__;
				echo json_encode($data_result);
                                return;
                            }
                            //validar logo
                            if ( !isset($_FILES['em_logo_empresa']['error']) )
                            {
                                $data_result["message"] = "warning_logo_no_cargado";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
				$data_result["dataModal_2"] = 'Información';
				$data_result["dataModal_3"] = "El logo de la empresa, no ha sido cargado.";
				$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
				$data_result["numLineaCodigo"] = __LINE__;
				echo json_encode($data_result);
                                return;
                            }
                            //validar peso
                            if ($_FILES['em_logo_empresa']['size'] > 1000000) {
                                $data_result["message"] = "error_file_size_exceeded";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
				$data_result["dataModal_2"] = 'Información';
				$data_result["dataModal_3"] = "El tamaño del archivo no puede ser mayor a 1MB";
				$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
				$data_result["numLineaCodigo"] = __LINE__;
				echo json_encode($data_result);
                                return;
                            }
                            //validar extension
                            $finfo = new finfo(FILEINFO_MIME_TYPE);
                            if (false === $ext = array_search(
                                $finfo->file($_FILES['em_logo_empresa']['tmp_name']),
                                array(
                                    'jpg' => 'image/jpeg',
                                    'png' => 'image/png',
                                ),
                                true
                            )) {
                                $data_result["message"] = "error_file_size_exceeded";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
				$data_result["dataModal_2"] = 'Información';
				$data_result["dataModal_3"] = "formato inválido de archivo, extensiones permitidas: .jpg .png";
				$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
				$data_result["numLineaCodigo"] = __LINE__;
				echo json_encode($data_result);
                                return;
                            }
                            //guardar logo
                            $pathto="/uploads/".$_FILES['em_logo_empresa']['tmp_name'];
                            move_uploaded_file( $_FILES['em_logo_empresa']['tmp_name'],$pathto );
                            
				$sql_2="INSERT INTO dct_sistema_tbl_empresa(emp_empresa, emp_ruc, emp_estado, emp_vigencia_desde, emp_vigencia_hasta, 
					ctg_id_catalogo, em_usuario_creacion, em_fecha_creacion, em_ip_creacion,
                                        emp_direccion_emisor, emp_cod_est_emisor,emp_url_logo)
			    	VALUES (:emp_empresa, :emp_ruc, :emp_estado, :emp_vigencia_desde, :emp_vigencia_hasta, 
			    		:ctg_id_catalogo, :em_usuario_creacion, now(), :em_ip_creacion
                                        ,:emp_url_logo);";
		    $query_2=$pdo->prepare($sql_2);          
		    $query_2->bindValue(':emp_empresa',cleanData("siLimite",300,"noMayuscula",$_POST["emp_empresa"]),PDO::PARAM_STR);
		    $query_2->bindValue(':emp_ruc',cleanData("siLimite",13,"noMayuscula",$_POST["emp_ruc"]),PDO::PARAM_STR);
		    $query_2->bindValue(':emp_estado',cleanData("siLimite",1,"noMayuscula",$_POST["emp_estado"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':emp_vigencia_desde',cleanData("noLimite",0,"noMayuscula",$_POST["emp_vigencia_desde"]),PDO::PARAM_STR);
		    $query_2->bindValue(':emp_vigencia_hasta',cleanData("noLimite",0,"noMayuscula",$_POST["emp_vigencia_hasta"]),PDO::PARAM_STR);
		    $query_2->bindValue(':ctg_id_catalogo',cleanData("noLimite",0,"noMayuscula",$_POST["ctg_id_catalogo"]),PDO::PARAM_INT);
		    $query_2->bindValue(':em_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':em_ip_creacion',getRealIP(),PDO::PARAM_STR);
                    $query_2->bindValue(':emp_url_logo',$pathto,PDO::PARAM_STR);
		    $query_2->execute();

		    if($query_2) {
                        $lastId = $pdo->lastInsertId();
                        $sql_3="INSERT INTO dct_pos_tbl_empresa_serial(emp_id_empresa, ser_factura, ser_nota_credito, ser_nota_debito, ser_guia_remision, ser_comprobante_retencion, ser_estado
                            , ser_usuario_creacion, ser_fecha_creacion, ser_ip_creacion)
			    	VALUES (:emp_id_empresa, :ser_factura, :ser_nota_credito, :ser_nota_debito, :ser_guia_remision, :ser_comprobante_retencion, 1
                            , :ser_usuario_creacion, now(), :ser_ip_creacion);";
                        $query_3=$pdo->prepare($sql_3);  
                        $query_3->bindValue(':emp_id_empresa',$lastId,PDO::PARAM_INT);
                        $query_3->bindValue(':ser_factura',cleanData("noLimite",0,"noMayuscula",$_POST["ser_factura"]),PDO::PARAM_INT);
                        $query_3->bindValue(':ser_nota_credito',cleanData("noLimite",0,"noMayuscula",$_POST["ser_nota_credito"]),PDO::PARAM_INT);
                        $query_3->bindValue(':ser_nota_debito',cleanData("noLimite",0,"noMayuscula",$_POST["ser_nota_debito"]),PDO::PARAM_INT);
                        $query_3->bindValue(':ser_guia_remision',cleanData("noLimite",0,"noMayuscula",$_POST["ser_guia_remision"]),PDO::PARAM_INT);
                        $query_3->bindValue(':ser_comprobante_retencion',cleanData("noLimite",0,"noMayuscula",$_POST["ser_comprobante_retencion"]),PDO::PARAM_INT);
                        $query_3->bindValue(':ser_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["ser_usuario_creacion"]),PDO::PARAM_INT); 
                        $query_3->bindValue(':ser_ip_creacion',getRealIP(),PDO::PARAM_STR);
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
		    $query_2->bindValue(':emp_empresa',cleanData("siLimite",300,"noMayuscula",$_POST["emp_empresa"]),PDO::PARAM_STR);
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