<?php

  require_once("../../../controller/misFunciones.php");
  require_once("../../../dctDatabase/Parameter.php");
  require_once("../../../dctDatabase/Connection.php");
  include("../../../template/templateHeadLogin.php");
  include("../../../template/templateFooterLogin.php"); 
  include("../../../template/templateServices.php");
  include("../../../dialogs/modalViews.php");
  $data_template=null;
  template_head($data_template); 
  modalViews();
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
    $query_1->bindValue(':tok_token',$_GET["linkActivarCuenta"],PDO::PARAM_STR);
    $query_1->execute();
    $row_1 = $query_1->fetch(\PDO::FETCH_ASSOC);

    if($query_1->rowCount() == 1) {
      if ($row_1["tok_estado"] == 1) {
        $tokenUsado = "NO";
      }
      $existeToken = "SI";
    }
  
    if ($existeToken == "SI") {
      if ($tokenUsado == "NO") {

          $sql_3="UPDATE dct_sistema_tbl_token 
                  SET tok_estado=0
                  WHERE tok_token = :tok_token
                  AND tok_tipo = 'ACTIVACION';";
          $query_3=$pdo->prepare($sql_3);
          $query_3->bindValue(':tok_token',$_GET["linkActivarCuenta"],PDO::PARAM_STR);
          $query_3->execute();

          $sql_2="UPDATE dct_sistema_tbl_usuario 
                 SET usr_estado=TRUE,
                 usr_usuario_modificacion=:usr_usuario_modificacion,
                 usr_fecha_modificacion=:usr_fecha_modificacion,
                 usr_ip_modificacion=:usr_ip_modificacion
                 WHERE usr_cod_usuario=:usr_cod_usuario";
          $query_2=$pdo->prepare($sql_2);
          $query_2->bindValue(':usr_cod_usuario',$row_1["tok_cedula"],PDO::PARAM_INT);
          $query_2->bindValue(':usr_usuario_modificacion',$row_1["tok_cedula"],PDO::PARAM_INT);
          $query_2->bindValue(':usr_fecha_modificacion',$fechaActual_2,PDO::PARAM_STR);
          $query_2->bindValue(':usr_ip_modificacion',getRealIP(),PDO::PARAM_STR);
          $query_2->execute();

          if ($query_2) {
            $pdo->commit();
            ?>
              <div class="slider_area">
                <div class="slider_active owl-carousel">
                    <div class="single_slider  d-flex align-items-center slider_bg_buscar_por">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="slider_text slider_text_bscar_por">
                                        <p>Su cuenta ha sido activada de manera correcta. <br>Diríjase a la página principal para iniciar su sesión.</p>
                                        <div class="btn_buscar_por">
                                          <button type="button" class="btn btn-success btn-estandar-dreconstec" onclick="window.location.href = '../../pages/login/';">Iniciar Sesión</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <?php
              template_services("../../../buscarPor/","../../../webSalud/pages/agendarCita/")
              ?>
            <?php
          }
          else {
            $pdo->rollBack();
            ?>
              <div class="slider_area">
                <div class="slider_active owl-carousel">
                    <div class="single_slider  d-flex align-items-center slider_bg_buscar_por">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="slider_text slider_text_bscar_por">
                                        <p>Se ha detectado un error al procesar la solicitud requerida. <br>Contáctate con nosotros para indicarnos de esta novedad.</p>
                                        <div class="btn_buscar_por">
                                          <button type="button" class="btn btn-success btn-estandar-dreconstec" onclick="window.location.href = '../../../contactanos/';">Contáctanos</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <?php
              template_services("../../../buscarPor/","../../../webSalud/pages/agendarCita/")
              ?>
            <?php
          } 
      }
      else {
         ?>
          <div class="slider_area">
            <div class="slider_active owl-carousel">
                <div class="single_slider  d-flex align-items-center slider_bg_buscar_por">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="slider_text slider_text_bscar_por">
                                    <p>El link de activación ya ha sido usado, por favor inicie sesión.</p>
                                    <div class="btn_buscar_por">
                                      <button type="button" class="btn btn-success btn-estandar-dreconstec" onclick="window.location.href = '../../pages/login/';">Iniciar Sesión</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <?php
          template_services("../../../buscarPor/","../../../webSalud/pages/agendarCita/")
          ?>
        <?php
      }
    }
    else {
      ?>
        <div class="slider_area">
          <div class="slider_active owl-carousel">
              <div class="single_slider  d-flex align-items-center slider_bg_buscar_por">
                  <div class="container">
                      <div class="row">
                          <div class="col-xl-12">
                              <div class="slider_text slider_text_bscar_por">
                                  <p>El link de activación no se encuentra registrado. <br>Contáctate con nosotros para indicarnos de esta novedad.</p>
                                  <div class="btn_buscar_por">
                                    <button type="button" class="btn btn-success btn-estandar-dreconstec" onclick="window.location.href = '../../../contactanos/';">Contáctanos</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <?php
        template_services("../../../buscarPor/","../../../webSalud/pages/agendarCita/")
        ?>
      <?php
    }
      
  } catch (\PDOException $e) {
      echo $e->getMessage();
  }        
template_footer(); ?>