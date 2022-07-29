<?php 
	require_once("../../../controller/sesion.class.php");
	require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	require_once("../../../webAdministracion/pages/noAutorizado/index.php");
	app_error_reporting($app_error_reporting);
	try {
		$sesion = new sesion();
		$userSystem = $sesion->get("userSystem");
		$timeout = $sesion->get("timeoutSession");
		if( $userSystem == false ) {	
			header("Location: ../../../webAdministracion/pages/login");
		}
		else if( (time() - $timeout) > $param_timeout) {
			$sesion->set("linkTemp",$url_actual);
			header("Location: ../../../controller/cerrarSesion.php");
		}
		else {
			$sesion->set("timeoutSession",time());
			$ConnectionDB = new ConnectionDB();
			$pdo = $ConnectionDB->connect();
			$pdo->beginTransaction();

			$dataValidaAcceso = [
				'cod_system_user' => $userSystem,
				'fecha_actual' => $fechaActual_4,
				'id_option' => 1
			];
			$returnValidar = validaAcceso($pdo,$dataValidaAcceso);
			$_SESSION["token_csrf"] = $token_csrf;
			$dataSesion = [
				'tipo_ambiente' => $app_error_reporting == 1 ? "PRUEBAS" : "PRODUCCIÓN",
		    'codigoValidacion' => $returnValidar["codigoValidacion"],
		    'complete_names' => $returnValidar["complete_names"],
		    'id_role' => $returnValidar["id_role"],
		    'version_css_js' => $version_css_js,
		    'cod_system_user' => $userSystem,
		    'fecha_actual' => $fechaActual_4,
		    'role' => $returnValidar["role"],
		    'id_option' => $dataValidaAcceso["id_option"],
		    'token_csrf' => $token_csrf
			];
			
			if($returnValidar["estadoValidarAcceso"]) {

				$sql="UPDATE dct_sistema_tbl_usuario
							SET usr_logeado=TRUE,
							usr_ip_pc_acceso=:usr_ip_pc_acceso,
							usr_fecha_acceso=:usr_fecha_acceso,
							usr_contador_error_contrasenia=0,
              usr_ultimo_acceso=:usr_ultimo_acceso
							WHERE usr_cod_usuario = :usr_cod_usuario;";
				$query=$pdo->prepare($sql);
				$query->bindValue(':usr_ip_pc_acceso',getRealIP(),PDO::PARAM_STR);
				$query->bindValue(':usr_cod_usuario',$userSystem,PDO::PARAM_INT);
				$query->bindValue(':usr_fecha_acceso',$fechaActual_1,PDO::PARAM_STR);
        $query->bindValue(':usr_ultimo_acceso',$fechaActual_4,PDO::PARAM_STR);
				$query->execute(); $pdo->commit();

        $sql_pass="SELECT (CURRENT_DATE - usr_fecha_cambio_contrasenia) dias_pass
                  FROM dct_sistema_tbl_usuario
                  WHERE usr_cod_usuario = :usr_cod_usuario;";
        $query_pass=$pdo->prepare($sql_pass);
        $query_pass->bindValue(':usr_cod_usuario', $userSystem);
        $query_pass->execute();
        $row_pass = $query_pass->fetch(\PDO::FETCH_ASSOC);

        if($row_pass["dias_pass"] < 30) {
          $diferencia_pass = 30 - $row_pass["dias_pass"];
        }
        else {
          $diferencia_pass = 0;
        }

				$sesion->set('dataSesion', $dataSesion);
				include('principal.php');
				principal($pdo,$dataSesion,$diferencia_pass);
			}
			else {
				noAutorizado($pdo,$dataSesion); 
			}

		}
	} catch (Exception $ex) {
		$data_result["message"] = "salidaExcepcionCatch";
		$data_result["codError"] = $ex->getCode();
		$data_result["msjError"] = $ex->getMessage();
		$data_result["numLineaCodigo"] = __LINE__;
echo json_encode($data_result);
	}
?>