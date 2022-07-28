<?php
	require_once("../../../controller/funcionesCore.php");
	require_once("../../../dctDatabase/Connection.php");
	require_once("../../../dctDatabase/Parameter.php");
	app_error_reporting($app_error_reporting);
	try {
		$ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

    $validacionUsuario = new ValidacionUsuario();
    $pass_token = cleanData("noLimite",0,"noMayuscula",$_POST["pass_token"]);  

    $sql="SELECT tok_cedula 
    			FROM dct_sistema_tbl_token
          WHERE tok_token = :tok_token
          AND tok_tipo = 'RESETEO'
          AND tok_estado = 1;";
    $query=$pdo->prepare($sql);
    $query->bindValue(':tok_token',$pass_token,PDO::PARAM_STR);
    $query->execute();
    $row = $query->fetch(\PDO::FETCH_ASSOC);
    $query_1=true;
	  $query_2=true;

    $tok_cedula = cleanData("siLimite",13,"noMayuscula",$row["tok_cedula"]);

    $sql_pass="SELECT um.usr_correo, CONCAT(um.usr_nombre_1,' ',um.usr_nombre_2,' ',um.usr_apellido_1,' ', um.usr_apellido_2) usr_nom_completos
          FROM dct_sistema_tbl_usuario um
          WHERE um.usr_cod_usuario = :usr_cod_usuario;";
    $query_pass=$pdo->prepare($sql_pass);
    $query_pass->bindValue(':usr_cod_usuario',$tok_cedula,PDO::PARAM_INT);
    $query_pass->execute();
    $row_pass = $query_pass->fetch(\PDO::FETCH_ASSOC);
    $correoEnviado = "NO";

    if ($query->rowCount() == 1) {
      $sql_2="SELECT cts_contrasenia
            FROM dct_sistema_tbl_contrasenia
            WHERE cts_cod_usuario = :cts_cod_usuario;";
      $query_2=$pdo->prepare($sql_2);
      $query_2->bindValue(':cts_cod_usuario',$tok_cedula,PDO::PARAM_INT);
      $query_2->execute();
      $row_2 = $query_2->fetchAll();
      $return_2 = array();
      $countSi = 0;
      foreach ($row_2 as $row_2) {
        if($validacionUsuario->verifyPassword(cleanData("noLimite",0,"noMayuscula",$_POST["passPassNew"]),$row_2["cts_contrasenia"])) {
          $countSi += 1;
        }
        if ($countSi == 1) { break; }
      }
      if ($countSi >= 1) {
        $pdo->rollBack();
        $data_result["message"] = "passRegistradaAnteriormentes";
        $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
        $data_result["dataModal_2"] = 'Información';
        $data_result["dataModal_3"] = 'Se ha detectado que la contraseña ingresada ya ha sido usada anteriormente, favor ingresar una nueva.';
        $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
        echo json_encode($data_result);
      }
      else {
        $sql_1="UPDATE dct_sistema_tbl_token
                SET tok_estado = 0
                WHERE tok_token = :tok_token
                AND tok_tipo = 'RESETEO'
                AND tok_estado = 1;";
        $query_1=$pdo->prepare($sql_1);
        $query_1->bindValue(':tok_token',$pass_token,PDO::PARAM_STR);
        $query_1->execute();

        $sql_5="UPDATE dct_sistema_tbl_contrasenia
              SET cts_estado=0,cts_fecha_cambio=now()
              WHERE cts_cod_usuario =:cts_cod_usuario
              AND cts_estado=1;";
        $query_5=$pdo->prepare($sql_5);
        $query_5->bindValue(':cts_cod_usuario',$tok_cedula,PDO::PARAM_INT); 
        $query_5->execute();

        $sql_4="INSERT INTO dct_sistema_tbl_contrasenia(cts_contrasenia, cts_cod_usuario, cts_fecha_cambio, cts_estado)
              VALUES (:cts_contrasenia, :cts_cod_usuario, now(), 1);";
        $query_4=$pdo->prepare($sql_4);
        $query_4->bindValue(':cts_contrasenia',$validacionUsuario->setPassword(cleanData("noLimite",0,"noMayuscula",$_POST["passPassNew"])),PDO::PARAM_STR);
        $query_4->bindValue(':cts_cod_usuario',$tok_cedula,PDO::PARAM_INT);
        $query_4->execute();

        $sql_2="UPDATE dct_sistema_tbl_usuario
                SET usr_contrasenia = :usr_contrasenia, usr_estado_contrasenia = 1
                WHERE usr_cod_usuario = :usr_cod_usuario";
        $query_2=$pdo->prepare($sql_2);
        $query_2->bindValue(':usr_contrasenia',$validacionUsuario->setPassword(cleanData("noLimite",0,"noMayuscula",$_POST["passPassNew"])),PDO::PARAM_STR);
        $query_2->bindValue(':usr_cod_usuario',$tok_cedula,PDO::PARAM_INT);
        $query_2->execute();

        $arrayMail["subject"] = "🔓 Confirmación de restablecimiento de contraseña";
        $arrayMail["paraCorreo"] = $row_pass["usr_correo"];
        $arrayMail["nombres"] = $row_pass["usr_nom_completos"];
        $arrayMail["archivoHTML"] = "../../mail/htmlResetPassConfirmacion.php";
        $arrayMail["tipoCorreo"] = "htmlResetPassConfirmacion";
        $phpMail = phpMailer($arrayMail);

        if ($phpMail) {
          $correoEnviado = "SI";
        }

        if($query_1 && $query_2 && $query_4 && $query_5) {
          $pdo->commit();
          $data_result["message"] = "saveOK";
          $data_result["correoEnviado"] = $correoEnviado;
          $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_visto.png" width="30px" heigth="20px">';
          $data_result["dataModal_2"] = 'Información';
          $data_result["dataModal_3"] = 'La clave ha sido actualizada correctamente. <br><strong>Se ha enviado un correo electrónico a su cuenta registrada, favor revisar su bandeja de entrada o spam.</strong>';
          $data_result["dataModal_4"] = '<button type="button" class="btn btn-success btn-dreconstec" onClick="location.href = '."'".'../bienvenido'."'".'">Cerrar</button>';
          echo json_encode($data_result);
        }
        else {
          $pdo->rollBack();
          $data_result["message"] = "saveError";
          $data_result["correoEnviado"] = $correoEnviado;
          echo json_encode($data_result);
        } 
      }   
	  }
    else {
      $pdo->rollBack();
      $data_result["message"] = "tokenNoRegistrado";
      $data_result["correoEnviado"] = $correoEnviado;
      $data_result["dataModal_1"] = '<img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">';
      $data_result["dataModal_2"] = 'Información';
      $data_result["dataModal_3"] = 'Token no registrado en sistema, por favor genere uno nuevamente.';
      $data_result["dataModal_4"] = '<button type="button" class="btn btn-warning btn-dreconstec" data-bs-dismiss="modal">Cerrar</button>';
      echo json_encode($data_result);
    }		
	} catch (\PDOException $e) {
	    echo $e->getMessage();
	}
?>