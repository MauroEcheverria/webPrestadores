<?php
	require_once("../../../controller/sesion.class.php");
	require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	include_once('../../../plugins/facturacionElectronica/generarFacturaXML.php');
	app_error_reporting($app_error_reporting);
	try {
		$sesion = new sesion();
		$dataSesion = $sesion->get('dataSesion');
		$ConnectionDB = new ConnectionDB();
		$pdo = $ConnectionDB->connect();
		$pdo->beginTransaction();
		$validacionUsuario = new ValidacionUsuario();

		if (!tokenSesionValido()) { return; }

		/****************************************/
		$data_comprobante["tipo_comporbante"] = 4;
		/****************************************/

		$data_comprobante["est_id_empresa_establecimiento"] = cleanData("noLimite",0,"noMayuscula",1);
    $data_comprobante["epe_id_empresa_punto_emision"] = cleanData("noLimite",0,"noMayuscula",1);
    $data_comprobante["cli_identificacion"] = cleanData("siLimite",13,"noMayuscula",$_POST["cli_identificacion"]);
    $data_comprobante["fop_id_forma_pago"] = cleanData("siLimite",2,"noMayuscula",$_POST["ftr_id_forma_pago"]);

		$sql_empresa="SELECT emp_id_empresa,emp_ruc,emp_empresa,emp_nom_comercial,emp_direccion_matriz,em_archivo_fact_elec,
												emp_contrib_especial,emp_obli_contabilidad,em_logo,wsr_tipo_ambiente,em_tipo_emision,em_pass_fct_elec
									FROM dct_sistema_tbl_empresa 
									WHERE emp_id_empresa = :emp_id_empresa;";
    $query_empresa=$pdo->prepare($sql_empresa);
    $query_empresa->bindValue(':emp_id_empresa',$dataSesion["usr_id_empresa"],PDO::PARAM_INT);
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

    	$sql_serial="SELECT ser_factura_serie,ser_factura_cod_num
									FROM dct_pos_tbl_empresa_serial 
									WHERE emp_id_empresa = :emp_id_empresa;";
	    $query_serial=$pdo->prepare($sql_serial);
	    $query_serial->bindValue(':emp_id_empresa',$data_comprobante["emp_id_empresa"],PDO::PARAM_INT);
	    $query_serial->execute();
	    $row_serial = $query_serial->fetch(\PDO::FETCH_ASSOC);
    	$data_comprobante["serial_comprobante"] = $row_serial["ser_factura_serie"];
    	$data_comprobante["cod_num_comprobante"] = $row_serial["ser_factura_cod_num"];

    	$sql_cliente="SELECT cli_id_cliente,cli_tipo_identificacion,cli_identificacion,cli_direccion,cli_telefono,cli_placa,cli_correo,
    								CONCAT(IFNULL(cli_nombre_1,''),' ',IFNULL(cli_nombre_2,''),' ',IFNULL(cli_apellido_1,''),' ',IFNULL(cli_apellido_2,'')) cli_nombres
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
	    	$data_comprobante["cli_correo"] = $row_cliente["cli_correo"];

    		$sql_trans_facturacion="SELECT ftr_id_factura_transaccion
																FROM dct_pos_tbl_factura_transaccion 
																WHERE ftr_usuario_creacion = :ftr_usuario_creacion
																AND emp_id_empresa = :emp_id_empresa
																AND ftr_estado_transaccion = 'TMP'
																LIMIT 1;";
		    $query_trans_facturacion=$pdo->prepare($sql_trans_facturacion);
		    $query_trans_facturacion->bindValue(':ftr_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
		    $query_trans_facturacion->bindValue(':emp_id_empresa',$data_comprobante["emp_id_empresa"],PDO::PARAM_INT);
		    $query_trans_facturacion->execute();

		    if ($query_trans_facturacion->rowCount() == 1) {

			    $row_trans_facturacion = $query_trans_facturacion->fetch(\PDO::FETCH_ASSOC);
			    $data_comprobante["ftr_id_factura_transaccion"] = $row_trans_facturacion["ftr_id_factura_transaccion"];

		    	$data_comprobante["sri_clave_acceso_fecha_emison"] = date('dmY', strtotime($fechaActual_4));
					$data_comprobante["sri_clave_acceso_tipo_comprobante"] = str_pad($data_comprobante["tipo_comporbante"],'2','0',STR_PAD_LEFT);
					$data_comprobante["sri_clave_acceso_ruc"] = $data_comprobante["emp_ruc"];
					$data_comprobante["sri_clave_acceso_tipo_ambiente"] = $data_comprobante["wsr_tipo_ambiente"];
					$data_comprobante["sri_clave_acceso_serie_establecimiento"] = str_pad($data_comprobante["est_id_empresa_establecimiento"],'3','0',STR_PAD_LEFT);
					$data_comprobante["sri_clave_acceso_serie_punto_emision"] = str_pad($data_comprobante["epe_id_empresa_punto_emision"],'3','0',STR_PAD_LEFT);
					$data_comprobante["sri_clave_acceso_secuencial"] = str_pad($data_comprobante["serial_comprobante"],'9','0',STR_PAD_LEFT);
					$data_comprobante["sri_clave_acceso_cod_numerico"] = str_pad($data_comprobante["cod_num_comprobante"],'8','0',STR_PAD_LEFT);
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

		    	$sql_update_trans_facturacion="UPDATE dct_pos_tbl_factura_transaccion SET 
															    ftr_fecha_emision=:ftr_fecha_emision,
															    ftr_tipo_comprobante=:ftr_tipo_comprobante,
															    ftr_ruc=:ftr_ruc,
															    ftr_tipo_ambiente=:ftr_tipo_ambiente,
															    ftr_establecimiento=:ftr_establecimiento,
															    ftr_punto_emision=:ftr_punto_emision,
															    ftr_num_comprobante=:ftr_num_comprobante,
															    ftr_cod_numerico=:ftr_cod_numerico,
															    ftr_tipo_emision=:ftr_tipo_emision,
															    ftr_dig_verificador=:ftr_dig_verificador,
															    ftr_sri_clave_acceso=:ftr_sri_clave_acceso,
															    ftr_estado_transaccion = :ftr_estado_transaccion,
															    ftr_usuario_modificacion=:ftr_usuario_modificacion,
														   		ftr_fecha_modificacion=now(),
														   		ftr_ip_modificacion=:ftr_ip_modificacion
															    WHERE ftr_id_factura_transaccion = :ftr_id_factura_transaccion;";
			    $query_update_trans_facturacion=$pdo->prepare($sql_update_trans_facturacion);
			    $query_update_trans_facturacion->bindValue(':ftr_fecha_emision',$data_comprobante["sri_clave_acceso_fecha_emison"],PDO::PARAM_STR);
			    $query_update_trans_facturacion->bindValue(':ftr_tipo_comprobante',$data_comprobante["sri_clave_acceso_tipo_comprobante"],PDO::PARAM_STR);
			    $query_update_trans_facturacion->bindValue(':ftr_ruc',$data_comprobante["sri_clave_acceso_ruc"],PDO::PARAM_STR);
			    $query_update_trans_facturacion->bindValue(':ftr_tipo_ambiente',$data_comprobante["sri_clave_acceso_tipo_ambiente"],PDO::PARAM_STR);
			    $query_update_trans_facturacion->bindValue(':ftr_establecimiento',$data_comprobante["sri_clave_acceso_serie_establecimiento"],PDO::PARAM_STR);
			    $query_update_trans_facturacion->bindValue(':ftr_punto_emision',$data_comprobante["sri_clave_acceso_serie_punto_emision"],PDO::PARAM_STR);
			    $query_update_trans_facturacion->bindValue(':ftr_num_comprobante',$data_comprobante["sri_clave_acceso_secuencial"],PDO::PARAM_STR);
			    $query_update_trans_facturacion->bindValue(':ftr_cod_numerico',$data_comprobante["sri_clave_acceso_cod_numerico"],PDO::PARAM_STR);
			    $query_update_trans_facturacion->bindValue(':ftr_tipo_emision',$data_comprobante["sri_clave_acceso_tipo_emision"],PDO::PARAM_STR);
			    $query_update_trans_facturacion->bindValue(':ftr_dig_verificador',$data_comprobante["sri_clave_acceso_verificador"],PDO::PARAM_STR);
			    $query_update_trans_facturacion->bindValue(':ftr_sri_clave_acceso',$data_comprobante["sri_clave_acceso"],PDO::PARAM_STR);
			    $query_update_trans_facturacion->bindValue(':ftr_id_factura_transaccion',$data_comprobante["ftr_id_factura_transaccion"],PDO::PARAM_INT);
			    $query_update_trans_facturacion->bindValue(':ftr_estado_transaccion','PPR',PDO::PARAM_STR);
			    $query_update_trans_facturacion->bindValue(':ftr_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
			    $query_update_trans_facturacion->bindValue(':ftr_ip_modificacion',getRealIP(),PDO::PARAM_STR);
			    $query_update_trans_facturacion->execute();

			    $sql_serial_facturacion="UPDATE dct_pos_tbl_empresa_serial 
															    SET ser_factura_serie = :ser_factura_serie,
															    		ser_factura_cod_num = :ser_factura_cod_num,
																	    ser_usuario_modificacion=:ser_usuario_modificacion,
																   		ser_fecha_modificacion=now(),
																   		ser_ip_modificacion=:ser_ip_modificacion
															    WHERE emp_id_empresa = :emp_id_empresa;";
					$query_serial_facturacion=$pdo->prepare($sql_serial_facturacion);
					$query_serial_facturacion->bindValue(':emp_id_empresa',$data_comprobante["emp_id_empresa"],PDO::PARAM_INT);
					$query_serial_facturacion->bindValue(':ser_factura_serie',$data_comprobante["serial_comprobante"]+1,PDO::PARAM_STR);
					$query_serial_facturacion->bindValue(':ser_factura_cod_num',$data_comprobante["cod_num_comprobante"]+1,PDO::PARAM_STR);
					$query_serial_facturacion->bindValue(':ser_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
					$query_serial_facturacion->bindValue(':ser_ip_modificacion',getRealIP(),PDO::PARAM_STR);
					$query_serial_facturacion->execute();

					$data_comprobante["fechaActual_4"] = $fechaActual_4;

					if ($query_update_trans_facturacion && $query_serial_facturacion) {
		
						$generarFacturaXML = new generarFacturaXML();
			      $dataXML = $generarFacturaXML->funcGenerarFacturaXML($data_comprobante,$pdo);
			      $clave_acceso_sri = explode("&&&&",$dataXML);
						if ($clave_acceso_sri[0] == "cargaOK") {
				      $data_result["message"] = "saveOK";
				      $data_result["clave_acceso_sri"] = $data_comprobante["sri_clave_acceso"];
				      $data_result["ruta_xml"] = $host."webPosOperaciones/comprobantesGenerados/".$data_comprobante["sri_clave_acceso"].".xml";
				      $data_result["ruta_certificado"] = $host."webPosOperaciones/cargaFirmaArchivo/".$data_comprobante["em_archivo_fact_elec"];
				      $data_result["contrasenia_archivo"] = $data_comprobante["em_pass_fct_elec"];
				      $data_result["id_transaccion"] = $data_comprobante["ftr_id_factura_transaccion"];
							$data_result["numLineaCodigo"] = __LINE__;
							$pdo->commit();
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
		
	} catch (Exception $ex) {
		$data_result["message"] = "salidaExcepcionCatch";
		$data_result["codError"] = $ex->getCode();
		$data_result["msjError"] = $ex->getMessage();
		$data_result["numLineaCodigo"] = __LINE__;
		echo json_encode($data_result);
	}
?>