<?php 
	require_once("../../../controller/sesion.class.php");
	require_once("../../../controller/misFunciones.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	require_once("../../../webMain/pages/noAutorizado/index.php");
	app_error_reporting($app_error_reporting);
	try {
		$sesion = new sesion();
		$userSystem = $sesion->get("userSystem");
		$timeout = $sesion->get("timeoutSession");
		if( $userSystem == false ) {	
			header("Location: ../../../webMain/pages/login");
		}
		else if( (time() - $timeout) > $param_timeout) {
			header("Location: ../../../controller/cerrarSesion");
		}
		else {
			$sesion->set("timeoutSession",time());
			$ConnectionDB = new ConnectionDB();
			$pdo = $ConnectionDB->connect();
			$pdo->beginTransaction();

			$dataValidaAcceso = [
				'cod_system_user' => $userSystem,
				'fecha_actual' => $fechaActual_4,
				'id_option' => 2
			];

			$returnValidar = validaAcceso($pdo,$dataValidaAcceso);
			$dataSesion = [
				'tipo_ambiente' => $app_error_reporting == 1 ? "PRUEBAS" : "PRODUCCIÓN",
		    'cod_system_user' => $userSystem,
		    'complete_names' => $returnValidar["complete_names"],
		    'version_css_js' => $version_css_js,
		    'fecha_actual' => $fechaActual_4,
		    'id_role' => $returnValidar["id_role"],
		    'role' => $returnValidar["role"],
		    'id_option' => 2
			];

			if($returnValidar["estadoValidarAcceso"]) {

				$sql="UPDATE dct_sistema_tbl_usuario
							SET usr_logeado=TRUE,
							usr_ip_pc_acceso=:usr_ip_pc_acceso,
							usr_fecha_acceso=:usr_fecha_acceso,
							usr_contador_error_contrasenia=0
							WHERE usr_cod_usuario = :usr_cod_usuario;";
				$query=$pdo->prepare($sql);
				$query->bindValue(':usr_ip_pc_acceso',getRealIP(),PDO::PARAM_STR);
				$query->bindValue(':usr_cod_usuario',$userSystem,PDO::PARAM_INT);
				$query->bindValue(':usr_fecha_acceso',$fechaActual_1,PDO::PARAM_STR);
				$query->execute(); $pdo->commit();

				$sesion->set('dataSesion', $dataSesion);
				dinclude('administrarUsuarios.php');
				administrarUsuarios($pdo,$dataSesion);

			}
			else {
				if (!$returnValidar["valEstadoUsuario"]) {
					callCerrarSesion();
					echo "<script type='text/javascript'>$('#modalCerrarUserInactivo').modal('show');</script>"
					return;
				}
				else if (!$returnValidar["valEstadoContrasena"]) {
					callCerrarSesion();
					echo "<script type='text/javascript'>$('#modalContraseñaInactiva').modal('show');</script>";
					return;
				}
				else if (!$returnValidar["valExpiroContrasena"]) {
					callCerrarSesion();
					echo "<script type='text/javascript'>$('#modalCerrarExpirePass').modal('show');</script>";
					return;
				}
				else if (!$returnValidar["valEnOtraPC"]) {
					callCerrarSesion();
					echo "<script type='text/javascript'>$('#modalCerrarSesionOtraPC').modal('show');</script>";
					return;
				}
				else if (!$returnValidar["valEstadoOpcion"] || $returnValidar["valAccesoOpcion"]) {
					noAutorizado($pdo,$dataSesion);
					return;
				}
				else if (!$returnValidar["valEstadoAplicativo"]) {
					callCerrarSesion();
					echo "<script type='text/javascript'>$('#modalCerrarSesionOtraPC').modal('show');</script>";
					return;
				}
				else if (!$returnValidar["valEstadoRol"]) {
					callCerrarSesion();
					echo "<script type='text/javascript'>$('#modalCerrarSesionOtraPC').modal('show');</script>";
					return;
				}
				else if (!$returnValidar["valEstadoEmpresa"]) {
					callCerrarSesion();
					echo "<script type='text/javascript'>$('#modalCerrarSesionOtraPC').modal('show');</script>";
					return;
				}
				else if (!$returnValidar["valEstadoVigencia"]) {
					callCerrarSesion();
					echo "<script type='text/javascript'>$('#modalCerrarSesionOtraPC').modal('show');</script>";
					return;
				}
				else {
					callCerrarSesion();
					echo "<script type='text/javascript'>$('#modalCerrarSesionOtraPC').modal('show');</script>";
					return;
				}
			}

		}
	} catch (\PDOException $e) {
    echo $e->getMessage();
	}
?>