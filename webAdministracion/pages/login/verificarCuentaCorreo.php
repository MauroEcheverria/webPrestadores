<?php
  require_once("../../../controller/sesion.class.php");
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../controller/funcionesCore.php");
  require_once("../../../dctDatabase/Parameter.php");
  include("../../../template/templateHeadLogin.php");
  include("../../../template/templateFooterLogin.php");
  include("../../../dialogs/modalViews.php");

  $data_template["error_reporting"] = $app_error_reporting;
  $data_template["version_css_js"] = $version_css_js;
  $sesion = new sesion();
  $_SESSION["token_csrf"] = $token_csrf;
  
  $css_dreconstec = array();
  //$css_dreconstec[] = '<link href="../../../dist/css/dreconstec.css'.$data_template["version_css_js"].'" rel="stylesheet">';

  $js_dreconstec = array();
  $js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.js'.$data_template["version_css_js"].'"></script>';
  $js_dreconstec[] = '<script src="../../../dist/js/loginWEB.js'.$data_template["version_css_js"].'"></script>';

  template_head($data_template, $css_dreconstec);
  app_error_reporting($app_error_reporting);

  try {
    $ConnectionDB = new ConnectionDB();
    $pdo = $ConnectionDB->connect();
    $pdo->beginTransaction();

    $existeToken = "NO";
    $tokenUsado = "SI";

    $sql_1="SELECT tok_cedula, tok_estado
          FROM dct_sistema_tbl_token
          WHERE tok_token = :tok_token
          AND tok_tipo = 'ACTIVACION';";
    $query_1=$pdo->prepare($sql_1);
    $query_1->bindValue(':tok_token',$_GET["linkToken"],PDO::PARAM_STR);
    $query_1->execute();
    $row_1 = $query_1->fetch(\PDO::FETCH_ASSOC);

    if($query_1->rowCount() == 1) {
      if ($row_1["tok_estado"] == 1) {
        $tokenUsado = "NO";
      }
      $existeToken = "SI";
    }
    ?>
    <div class="container container_main centrarContent">
    <section class="sectionDataTable">
      <div class="panel panel-primary widthDataTable" style="width: 50%;">
        <div class="panel-heading tablePanelHeading">
          <h3 class="labelEvoluciones">Verificación de Cuenta de Correo</h3>
        </div>
        <div class="panel-body" align="center">
          <?php
          if ($existeToken == "SI") {
            if ($tokenUsado == "NO") {

                $sql_3="UPDATE dct_sistema_tbl_token 
                        SET tok_estado=0
                        WHERE tok_token = :tok_token
                        AND tok_tipo = 'ACTIVACION';";
                $query_3=$pdo->prepare($sql_3);
                $query_3->bindValue(':tok_token',$_GET["linkToken"],PDO::PARAM_STR);
                $query_3->execute();

                $sql_2="UPDATE dct_sistema_tbl_usuario 
                       SET usr_estado_correo=TRUE,
                       usr_usuario_modificacion=:usr_usuario_modificacion,
                       usr_fecha_modificacion=now(),
                       usr_ip_modificacion=:usr_ip_modificacion
                       WHERE usr_cod_usuario=:usr_cod_usuario";
                $query_2=$pdo->prepare($sql_2);
                $query_2->bindValue(':usr_cod_usuario',$row_1["tok_cedula"],PDO::PARAM_INT);
                $query_2->bindValue(':usr_usuario_modificacion',$row_1["tok_cedula"],PDO::PARAM_INT);
                $query_2->bindValue(':usr_ip_modificacion',getRealIP(),PDO::PARAM_STR);
                $query_2->execute();

                if ($query_2) {
                  $pdo->commit();
                  ?>
                    <p>Su cuenta cuenta de correo electrónico ha sido verificada de manera correcta. <br>Diríjase a la página principal para iniciar su sesión.</p>
                    <div class="btn_buscar_por">
                      <button type="button" class="btn btn-success btn-dreconstec" onclick="window.location.href = '../../pages/login/';">Iniciar Sesión</button>
                    </div>
                  <?php
                }
                else {
                  $pdo->rollBack();
                  ?>
                    <p>Se ha detectado un error al procesar la solicitud requerida. <br>Contáctate con nosotros para indicarnos de esta novedad.</p>
                    <div class="btn_buscar_por">
                      <button type="button" class="btn btn-success btn-estandar-dreconstec" onclick="window.location.href = '../../../contactanos/';">Contáctanos</button>
                    </div>
                  <?php
                } 
            }
            else {
               ?>
                <p>El link de activación ya ha sido usado, por favor inicie sesión.</p>
                <div class="btn_buscar_por">
                  <button type="button" class="btn btn-success btn-dreconstec" onclick="window.location.href = '../../pages/login/';">Iniciar Sesión</button>
                </div>
              <?php
            }
          }
          else {
            ?>
              <p>El link de activación no se encuentra registrado. <br>Contáctate con nosotros para indicarnos de esta novedad.</p>
              <div class="btn_buscar_por">
                <button type="button" class="btn btn-success btn-estandar-dreconstec" onclick="window.location.href = '../../../contactanos/';">Contáctanos</button>
              </div>
            <?php
          }
          ?>
          </div>
        </div>
      </section>
    </div>
    <?php
      
 } catch (Exception $ex) {
    $data_result["message"] = "salidaExcepcionCatch";
    $data_result["codError"] = $ex->getCode();
    $data_result["msjError"] = $ex->getMessage();
    $data_result["numLineaCodigo"] = __LINE__;
    echo json_encode($data_result);
  }
  modalViews();        
  template_footer($data_template, $js_dreconstec); 
?>