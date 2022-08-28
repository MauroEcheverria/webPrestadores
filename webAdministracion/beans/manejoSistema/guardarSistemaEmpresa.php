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

		if (!tokenSesionValido())
                {
                    return;
                }
			
			if ($_POST["tipo_form_sist_empre"] == "New") {
                            
                            //validar datos duplicados
                            $sqlV="select emp_ruc,emp_empresa
                                    from dct_sistema_tbl_empresa e
                                    where e.emp_ruc = :emp_ruc
                                    or upper(trim(e.emp_empresa)) = upper(trim(:emp_empresa))";
                            $queryV=$pdo->prepare($sqlV);   
                            $queryV->bindValue(':emp_empresa',cleanData("siLimite",300,"noMayuscula",$_POST["emp_empresa"]),PDO::PARAM_STR);
                            $queryV->bindValue(':emp_ruc',cleanData("siLimite",13,"noMayuscula",$_POST["emp_ruc"]),PDO::PARAM_STR);
                            $queryV->execute();
                            $rowsV = $queryV->fetchAll();
                            if (isset($rowsV) && sizeof($rowsV) > 0) {
                                $data_result["message"] = "error_negocio";
				$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
				$data_result["dataModal_2"] = 'Información';
				$data_result["dataModal_3"] = "El ruc ingresado o el nombre de la empresa, ya se encuentra registrado en el sistema.";
				$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal">Cerrar</button>';
				$data_result["numLineaCodigo"] = __LINE__;
				echo json_encode($data_result);
                                return;
                            }
                            
                            /*
                            //validar logo
                            if ( !isset($_FILES['em_logo_empresa']['error']) )
                            {
                                $data_result["message"] = "error_negocio";
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
                                $data_result["message"] = "error_negocio";
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
                                $data_result["message"] = "error_negocio";
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
                            */
                            
                            //borrar
                            $pathto = "C:\flash_logo.png";
                            
				$sql_2="INSERT INTO dct_sistema_tbl_empresa(emp_empresa, emp_nom_comercial, emp_ruc, emp_estado, emp_vigencia_desde, emp_vigencia_hasta, 
					ctg_id_catalogo, em_usuario_creacion, em_fecha_creacion, em_ip_creacion
                                        , emp_contrib_especial,emp_url_logo,emp_direccion_matriz,wsr_tipo_ambiente,emp_obli_contabilidad)
			    	VALUES (:emp_empresa, :emp_nom_comercial, :emp_ruc, 1, :emp_vigencia_desde, :emp_vigencia_hasta, 
			    		:ctg_id_catalogo, :em_usuario_creacion, now(), :em_ip_creacion
                                        , :emp_contrib_especial,:emp_url_logo,:emp_direccion_matriz,:wsr_tipo_ambiente,:emp_obli_contabilidad);";
		    $query_2=$pdo->prepare($sql_2);          
		    $query_2->bindValue(':emp_empresa',cleanData("siLimite",300,"noMayuscula",$_POST["emp_empresa"]),PDO::PARAM_STR);
                    $query_2->bindValue(':emp_nom_comercial',cleanData("siLimite",300,"noMayuscula",$_POST["emp_nom_comercial"]),PDO::PARAM_STR);
		    $query_2->bindValue(':emp_ruc',cleanData("siLimite",13,"noMayuscula",$_POST["emp_ruc"]),PDO::PARAM_STR);
		    //$query_2->bindValue(':emp_estado',cleanData("siLimite",1,"noMayuscula",$_POST["emp_estado"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':emp_vigencia_desde',cleanData("noLimite",0,"noMayuscula",$_POST["emp_vigencia_desde"]),PDO::PARAM_STR);
		    $query_2->bindValue(':emp_vigencia_hasta',cleanData("noLimite",0,"noMayuscula",$_POST["emp_vigencia_hasta"]),PDO::PARAM_STR);
		    $query_2->bindValue(':ctg_id_catalogo',cleanData("noLimite",0,"noMayuscula",$_POST["ctg_id_catalogo"]),PDO::PARAM_INT);
		    $query_2->bindValue(':em_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':em_ip_creacion',getRealIP(),PDO::PARAM_STR);
                    $query_2->bindValue(':emp_contrib_especial',cleanData("siLimite",1,"noMayuscula",$_POST["emp_contr_esp"] ),PDO::PARAM_INT);
                    $query_2->bindValue(':emp_url_logo',$pathto,PDO::PARAM_STR);
                    $query_2->bindValue(':emp_direccion_matriz',cleanData("noLimite",0,"noMayuscula",$_POST["emp_direccion_matriz"]),PDO::PARAM_STR);
                    $query_2->bindValue(':wsr_tipo_ambiente',cleanData("siLimite",1,"noMayuscula",$_POST["em_tipo_ambiente"] ),PDO::PARAM_INT);
                    $query_2->bindValue(':emp_obli_contabilidad',cleanData("siLimite",2,"noMayuscula",$_POST["emp_obli_contabilidad"]),PDO::PARAM_STR);
		    $query_2->execute();

		    if(!$query_2) 
                    {
                        $pdo->rollBack();
                        $data_result["message"] = "saveError";
                        $data_result["numLineaCodigo"] = __LINE__;
                        echo json_encode($data_result);
                        return;
                    }
                        
                        $empId = $pdo->lastInsertId();
                        $sql_3="INSERT INTO dct_pos_tbl_empresa_serial(emp_id_empresa, ser_factura_serie, ser_nota_credito_serie, ser_nota_debito_serie, ser_guia_remision_serie, ser_comp_ret_serie, ser_estado
                            ,ser_factura_cod_num, ser_nota_credito_cod_num, ser_nota_debito_cod_num, ser_guia_remision_cod_num, ser_comp_ret_cod_num
                            , ser_usuario_creacion, ser_fecha_creacion, ser_ip_creacion)
			    	VALUES (:emp_id_empresa, :ser_factura_serie, :ser_nota_credito_serie, :ser_nota_debito_serie, :ser_guia_remision_serie, :ser_comp_ret_serie, 1
                                ,1,1,1,1,1
                            , :ser_usuario_creacion, now(), :ser_ip_creacion);";
                        $query_3=$pdo->prepare($sql_3);  
                        $query_3->bindValue(':emp_id_empresa',$empId,PDO::PARAM_INT);
                        $query_3->bindValue(':ser_factura_serie',cleanData("noLimite",0,"noMayuscula",$_POST["emp_ser_fact"]),PDO::PARAM_INT);
                        $query_3->bindValue(':ser_nota_credito_serie',cleanData("noLimite",0,"noMayuscula",$_POST["emp_ser_ncred"]),PDO::PARAM_INT);
                        $query_3->bindValue(':ser_nota_debito_serie',cleanData("noLimite",0,"noMayuscula",$_POST["emp_ser_ndeb"]),PDO::PARAM_INT);
                        $query_3->bindValue(':ser_guia_remision_serie',cleanData("noLimite",0,"noMayuscula",$_POST["emp_guia_remision"]),PDO::PARAM_INT);
                        $query_3->bindValue(':ser_comp_ret_serie',cleanData("noLimite",0,"noMayuscula",$_POST["emp_ser_ret"]),PDO::PARAM_INT);
                        $query_3->bindValue(':ser_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
                        $query_3->bindValue(':ser_ip_creacion',getRealIP(),PDO::PARAM_STR);
                        $query_3->execute();
                        
                        $sqlEst="INSERT INTO dct_pos_tbl_empresa_establecimiento(emp_id_empresa, est_direccion_emisor, est_es_matriz, est_estado, est_usuario_creacion, est_fecha_creacion, est_ip_creacion)
			    	VALUES (:emp_id_empresa, :est_direccion_emisor, 1, 1, :est_usuario_creacion, now(), :est_ip_creacion);";
                        $queryEst=$pdo->prepare($sqlEst);  
                        $queryEst->bindValue(':emp_id_empresa',$empId,PDO::PARAM_INT);
                        $queryEst->bindValue(':est_direccion_emisor',cleanData("noLimite",0,"noMayuscula",$_POST["emp_direccion_matriz"]),PDO::PARAM_STR);
                        $queryEst->bindValue(':est_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
                        $queryEst->bindValue(':est_ip_creacion',getRealIP(),PDO::PARAM_STR);
                        $queryEst->execute();
                        
                        $estId = $pdo->lastInsertId();
                        
                        $sqlPem="INSERT INTO dct_pos_tbl_empresa_punto_emision(epe_id_empresa_establecimiento, epe_descripcion_punto_emisor, epe_estado, epe_usuario_creacion, epe_fecha_creacion, epe_ip_creacion)
			    	VALUES (:epe_id_empresa_establecimiento, 'Punto de Emisión 1', 1, :epe_usuario_creacion, now(), :epe_ip_creacion);";
                        $queryPem=$pdo->prepare($sqlPem);  
                        $queryPem->bindValue(':epe_id_empresa_establecimiento',$estId,PDO::PARAM_INT);
                        $queryPem->bindValue(':epe_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
                        $queryPem->bindValue(':epe_ip_creacion',getRealIP(),PDO::PARAM_STR);
                        $queryPem->execute();
                        
			$pdo->commit();
					$data_result["message"] = "saveOK";
					$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
                                        $data_result["dataModal_2"] = 'Información';
                                        $data_result["dataModal_3"] = 'Empresa registada de manera correcta.';
                                        $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-dismiss="modal">Cerrar</button>';
					$data_result["numLineaCodigo"] = __LINE__;
					echo json_encode($data_result);
				
				
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
				
				

	} catch (Exception $ex) {
                $pdo->rollBack();
		$data_result["message"] = "salidaExcepcionCatch";
		$data_result["codError"] = $ex->getCode();
		$data_result["msjError"] = $ex->getMessage();
		$data_result["numLineaCodigo"] = __LINE__;
		echo json_encode($data_result);
	}
?>