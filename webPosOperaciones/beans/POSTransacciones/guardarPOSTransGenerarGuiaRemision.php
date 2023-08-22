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

		if (!tokenSesionValido()) { return; }

		$sql_fe="SELECT em_archivo_fact_elec,em_pass_fct_elec
					FROM dct_sistema_tbl_empresa 
					WHERE emp_id_empresa = (SELECT usr_id_empresa
          FROM dct_sistema_tbl_usuario
          WHERE usr_cod_usuario = :usr_cod_usuario);";
    $query_fe=$pdo->prepare($sql_fe);
    $query_fe->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
    $query_fe->execute();
    $row_fe = $query_fe->fetch(\PDO::FETCH_ASSOC);

    if ($row_fe["em_archivo_fact_elec"] != "") {



    	$query_inster_bd = true;



			if ($query_inster_bd) {
				$pdo->commit();
				$enviarXML=new enviarXML();
	      $dataXML = $enviarXML->envioXML(25,$_POST["tipoComprobante"],$pdo);
	      $clave_acceso_sri = explode("&&&&",$dataXML);
				if ($clave_acceso_sri[0] == "cargaOK") {
		      $data_result["message"] = "saveOK";
		      $data_result["clave_acceso_sri"] = $clave_acceso_sri[1];
		      $data_result["ruta_xml"] = $host."webPosOperaciones/comprobantesGenerados/".$clave_acceso_sri[1].".xml";
		      $data_result["ruta_certificado"] = $host."webPosOperaciones/cargaFirmaArchivo/".$row_fe["em_archivo_fact_elec"];
		      $data_result["contrasenia_archivo"] = $row_fe["em_pass_fct_elec"];
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