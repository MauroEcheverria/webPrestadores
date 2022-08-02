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

			$sql_fe="SELECT em_archivo_fact_elec,em_pass_fct_elec
						FROM dct_sistema_tbl_empresa 
						WHERE emp_id_empresa = (SELECT usr_id_empresa
	          FROM dct_sistema_tbl_usuario
	          WHERE usr_cod_usuario = :usr_cod_usuario);";
	    $query_fe=$pdo->prepare($sql_fe);
	    $query_fe->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
	    $query_fe->execute();
	    $row_fe = $query_fe->fetch(\PDO::FETCH_ASSOC);

			$enviarXML=new enviarXML();
      $dataXML = $enviarXML->envioXML(2,$_POST["tipoComprobante"],$pdo);
      $clave_acceso_sri = explode("&&&&",$dataXML);

			if ($clave_acceso_sri[0] == "cargaOK") {
				$pdo->commit();
	      $data_result["message"] = "saveOK";
	      $data_result["clave_acceso_sri"] = $clave_acceso_sri[1];
	      $data_result["ruta_factura"] = $host."comprobantesElectronicos/".$clave_acceso_sri[1].".xml";
	      $data_result["ruta_certificado"] = $host."cargaFirmaArchivo/".$row_fe["em_archivo_fact_elec"];
	      $data_result["contrasenia_archivo"] = $row_fe["em_pass_fct_elec"];
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