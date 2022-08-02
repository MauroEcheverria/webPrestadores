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
		
			/*$sql_1="INSERT INTO dct_sistema_tbl_token(tok_token,tok_cedula,tok_fecha,tok_estado,tok_tipo,tok_usuario_creacion,tok_fecha_creacion,tok_ip_creacion) 
								VALUES (:tok_token,:tok_cedula,now(),1,'ACTIVACION',:tok_usuario_creacion,now(),:tok_ip_creacion);";
	    $query_1=$pdo->prepare($sql_1);
	    $query_1->bindValue(':tok_token', $validacionUsuario->setPassword($tokenAsignado));
	    $query_1->bindValue(':tok_cedula', $usr_cedula);
	    $query_1->bindValue(':tok_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
	    $query_1->bindValue(':tok_ip_creacion',getRealIP(),PDO::PARAM_STR);
	    $query_1->execute();
		
			if($query_1) {
				$pdo->commit();
				$data_result["message"] = "saveOK";
				$data_result["numLineaCodigo"] = __LINE__;
				echo json_encode($data_result);
			}
			else {
				$pdo->rollBack();
				$data_result["message"] = "saveError";
				$data_result["numLineaCodigo"] = __LINE__;
				echo json_encode($data_result);
			}*/

			$enviarXML=new enviarXML();
      $dataXML = $enviarXML->envioXML(1,1,$pdo);
      $clave_acceso_sri = explode("&&&&",$dataXML);

			if ($clave_acceso_sri[0] == "cargaOK") {
				$pdo->commit();
	      $data_result["message"] = "saveOK";
	      $data_result["clave_acceso_sri"] = $clave_acceso_sri[1];
	      $data_result["ruta_factura"] = "http://localhost/GIT/webPrestadores/webPosOperaciones/comprobantesElectronicos/".$clave_acceso_sri[1].".xml";
	      $data_result["ruta_certificado"] = "http://localhost/GIT/webPrestadores/webPosOperaciones/cargaFirmaArchivo/0919664854001.p12";
	      $data_result["contrasenia_archivo"] = "Maruto1984";
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