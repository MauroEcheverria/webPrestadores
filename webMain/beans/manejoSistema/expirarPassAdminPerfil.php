<?php
  require_once("../../../controller/sesion.class.php");
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../dctDatabase/Parameter.php");
  app_error_reporting($app_error_reporting);
  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();
    $sesion = new sesion();
    $dataSesion = $sesion->get('dataSesion');

    $validacionUsuario = new ValidacionUsuario();
    $nueva_contrasena = $validacionUsuario->setPassword(cleanData("noLimite",0,"noMayuscula",$_POST["valPaciente"])); 

    $sql_1="SELECT usr_contrasenia 
            FROM dct_sistema_tbl_usuario 
            WHERE usr_cod_usuario = :usr_cod_usuario;";
    $query_1=$pdo->prepare($sql_1);
    $query_1->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
    $query_1->execute();
    $row_1 = $query_1->fetch(\PDO::FETCH_ASSOC);
    if($validacionUsuario->verifyPassword(cleanData("noLimite",0,"noMayuscula",$_POST["valPacienteAnt"]),$row_1["usr_contrasenia"])) { 

      $sql_2="SELECT cts_contrasenia
            FROM dct_sistema_tbl_contrasenia
            WHERE cts_cod_usuario = :cts_cod_usuario;";
      $query_2=$pdo->prepare($sql_2);
      $query_2->bindValue(':cts_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
      $query_2->execute();
      $row_2 = $query_2->fetchAll();
      $return_2 = array();
      $countSi = 0;
      foreach ($row_2 as $row_2) {
        if($validacionUsuario->verifyPassword(cleanData("noLimite",0,"noMayuscula",$_POST["valPaciente"]),$row_2["cts_contrasenia"])) { 
          $countSi += 1;
        }
        if ($countSi == 1) { break; }
      }
      if ($countSi >= 1) {
        $data_result["message"] = "passRegistradaAnteriormentes";
        $data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
        $data_result["dataModal_2"] = 'Información';
        $data_result["dataModal_3"] = 'Se ha detectado que la contraseña ingresada ya ha sido usada anteriormente, favor ingresar una nueva.';
        $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
        echo json_encode($data_result);
      }
      else {
        $sql_3="UPDATE dct_sistema_tbl_usuario 
                SET usr_contrasenia = :usr_contrasenia, 
                usr_estado_contrasenia='AC', 
                usr_expiro_contrasenia='NO', 
                usr_fecha_cambio_contrasenia=:usr_fecha_cambio_contrasenia, 
                usr_contador_error_contrasenia  =0 
                WHERE usr_cod_usuario = :usr_cod_usuario;";
        $query_3=$pdo->prepare($sql_3);
        $query_3->bindValue(':usr_contrasenia',$nueva_contrasena,PDO::PARAM_STR);
        $query_3->bindValue(':usr_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
        $query_3->bindValue(':usr_fecha_cambio_contrasenia',$fechaActual_1,PDO::PARAM_STR);
        $query_3->execute();

        $sql_5="UPDATE dct_sistema_tbl_contrasenia
              SET cts_estado='IN',cts_fecha_cambio=now()
              WHERE cts_cod_usuario =:cts_cod_usuario
              AND cts_estado='AC';";
        $query_5=$pdo->prepare($sql_5);
        $query_5->bindValue(':cts_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT); 
        $query_5->execute();

        $sql_4="INSERT INTO dct_sistema_tbl_contrasenia(cts_contrasenia, cts_cod_usuario, cts_fecha_cambio, cts_estado)
              VALUES (:cts_contrasenia, :cts_cod_usuario, now(), 'AC');";
        $query_4=$pdo->prepare($sql_4);
        $query_4->bindValue(':cts_contrasenia',$nueva_contrasena,PDO::PARAM_STR);
        $query_4->bindValue(':cts_cod_usuario',cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]),PDO::PARAM_INT);
        $query_4->execute();

        if($query_3 && $query_4 && $query_5) {
          $pdo->commit();
          $validacionUsuario->newSesion(cleanData("siLimite",13,"noMayuscula",$dataSesion["cod_system_user"]));
          $data_result["message"] = "updateOk";
          $data_result["dataModal_1"] = '<img src="../../../dist/img/visto.png" width="30px" heigth="20px">';
          $data_result["dataModal_2"] = 'Información';
          $data_result["dataModal_3"] = 'La clave ha sido actualizada correctamente.';
          $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" onClick="location.href = '."'".'../principal'."'".'">Cerrar</button>';
          echo json_encode($data_result);

        }
        else {
          $pdo->rollBack();
          $data_result["message"] = "updateError";
          $data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
          $data_result["dataModal_2"] = 'Información';
          $data_result["dataModal_3"] = 'Se ha detectado un error en la acción requerida, favor escribenos a app-web@dreconstec.com';
          $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
          echo json_encode($data_result);
        }
      }
    }
    else {
      $data_result["message"] = "passOriginalError";
      $data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
      $data_result["dataModal_2"] = 'Información';
      $data_result["dataModal_3"] = 'La actual clave no es la correcta, ingrese la clave nuevamente.';
      $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
      echo json_encode($data_result);
    } 
  } catch (\PDOException $e) {
      echo $e->getMessage();
  }
?>