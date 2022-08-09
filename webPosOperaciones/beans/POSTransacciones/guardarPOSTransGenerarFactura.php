<?php
	require_once("../../../controller/sesion.class.php");
	require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	include_once('../../../plugins/facturacionElectronica/generarXML.php');
	app_error_reporting($app_error_reporting);
	try {
		$sesion = new sesion();
		$dataSesion = $sesion->get('dataSesion');
		$ConnectionDB = new ConnectionDB();
		$pdo = $ConnectionDB->connect();
		$pdo->beginTransaction();
		$validacionUsuario = new ValidacionUsuario();

		if (isset($_POST["csrf"]) && hash_equals($_SESSION["token_csrf"],$_POST["csrf"])) {

			/****************************************/
			$data_comprobante["tipo_comporbante"] = 1;
			/****************************************/

			$data_comprobante["est_id_empresa_establecimiento"] = cleanData("noLimite",0,"noMayuscula",$_POST["est_id_empresa_establecimiento"]);
	    $data_comprobante["epe_id_empresa_punto_emision"] = cleanData("noLimite",0,"noMayuscula",$_POST["epe_id_empresa_punto_emision"]);
	    $data_comprobante["cli_identificacion"] = cleanData("siLimite",13,"noMayuscula",$_POST["cli_identificacion"]);
	    $data_comprobante["fop_id_forma_pago"] = cleanData("siLimite",2,"noMayuscula",$_POST["fop_id_forma_pago"]);

			$sql_empresa="SELECT emp_id_empresa,emp_ruc,emp_empresa,emp_nom_comercial,emp_direccion_matriz,emp_contrib_especial,emp_obli_contabilidad,em_logo,wsr_tipo_ambiente,em_tipo_emision,em_archivo_fact_elec,em_pass_fct_elec
										FROM dct_sistema_tbl_empresa 
										WHERE emp_id_empresa = (SELECT usr_id_empresa
					          FROM dct_sistema_tbl_usuario
					          WHERE usr_cod_usuario = :usr_cod_usuario);";
	    $query_empresa=$pdo->prepare($sql_empresa);
	    $query_empresa->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
	    $query_empresa->execute();
	    $row_empresa = $query_empresa->fetch(\PDO::FETCH_ASSOC);
	    $data_comprobante["emp_id_empresa"] = $row_empresa["emp_id_empresa"];
	    $data_comprobante["emp_ruc"] = $row_empresa["emp_ruc"];
	    $data_comprobante["emp_empresa"] = $row_empresa["emp_empresa"];
	    $data_comprobante["emp_nom_comercial"] = $row_empresa["emp_nom_comercial"];
	    $data_comprobante["emp_direccion_matriz"] = $row_empresa["emp_direccion_matriz"];
	    $data_comprobante["emp_contrib_especial"] = $row_empresa["emp_contrib_especial"];
	    $data_comprobante["emp_obli_contabilidad"] = $row_empresa["emp_obli_contabilidad"];
	    $data_comprobante["em_logo"] = $row_empresa["em_logo"];
	    $data_comprobante["wsr_tipo_ambiente"] = $row_empresa["wsr_tipo_ambiente"];
	    $data_comprobante["em_tipo_emision"] = $row_empresa["em_tipo_emision"];
	    $data_comprobante["em_archivo_fact_elec"] = $row_empresa["em_archivo_fact_elec"];
	    $data_comprobante["em_pass_fct_elec"] = $row_empresa["em_pass_fct_elec"];

	    if ($data_comprobante["em_archivo_fact_elec"] != "") {

	    	$sql_serial="SELECT ser_factura
										FROM dct_pos_tbl_empresa_serial 
										WHERE emp_id_empresa = :emp_id_empresa;";
		    $query_serial=$pdo->prepare($sql_serial);
		    $query_serial->bindValue(':emp_id_empresa',$data_comprobante["emp_id_empresa"],PDO::PARAM_INT);
		    $query_serial->execute();
		    $row_serial = $query_serial->fetch(\PDO::FETCH_ASSOC);
	    	$data_comprobante["serial_comprobante"] = $row_serial["ser_factura"];

	    	$sql_cliente="SELECT cli_id_cliente,cli_tipo_identificacion,cli_identificacion,cli_nombres,cli_direccion,cli_telefono,cli_placa
											FROM dct_pos_tbl_cientes 
											WHERE cli_identificacion = :cli_identificacion
											AND emp_id_empresa = :emp_id_empresa;";
		    $query_cliente=$pdo->prepare($sql_cliente);
		    $query_cliente->bindValue(':cli_identificacion',$data_comprobante["cli_identificacion"],PDO::PARAM_INT);
		    $query_cliente->bindValue(':emp_id_empresa',$data_comprobante["emp_id_empresa"],PDO::PARAM_INT);
		    $query_cliente->execute();

	    	if ($query_cliente->rowCount() == 1) {

	    	$row_cliente = $query_cliente->fetch(\PDO::FETCH_ASSOC);
	    	$data_comprobante["cli_id_cliente"] = $row_cliente["cli_id_cliente"];
	    	$data_comprobante["cli_tipo_identificacion"] = $row_cliente["cli_tipo_identificacion"];
	    	$data_comprobante["cli_identificacion"] = $row_cliente["cli_identificacion"];
	    	$data_comprobante["cli_nombres"] = $row_cliente["cli_nombres"];
	    	$data_comprobante["cli_direccion"] = $row_cliente["cli_direccion"];
	    	$data_comprobante["cli_telefono"] = $row_cliente["cli_telefono"];
	    	$data_comprobante["cli_placa"] = $row_cliente["cli_placa"];

	    		$sql_trans_facturacion="SELECT ftr_id_factura_transaccion
												FROM dct_pos_tbl_factura_transaccion 
												WHERE usr_cod_usuario = :usr_cod_usuario
												AND emp_id_empresa = :emp_id_empresa
												AND ftr_estado_transaccion = 'TMP'
												AND ftr_estado = 1
												LIMIT 1;";
			    $query_trans_facturacion=$pdo->prepare($sql_trans_facturacion);
			    $query_trans_facturacion->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
			    $query_trans_facturacion->bindValue(':emp_id_empresa',$data_comprobante["emp_id_empresa"],PDO::PARAM_INT);
			    $query_trans_facturacion->execute();

			    if ($query_trans_facturacion->rowCount() == 1) {

			    $row_trans_facturacion = $query_trans_facturacion->fetch(\PDO::FETCH_ASSOC);
			    $data_comprobante["ftr_id_factura_transaccion"] = $row_trans_facturacion["ftr_id_factura_transaccion"];

			    	$sql_trans_facturacion="UPDATE dct_pos_tbl_factura_transaccion 
																    SET ftr_estado_transaccion = :ftr_estado_transaccion,
																		    ftr_usuario_modificacion=:ftr_usuario_modificacion,
																	   		ftr_fecha_modificacion=now(),
																	   		ftr_ip_modificacion=:ftr_ip_modificacion
																    WHERE ftr_id_factura_transaccion = :ftr_id_factura_transaccion;";
				    $query_trans_facturacion=$pdo->prepare($sql_trans_facturacion);
				    $query_trans_facturacion->bindValue(':ftr_id_factura_transaccion',$data_comprobante["ftr_id_factura_transaccion"],PDO::PARAM_INT);
				    $query_trans_facturacion->bindValue(':ftr_estado_transaccion','AUT',PDO::PARAM_STR);
				    $query_trans_facturacion->bindValue(':ftr_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
				    $query_trans_facturacion->bindValue(':ftr_ip_modificacion',getRealIP(),PDO::PARAM_STR);
				    $query_trans_facturacion->execute();

				    $sql_detalle_facturacion="UPDATE dct_pos_tbl_factura_detalle 
																    SET fdt_estado_transaccion = :fdt_estado_transaccion,
																		    fdt_usuario_modificacion=:fdt_usuario_modificacion,
																	   		fdt_fecha_modificacion=now(),
																	   		fdt_ip_modificacion=:fdt_ip_modificacion
																    WHERE ftr_id_factura_transaccion = :ftr_id_factura_transaccion;";
						$query_detalle_facturacion=$pdo->prepare($sql_detalle_facturacion);
						$query_detalle_facturacion->bindValue(':ftr_id_factura_transaccion',$data_comprobante["ftr_id_factura_transaccion"],PDO::PARAM_INT);
						$query_detalle_facturacion->bindValue(':fdt_estado_transaccion','AUT',PDO::PARAM_STR);
						$query_detalle_facturacion->bindValue(':fdt_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
						$query_detalle_facturacion->bindValue(':fdt_ip_modificacion',getRealIP(),PDO::PARAM_STR);
						$query_detalle_facturacion->execute();

						$data_comprobante["sri_clave_acceso_fecha_emison"] = date('dmY', strtotime($fechaActual_4));
						$data_comprobante["sri_clave_acceso_tipo_comprobante"] = str_pad($data_comprobante["tipo_comporbante"],'2','0',STR_PAD_LEFT);
						$data_comprobante["sri_clave_acceso_ruc"] = $data_comprobante["emp_ruc"];
						$data_comprobante["sri_clave_acceso_tipo_ambiente"] = $data_comprobante["wsr_tipo_ambiente"];
						$data_comprobante["sri_clave_acceso_serie_establecimiento"] = str_pad($data_comprobante["est_id_empresa_establecimiento"],'3','0',STR_PAD_LEFT);
						$data_comprobante["sri_clave_acceso_serie_punto_emision"] = str_pad($data_comprobante["epe_id_empresa_punto_emision"],'3','0',STR_PAD_LEFT);
						$data_comprobante["sri_clave_acceso_secuencial"] = str_pad($data_comprobante["serial_comprobante"],'9','0',STR_PAD_LEFT);
						$data_comprobante["sri_clave_acceso_cod_numerico"] = str_pad($data_comprobante["ftr_id_factura_transaccion"],'8','0',STR_PAD_LEFT);
						$data_comprobante["sri_clave_acceso_tipo_emision"] = $data_comprobante["em_tipo_emision"];
						$data_comprobante["sri_clave_acceso_verificador"] = validar_clave_sri($data_comprobante["sri_clave_acceso_fecha_emison"].
		                                                            $data_comprobante["sri_clave_acceso_tipo_comprobante"].
		                                                            $data_comprobante["sri_clave_acceso_ruc"].
		                                                            $data_comprobante["sri_clave_acceso_tipo_ambiente"].
		                                                            $data_comprobante["sri_clave_acceso_serie_establecimiento"].
		                                                            $data_comprobante["sri_clave_acceso_serie_punto_emision"].
		                                                            $data_comprobante["sri_clave_acceso_secuencial"].
		                                                            $data_comprobante["sri_clave_acceso_cod_numerico"].
		                                                            $data_comprobante["sri_clave_acceso_tipo_emision"]);
		        $data_comprobante["sri_clave_acceso"] = $data_comprobante["sri_clave_acceso_fecha_emison"].
												                            $data_comprobante["sri_clave_acceso_tipo_comprobante"].
												                            $data_comprobante["sri_clave_acceso_ruc"].
												                            $data_comprobante["sri_clave_acceso_tipo_ambiente"].
												                            $data_comprobante["sri_clave_acceso_serie_establecimiento"].
												                            $data_comprobante["sri_clave_acceso_serie_punto_emision"].
												                            $data_comprobante["sri_clave_acceso_secuencial"].
												                            $data_comprobante["sri_clave_acceso_cod_numerico"].
												                            $data_comprobante["sri_clave_acceso_tipo_emision"].
												                            $data_comprobante["sri_clave_acceso_verificador"];

						$sql_clave_acceso="INSERT INTO dct_pos_tbl_clave_acceso(emp_id_empresa, cli_id_cliente, ftr_id_factura_transaccion, cla_fecha_emision, 
							cla_tipo_comprobante, cla_ruc, cla_tipo_ambiente, cla_establecimiento, cla_punto_emision, cla_num_comprobante, cla_cod_numerico, 
							cla_tipo_emision, cla_dig_verificador, cla_estado_comprobante, cla_estado, cla_usuario_creacion, cla_fecha_creacion, cla_ip_creacion) 
						VALUES (:emp_id_empresa, :cli_id_cliente, :ftr_id_factura_transaccion, :cla_fecha_emision, :cla_tipo_comprobante, :cla_ruc, :cla_tipo_ambiente, :cla_establecimiento, :cla_punto_emision, :cla_num_comprobante, :cla_cod_numerico, :cla_tipo_emision, :cla_dig_verificador, 'PPR', 1, :cla_usuario_creacion, now(), :cla_ip_creacion);";
				    $query_clave_acceso=$pdo->prepare($sql_clave_acceso);
				    $query_clave_acceso->bindValue(':emp_id_empresa',$data_comprobante["emp_id_empresa"],PDO::PARAM_INT);
				    $query_clave_acceso->bindValue(':cli_id_cliente',$data_comprobante["cli_id_cliente"],PDO::PARAM_INT);
				    $query_clave_acceso->bindValue(':ftr_id_factura_transaccion',$data_comprobante["ftr_id_factura_transaccion"],PDO::PARAM_INT);
				    $query_clave_acceso->bindValue(':cla_fecha_emision',$sri_clave_acceso_fecha_emison,PDO::PARAM_STR);
				    $query_clave_acceso->bindValue(':cla_tipo_comprobante',$sri_clave_acceso_tipo_comprobante,PDO::PARAM_STR);
				    $query_clave_acceso->bindValue(':cla_ruc',$sri_clave_acceso_ruc,PDO::PARAM_STR);
				    $query_clave_acceso->bindValue(':cla_tipo_ambiente',$sri_clave_acceso_tipo_ambiente,PDO::PARAM_STR);
				    $query_clave_acceso->bindValue(':cla_establecimiento',$sri_clave_acceso_serie_establecimiento,PDO::PARAM_STR);
				    $query_clave_acceso->bindValue(':cla_punto_emision',$sri_clave_acceso_serie_punto_emision,PDO::PARAM_STR);
				    $query_clave_acceso->bindValue(':cla_num_comprobante',$sri_clave_acceso_secuencial,PDO::PARAM_STR);
				    $query_clave_acceso->bindValue(':cla_cod_numerico',$sri_clave_acceso_cod_numerico,PDO::PARAM_STR);
				    $query_clave_acceso->bindValue(':cla_tipo_emision',$sri_clave_acceso_tipo_emision,PDO::PARAM_STR);
				    $query_clave_acceso->bindValue(':cla_dig_verificador',$sri_clave_acceso_verificador,PDO::PARAM_STR);
				    $query_clave_acceso->bindValue(':cla_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
				    $query_clave_acceso->bindValue(':cla_ip_creacion',getRealIP(),PDO::PARAM_STR);
				    $query_clave_acceso->execute();

				    $sql_serial_facturacion="UPDATE dct_pos_tbl_empresa_serial 
																    SET ser_factura = :ser_factura,
																		    ser_usuario_modificacion=:ser_usuario_modificacion,
																	   		ser_fecha_modificacion=now(),
																	   		ser_ip_modificacion=:ser_ip_modificacion
																    WHERE emp_id_empresa = :emp_id_empresa;";
						$query_serial_facturacion=$pdo->prepare($sql_serial_facturacion);
						$query_serial_facturacion->bindValue(':emp_id_empresa',$data_comprobante["emp_id_empresa"],PDO::PARAM_INT);
						$query_serial_facturacion->bindValue(':ser_factura',$data_comprobante["serial_comprobante"]+1,PDO::PARAM_STR);
						$query_serial_facturacion->bindValue(':ser_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
						$query_serial_facturacion->bindValue(':ser_ip_modificacion',getRealIP(),PDO::PARAM_STR);
						$query_serial_facturacion->execute();

						if ($query_trans_facturacion && $query_detalle_facturacion && $query_clave_acceso && $query_serial_facturacion) {

							$pdo->commit();

							$enviarXML=new enviarXML();
				      $dataXML = $enviarXML->envioXML($data_comprobante,$pdo);
				      $clave_acceso_sri = explode("&&&&",$dataXML);
							if ($clave_acceso_sri[0] == "cargaOK") {
					      $data_result["message"] = "saveOK";
					      $data_result["clave_acceso_sri"] = $clave_acceso_sri[1];
					      $data_result["ruta_xml"] = $host."webPosOperaciones/comprobantesGenerados/".$clave_acceso_sri[1].".xml";
					      $data_result["ruta_certificado"] = $host."webPosOperaciones/cargaFirmaArchivo/".$data_comprobante["em_archivo_fact_elec"];
					      $data_result["contrasenia_archivo"] = $data_comprobante["em_pass_fct_elec"];
								$data_result["numLineaCodigo"] = __LINE__;
								echo json_encode($data_result);
							}
							else {
					      $data_result["message"] = "saveXmlError";
								$data_result["numLineaCodigo"] = __LINE__;
								echo json_encode($data_result);
							}

						}
						else {
							$pdo->rollBack();
							$data_result["message"] = "saveDbError";
							$data_result["numLineaCodigo"] = __LINE__;
							echo json_encode($data_result);
						}
			    }
			    else {
			    	$pdo->rollBack();
						$data_result["message"] = "transaccionNoExiste";
						$data_result["numLineaCodigo"] = __LINE__;
						echo json_encode($data_result);
			    }  
	    	}
	    	else {
	    		$pdo->rollBack();
					$data_result["message"] = "clienteNoExiste";
					$data_result["numLineaCodigo"] = __LINE__;
					echo json_encode($data_result);
	    	}	
	    }
	    else {
	    	$pdo->rollBack();
				$data_result["message"] = "noPoseeFirma";
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