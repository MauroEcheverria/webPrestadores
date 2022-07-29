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

		if (isset($_POST["csrf"]) && hash_equals($_SESSION["token_csrf"],$_POST["csrf"])) {

			if (strlen($_POST["adi_celular"]) == 10) {
				$celular_numero = "593".intval($_POST["adi_celular"]);
			}
			else {
				$celular_numero = $_POST["adi_celular"];
			}
			
			if ($_POST["tipo_form"] == "New") {
				$sql_2="INSERT INTO dct_sistema_tbl_usuario_adicional(usr_cod_usuario, adi_fecha_nacimiento, adi_sexo, 
					adi_estado_civil, adi_instruccion, adi_tipo_sangre, adi_celular, adi_provincia, adi_canton, adi_parroquia, 
					adi_direccion, adi_referencia, usr_usuario_creacion, usr_fecha_creacion, usr_ip_creacion)
			    	VALUES (:usr_cod_usuario, :adi_fecha_nacimiento, :adi_sexo, :adi_estado_civil, :adi_instruccion, 
			    		:adi_tipo_sangre, :adi_celular, :adi_provincia, :adi_canton, :adi_parroquia, :adi_direccion, 
			    		:adi_referencia, :usr_usuario_creacion, now(), :usr_ip_creacion);";
		    $query_2=$pdo->prepare($sql_2);
		    $query_2->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':adi_fecha_nacimiento',cleanData("noLimite",0,"noMayuscula",$_POST["adi_fecha_nacimiento"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_sexo',cleanData("siLimite",9,"noMayuscula",$_POST["adi_sexo"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_estado_civil',cleanData("siLimite",12,"noMayuscula",$_POST["adi_estado_civil"]),PDO::PARAM_STR); 
		    $query_2->bindValue(':adi_instruccion',cleanData("siLimite",11,"noMayuscula",$_POST["adi_instruccion"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_tipo_sangre',cleanData("siLimite",9,"noMayuscula",$_POST["adi_tipo_sangre"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_celular',cleanData("siLimite",13,"noMayuscula",$celular_numero),PDO::PARAM_INT);
		    $query_2->bindValue(':adi_provincia',cleanData("siLimite",5,"noMayuscula",$_POST["adi_provincia"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_canton',cleanData("siLimite",7,"noMayuscula",$_POST["adi_canton"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_parroquia',cleanData("siLimite",9,"noMayuscula",$_POST["adi_parroquia"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_direccion',cleanData("siLimite",70,"noMayuscula",$_POST["adi_direccion"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_referencia',cleanData("siLimite",50,"noMayuscula",$_POST["adi_referencia"]),PDO::PARAM_STR);
		    $query_2->bindValue(':usr_usuario_creacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':usr_ip_creacion',getRealIP(),PDO::PARAM_STR);
		    $query_2->execute();

		    if($query_2) {

		    	/*$client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);
					$body="📲 Su registro a sido guardado correctamente ✔"; 
					$api=$client->sendChatMessage($celular_numero,$body);
					$data_result["sendChatMessage"] = $api["message"];*/

					$pdo->commit();
					$data_result["message"] = "saveOK";
					$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
		      $data_result["dataModal_2"] = 'Información';
		      $data_result["dataModal_3"] = 'Perfíl registado de manera correcta.';
		      $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
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
			else if ($_POST["tipo_form"] == "Old") {
				$sql_2="UPDATE dct_sistema_tbl_usuario_adicional
					SET adi_fecha_nacimiento = :adi_fecha_nacimiento, adi_sexo = :adi_sexo, adi_estado_civil = :adi_estado_civil, 
					adi_instruccion = :adi_instruccion, adi_tipo_sangre = :adi_tipo_sangre, adi_celular = :adi_celular, 
					adi_provincia = :adi_provincia, adi_canton = :adi_canton, adi_parroquia = :adi_parroquia, 
					adi_direccion = :adi_direccion, adi_referencia = :adi_referencia, usr_usuario_modificacion = :usr_usuario_modificacion, 
					usr_fecha_modificacion = now(), usr_ip_modificacion = :usr_ip_modificacion
				WHERE usr_cod_usuario = :usr_cod_usuario";
		    $query_2=$pdo->prepare($sql_2);
		    $query_2->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':adi_fecha_nacimiento',cleanData("noLimite",0,"noMayuscula",$_POST["adi_fecha_nacimiento"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_sexo',cleanData("siLimite",9,"noMayuscula",$_POST["adi_sexo"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_estado_civil',cleanData("siLimite",12,"noMayuscula",$_POST["adi_estado_civil"]),PDO::PARAM_STR); 
		    $query_2->bindValue(':adi_instruccion',cleanData("siLimite",11,"noMayuscula",$_POST["adi_instruccion"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_tipo_sangre',cleanData("siLimite",9,"noMayuscula",$_POST["adi_tipo_sangre"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_celular',cleanData("siLimite",13,"noMayuscula",$celular_numero),PDO::PARAM_INT);
		    $query_2->bindValue(':adi_provincia',cleanData("siLimite",5,"noMayuscula",$_POST["adi_provincia"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_canton',cleanData("siLimite",7,"noMayuscula",$_POST["adi_canton"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_parroquia',cleanData("siLimite",9,"noMayuscula",$_POST["adi_parroquia"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_direccion',cleanData("siLimite",70,"noMayuscula",$_POST["adi_direccion"]),PDO::PARAM_STR);
		    $query_2->bindValue(':adi_referencia',cleanData("siLimite",50,"noMayuscula",$_POST["adi_referencia"]),PDO::PARAM_STR);
		    $query_2->bindValue(':usr_usuario_modificacion',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
		    $query_2->bindValue(':usr_ip_modificacion',getRealIP(),PDO::PARAM_STR);
		    $query_2->execute();

		    if($query_2) {

		    	/*$client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);
		    	$body="📲 Su registro a sido actualizado correctamente ✔"; 
					$api=$client->sendChatMessage($celular_numero,$body);
					$data_result["sendChatMessage"] = $api["message"];*/

					$pdo->commit();
					$data_result["message"] = "saveOK";
					$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
		      $data_result["dataModal_2"] = 'Información';
		      $data_result["dataModal_3"] = 'Perfíl modificado de manera correcta.';
		      $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
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
				$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
				$data_result["numLineaCodigo"] = __LINE__;
echo json_encode($data_result);
			}	
				
		}
		else {
			$data_result["message"] = "token_csrf_error";
			$data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
			$data_result["dataModal_2"] = 'Información';
			$data_result["dataModal_3"] = "Token de seguridad inválido, refresque el aplicativo WEB.";
			$data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
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