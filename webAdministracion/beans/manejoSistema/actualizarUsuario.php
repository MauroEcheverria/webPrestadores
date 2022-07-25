<?php
	require_once("../../../controller/sesion.class.php");
	require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$sesion = new sesion();
		$dataSesion = $sesion->get('dataSesion');
		$ConnectionDB = new ConnectionDB();
		$pdo = $ConnectionDB->connect();
		$pdo->beginTransaction();

		if (isset($_POST["csrf"]) && hash_equals($_SESSION["token_csrf"],$_POST["csrf"])) {
			$usr_cod_usuario = cleanData("siLimite",13,"noMayuscula",$_POST["usr_cod_usuario"]);
			$usr_nombre_1 = cleanData("siLimite",15,"noMayuscula",$_POST["edit_usr_nombre_1"]);
			$usr_nombre_2 = cleanData("siLimite",15,"noMayuscula",$_POST["edit_usr_nombre_2"]);
			$usr_apellido_1 = cleanData("siLimite",15,"noMayuscula",$_POST["edit_usr_apellido_1"]);
			$usr_apellido_2 = cleanData("siLimite",15,"noMayuscula",$_POST["edit_usr_apellido_2"]);
			$usr_correo = strtolower(cleanData("siLimite",60,"noMayuscula",$_POST["edit_usr_correo"]));
			$usr_nom_completos = $usr_nombre_1." ".$usr_nombre_2." ".$usr_apellido_1." ".$usr_apellido_2;

			$data_fast = 0;
			if ( strlen($usr_nombre_1) >= 3 && strlen($usr_nombre_1) <= 48) {
				$data_fast += 1;
			}
			if ( strlen($usr_nombre_2) >= 2 && strlen($usr_nombre_2) <= 50) {
				$data_fast += 1;
			}
			if ( strlen($usr_apellido_1) >= 3 && strlen($usr_apellido_1) <= 48) {
				$data_fast += 1;
			}
			if ( strlen($usr_correo) >= 6 && strlen($usr_correo) <= 128) {
				$data_fast += 1;
			}
			if ($data_fast < 4) {
				$data_result["message"] = "errorCriterios";
				echo json_encode($data_result);
			}
			else {
				$sql="UPDATE dct_sistema_tbl_usuario
				   		SET usr_correo=:usr_correo, 
				   		usr_id_rol=:usr_id_rol, 
				   		usr_estado=:usr_estado, 
				   		usr_id_empresa = :usr_id_empresa,
				   		usr_usuario_modificacion=:usr_usuario_modificacion,
				   		usr_fecha_modificacion=now(),
				   		usr_ip_modificacion=:usr_ip_modificacion,
				   		usr_nombre_1 = :usr_nombre_1,
				   		usr_nombre_2 = :usr_nombre_2,
				   		usr_apellido_1 = :usr_apellido_1,
				   		usr_apellido_2 = :usr_apellido_2
						 	WHERE usr_cod_usuario=:usr_cod_usuario;";
		    $query=$pdo->prepare($sql);
		    $query->bindValue(':usr_correo',$usr_correo,PDO::PARAM_STR); 
		    $query->bindValue(':usr_id_rol',cleanData("siLimite",1,"noMayuscula",$_POST["edit_usr_id_rol"]),PDO::PARAM_INT);
		    $query->bindValue(':usr_nombre_1',$usr_nombre_1,PDO::PARAM_STR);
		    $query->bindValue(':usr_nombre_2',$usr_nombre_2,PDO::PARAM_STR);
		    $query->bindValue(':usr_apellido_1',$usr_apellido_1,PDO::PARAM_STR);
		    $query->bindValue(':usr_apellido_2',$usr_apellido_2,PDO::PARAM_STR); 
		    $query->bindValue(':usr_estado',cleanData("siLimite",1,"noMayuscula",$_POST["edit_usr_estado"]),PDO::PARAM_INT);
		    $query->bindValue(':usr_cod_usuario',$usr_cod_usuario,PDO::PARAM_INT); 
		    $query->bindValue(':usr_id_empresa',cleanData("siLimite",1,"noMayuscula",$_POST["edit_usr_id_empresa"]),PDO::PARAM_INT); 
		    $query->bindValue(':usr_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query->bindValue(':usr_ip_modificacion',getRealIP(),PDO::PARAM_STR);
		    $query->execute();
				if($query) {
					$pdo->commit();
					$data_result["message"] = "saveOK";
					$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
		      $data_result["dataModal_2"] = 'Información';
		      $data_result["dataModal_3"] = 'El usuario se actualizó de manera correcta.';
		      $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
					echo json_encode($data_result);
				}
				else {
					$pdo->rollBack();
					$data_result["message"] = "saveError";
					echo json_encode($data_result);
				}
			}
		}
		else {
			$data_result["message"] = "token_csrf_error";
			$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
			$data_result["dataModal_2"] = 'Información';
			$data_result["dataModal_3"] = "Token de seguridad inválido, refresque el aplicativo WEB.";
			$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
			echo json_encode($data_result);
		}
				
	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}
?>