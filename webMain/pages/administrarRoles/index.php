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
			$sql="SELECT u.usr_cod_usuario,u.usr_ip_pc_acceso,u.usr_id_rol, u.usr_estado,u.usr_estado_contrasenia,u.usr_expiro_contrasenia,
						CONCAT(usr_nombre_1,' ',usr_nombre_2,' ',usr_apellido_1,' ', usr_apellido_2) usr_nom_completos, r.rol_rol
						FROM dct_sistema_tbl_usuario u, dct_sistema_tbl_rol r, dct_sistema_tbl_empresa m
						WHERE u.usr_id_rol=r.rol_id_rol
						AND u.usr_id_empresa=m.emp_id_empresa
						AND u.usr_cod_usuario=:usr_cod_usuario;";
	    $query=$pdo->prepare($sql);
	    $query->bindValue(':usr_cod_usuario',$userSystem,PDO::PARAM_INT);
	    $query->execute();
	    $row = $query->fetch(\PDO::FETCH_ASSOC);
	    if($row["usr_estado"] == 'A') {
		    if($row["usr_estado_contrasenia"] == 'A') {
		    	if($row["usr_expiro_contrasenia"] == 'N') {
		    		if($row["usr_ip_pc_acceso"] == getRealIP() || $row["usr_ip_pc_acceso"] == NULL) {
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
							$query->execute();
							if ($query) {
								$pdo->commit();
								$getToken = new ValidacionUsuario();
								$dataSesion = [
									'tipo_ambiente' => $app_error_reporting == 1 ? "PRUEBAS" : "PRODUCCIÓN",
							    'cod_system_user' => $row['usr_cod_usuario'],
							    'complete_names' => $row['usr_nom_completos'],
							    'version_css_js' => $version_css_js,
							    'id_role' => $row['usr_id_rol'],
							    'role' => $row['rol_rol'],
							    'id_option' => 3
								];
                $sesion->set('dataSesion', $dataSesion);
								include('administrarRoles.php');
								if(validaAcceso($pdo,$dataSesion) == 1) { 
									administrarRoles($pdo,$dataSesion);
								}
								else { 
									noAutorizado($pdo,$dataSesion); 
								}
							}
							else {
								$pdo->rollBack();
							}		
						}
						else {
							callCerrarSesion();
							echo "<script type='text/javascript'>$('#modalCerrarSesionOtraPC').modal('show');</script>";
						}
		    	}
		    	else {
		    		callCerrarSesion();
						echo "<script type='text/javascript'>$('#modalCerrarExpirePass').modal('show');</script>";
		    	}
		    }
		    else {
		    	callCerrarSesion();
					echo "<script type='text/javascript'>$('#modalContraseñaInactiva').modal('show');</script>";
		    }
		  }
	    else {
	    	callCerrarSesion();
				echo "<script type='text/javascript'>$('#modalCerrarUserInactivo').modal('show');</script>";
	    }
		}
	} catch (\PDOException $e) {
    echo $e->getMessage();
	}
?>