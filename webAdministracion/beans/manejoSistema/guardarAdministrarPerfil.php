<?php
	require_once("../../../controller/misFunciones.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
  require_once("../../../controller/sesion.class.php");
	app_error_reporting($app_error_reporting);
	try {
    $sesion = new sesion();
    $dataSesion = $sesion->get('dataSesion');
		$ConnectionDB = new ConnectionDB();
		$pdo = $ConnectionDB->connect();
		$pdo->beginTransaction();

		$sql="UPDATE dct_salud_tbl_paciente
			SET pct_estado_civil=:pct_estado_civil,pct_instruccion=:pct_instruccion, pct_tipo_sangre=:pct_tipo_sangre, 
				pct_provincia=:pct_provincia, pct_canton=:pct_canton, pct_parroquia=:pct_parroquia, pct_telefono=:pct_telefono,
				pct_direccion=:pct_direccion, pct_referencia=:pct_referencia, usr_usuario_modificacion=:usr_usuario_modificacion, 
				usr_fecha_modificacion=:usr_fecha_modificacion, usr_ip_modificacion=:usr_ip_modificacion, pct_datos_personales='A',
				pct_sexo=:pct_sexo, pct_prefijo=:pct_prefijo
		WHERE pct_cedula = :pct_cedula";
    $query=$pdo->prepare($sql);
    $query->bindValue(':pct_estado_civil', cleanData("siLimite",12,"noMayuscula",$_POST["pct_estado_civil"])); 
    $query->bindValue(':pct_instruccion', cleanData("siLimite",11,"noMayuscula",$_POST["pct_instruccion"])); 
    $query->bindValue(':pct_tipo_sangre', cleanData("siLimite",9,"noMayuscula",$_POST["pct_tipo_sangre"])); 
    $query->bindValue(':pct_telefono', cleanData("siLimite",10,"noMayuscula",$_POST["pct_telefono"])); 
    $query->bindValue(':pct_prefijo', cleanData("siLimite",4,"noMayuscula",$_POST["pct_prefijo"])); 
    $query->bindValue(':pct_provincia', cleanData("siLimite",5,"noMayuscula",$_POST["pct_provincia"])); 
    $query->bindValue(':pct_canton', cleanData("siLimite",7,"noMayuscula",$_POST["pct_canton"])); 
    $query->bindValue(':pct_parroquia', cleanData("siLimite",9,"noMayuscula",$_POST["pct_parroquia"])); 
    $query->bindValue(':pct_direccion', cleanData("siLimite",70,"noMayuscula",$_POST["pct_direccion"])); 
    $query->bindValue(':pct_referencia', cleanData("siLimite",25,"noMayuscula",$_POST["pct_referencia"]));
    $query->bindValue(':usr_usuario_modificacion', cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]));
    $query->bindValue(':usr_fecha_modificacion', $fechaActual_1);
    $query->bindValue(':usr_ip_modificacion', getRealIP());
    $query->bindValue(':pct_sexo', cleanData("siLimite",9,"noMayuscula",$_POST["pct_sexo"]));  
    $query->bindValue(':pct_cedula', cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]));
    $query->execute();
		if($query) {
			$pdo->commit();
			$data_result["message"] = "saveOK";
			$data_result["dataModal_1"] = '<img src="../../../dist/img/visto.png" width="30px" heigth="20px">';
      $data_result["dataModal_2"] = 'Información';
      $data_result["dataModal_3"] = 'Perfil editado de manera correcta.';
      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
			echo json_encode($data_result);
		}
		else {
			$pdo->rollBack();
			$data_result["message"] = "saveError";
			echo json_encode($data_result);
		}

	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}
?>