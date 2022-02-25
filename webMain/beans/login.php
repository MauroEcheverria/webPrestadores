<?php

require_once("../../controller/sesion.class.php");
require_once("../../controller/funcionesCore.php");
require_once("../../dctDatabase/Connection.php");
require_once("../../dctDatabase/Parameter.php");
app_error_reporting($app_error_reporting);
try {
    $sesion = new sesion();

    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

    $userSystem = cleanData("siLimite", 13, "noMayuscula", $_POST["inputUser"]);
    $contrasena = cleanData("noLimite", 0, "noMayuscula", $_POST["inputPassword"]);

    $validacionUsuario = new ValidacionUsuario();
    switch ($validacionUsuario->login($userSystem, $contrasena, $pdo)) {
      case 'pasoTodo':

          $sql = "SELECT usr_cod_usuario, usr_estado, usr_logeado, usr_ip_pc_acceso, usr_expiro_contrasenia,usr_id_rol,usr_id_empresa,
                  CONCAT(usr_nombre_1,' ',usr_nombre_2,' ',usr_apellido_1,' ', usr_apellido_2) usr_nom_completos 
                  FROM dct_sistema_tbl_usuario 
                  WHERE usr_cod_usuario = :usr_cod_usuario;";
          $query = $pdo->prepare($sql);
          $query->bindValue(':usr_cod_usuario',$userSystem,PDO::PARAM_INT);
          $query->execute();
          $row = $query->fetch(\PDO::FETCH_ASSOC);

          if ($row["usr_estado"] == 'AC') {
            if ($row["usr_logeado"] == 'NO') {
              $accesoPermitido = "normal";
            } else {
              if ($row["usr_ip_pc_acceso"] == getRealIP() || $row["usr_ip_pc_acceso"] == NULL) {
                $accesoPermitido = "normal";
              } else {
                $accesoPermitido = "normalEnOtraPC";
              }
            }
            if ($row["usr_expiro_contrasenia"] == 'SI') {
              $data_result["message"] = "accesoPermitidoExpirePass";
              $data_result["cod_system_user"] = $row["usr_cod_usuario"];
              $data_result["complete_names"] = $row["usr_nom_completos"];
              echo json_encode($data_result);
            } else {

              $sql_rol = "SELECT rol_estado
                      FROM dct_sistema_tbl_rol
                      WHERE rol_id_rol = :rol_id_rol;";
              $query_rol = $pdo->prepare($sql_rol);
              $query_rol->bindValue(':rol_id_rol',$row["usr_id_rol"],PDO::PARAM_INT);
              $query_rol->execute();
              $row_rol = $query_rol->fetch(\PDO::FETCH_ASSOC);

              $sql_emp = "SELECT emp_estado, emp_vigencia_desde, emp_vigencia_hasta
                      FROM dct_sistema_tbl_empresa
                      WHERE emp_id_empresa = :emp_id_empresa;";
              $query_emp = $pdo->prepare($sql_emp);
              $query_emp->bindValue(':emp_id_empresa',$row["usr_id_empresa"],PDO::PARAM_INT);
              $query_emp->execute();
              $row_emp = $query_emp->fetch(\PDO::FETCH_ASSOC);

              if ($row_rol["rol_estado"] == "AC") {
                if ($row_emp["emp_estado"] == "AC") {
                  if ($row_emp["emp_vigencia_hasta"] >= $fechaActual_4) {
                    if ($accesoPermitido == "normal") {
                      $data_result["message"] = "accesoPermitido";
                      $validacionUsuario->newSesion($userSystem);
                      echo json_encode($data_result);
                    } else {
                      $validacionUsuario->newSesionOtraPC($userSystem);
                      $data_result["message"] = "accesoEnOtraPc";
                      $data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
                      $data_result["dataModal_2"] = 'Información';
                      $data_result["dataModal_3"] = 'Usted ya ha iniciado sesión en otro computador...!!!';
                      $data_result["dataModal_4"] = '<div class="row"><div class="col-md-6"><button type="button" class="btn btn-default btn-estandar-dreconstec btn_session_close" data-dismiss="modal" onClick="location.href = ' . "'" . '../../beans/manejoSistema/activarSesion.php' . "'" . '">Cerrar sesión anterior</button></div><div class="col-md-6"><button type="button" class="btn btn-default btn-estandar-dreconstec btn_session_close" data-dismiss="modal">Ninguna acción</button></div></div>';
                      echo json_encode($data_result);
                    }
                  }
                  else {
                    $data_result["message"] = "licenciaAgotada";
                    $data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
                    $data_result["dataModal_2"] = 'Información';
                    $data_result["dataModal_3"] = 'La licencia del aplicativo ha caducado...!!!';
                    $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
                    echo json_encode($data_result);
                  }
                }
                else {
                  $data_result["message"] = "empresaInactiva";
                  $data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
                  $data_result["dataModal_2"] = 'Información';
                  $data_result["dataModal_3"] = 'El estado la de empresa en el sistema se encuentra inactivo...!!!';
                  $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
                  echo json_encode($data_result);
                }
              }
              else {
                $data_result["message"] = "rolInactivo";
                $data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
                $data_result["dataModal_2"] = 'Información';
                $data_result["dataModal_3"] = 'Su rol asignado se encuentra inactivo...!!!';
                $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
                echo json_encode($data_result);
              }

            }
          } 
          else {
            $data_result["message"] = "usuarioInactivo";
            $data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
            $data_result["dataModal_2"] = 'Información';
            $data_result["dataModal_3"] = 'Su cuenta se encuentra inactiva...!!!';
            $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
            echo json_encode($data_result);
          }

          break;
        case 'statusPassFalse':
          $data_result["message"] = "statusPassFalse";
          $data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
          $data_result["dataModal_2"] = 'Información';
          $data_result["dataModal_3"] = 'Su cuenta ha sido inactivada por ingresos fallidos en su contraseña o por que realizó una solicitud de reestablecimiento de contraseña. Verifique su correo electronico por favor.';
          $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
          echo json_encode($data_result);
          break;
        case 'cedulaNoRegistrada':
          $data_result["message"] = "cedulaNoRegistrada";
          $data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
          $data_result["dataModal_2"] = 'Información';
          $data_result["dataModal_3"] = 'El usuario ingresado no se encuentra registrado en el sistema.';
          $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
          echo json_encode($data_result);
          break;
        default:
          $claveNoIgual = explode("&&&", $validacionUsuario->login($userSystem, $contrasena, $pdo));
          $sql_1 = "UPDATE dct_sistema_tbl_usuario
					  SET usr_contador_error_contrasenia=:usr_contador_error_contrasenia
						WHERE usr_cod_usuario = :usr_cod_usuario";
          $query_1 = $pdo->prepare($sql_1);
          $query_1->bindValue(':usr_cod_usuario',$userSystem,PDO::PARAM_INT);
          $query_1->bindValue(':usr_contador_error_contrasenia',$claveNoIgual[1]+1,PDO::PARAM_INT);
          $query_1->execute();

          if ($claveNoIgual[1] + 1 == 3) {
              $sql_2 = "UPDATE dct_sistema_tbl_usuario
						  SET usr_estado_contrasenia='IN'
							WHERE usr_cod_usuario = :usr_cod_usuario";
              $query_2 = $pdo->prepare($sql_2);
              $query_2->bindValue(':usr_cod_usuario',$userSystem,PDO::PARAM_INT);
              $query_2->execute();
          } else {
              $query_2 = true;
          }

          if ($query_1 && $query_2) {
              $pdo->commit();
              $data_result["message"] = "claveNoIgual";
              $data_result["dataModal_1"] = '<img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">';
              $data_result["dataModal_2"] = 'Información';
              $data_result["dataModal_3"] = "Ingresó una contraseña incorrecta. Intento fallido " . ($claveNoIgual[1] + 1) . " de 3. Al tercer intento fallido se bloqueará el acceso al aplicativo web.";
              $data_result["dataModal_4"] = '<button type="button" class="btn btn-default btn-estandar-dreconstec" data-dismiss="modal">Cerrar</button>';
              echo json_encode($data_result);
          } else {
              $pdo->rollBack();
              $data_result["message"] = "saveError";
              echo json_encode($data_result);
          }

          break;
    }
} catch (\PDOException $e) {
    echo $e->getMessage();
}
?>