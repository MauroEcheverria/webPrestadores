<?php
  require_once("../../../dctDatabase/Connection.php");
  require_once("../../../controller/misFunciones.php");
  require_once("../../../dctDatabase/Parameter.php");
  include("../../../template/templateHeadLogin.php");
  include("../../../template/templateFooterLogin.php");
  include("../../../dialogs/modalViews.php");

  $data_template["error_reporting"] = $app_error_reporting;
  $data_template["version_css_js"] = $version_css_js;
  
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
    $dentroLimite = "NO";
    $tokenUsado = "SI";
    $query_2 = true;

    $sql_1="SELECT TIMESTAMPDIFF(MINUTE,tok_fecha,now()) diff, tok_estado
          FROM dct_sistema_tbl_token
          WHERE tok_token = :tok_token
          AND tok_tipo = 'RESETEO'
          AND tok_estado = 'A';";
    $query_1=$pdo->prepare($sql_1);
    $query_1->bindValue(':tok_token',$_GET["linkReset"]);
    $query_1->execute();
    $row_1 = $query_1->fetch(\PDO::FETCH_ASSOC);

    if($query_1->rowCount() == 1) {
      if ($row_1["diff"] <= 10) {
        if ($row_1["tok_estado"] == 1) {
          $tokenUsado = "NO";
        }
        $dentroLimite = "SI";
      }
      $existeToken = "SI";
    }
    if($query_2) {
      $pdo->commit();
      if ($existeToken == "SI") {
        if ($dentroLimite == "SI") {
          if ($tokenUsado == "NO") {
            ?>
              <div class="container container_main centrarContent">
                <section class="sectionDataTable">
                  <div class="panel panel-primary widthDataTable" style="width: 50%;">
                    <div class="panel-heading tablePanelHeading">
                        <h3 class="labelEvoluciones">Reestablecimiento de Contraseña</h3>
                    </div>
                    <div class="panel-body" align="center">
                      <form id="formTokenReestaPass" class="formModalPages" data-toggle="validator" role="form">
                        <div class="form-group">
                          <label for="passPassNew" class="control-label">Nueva Contraseña:</label>
                          <input type="password" class="form-control" id="passPassNew" name="passPassNew" required maxlength="15" minlength="5">
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                          <label for="passRepPass" class="control-label">Repita Contraseña:</label>
                          <input type="password" class="form-control" id="passRepPass" name="passRepPass" data-match="#passPassNew" data-match-error="Las contraseñas no coinciden." required maxlength="15" minlength="5">
                          <div class="help-block with-errors"></div>
                        </div>

                        <div class="alert alert-danger poppupAlert" role="alert" id="modal_pass_verify">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <div id="">
                            <h4>La contraseña debe cumplir los siguientes requerimientos:</h4>
                            <ul>
                                <li id="reset_letter" class="invalid_pass">Al menos debería tener <strong>una letra</strong></li>
                                <li id="reset_capital" class="invalid_pass">Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                                <li id="reset_number" class="invalid_pass">Al menos debería tener <strong>un número</strong></li>
                                <li id="reset_length" class="invalid_pass">Debe tener <strong>5 carácteres</strong> como mínimo</li>
                            </ul>
                          </div>
                        </div>

                        <input type="hidden" name="pass_token" id="pass_token" value="<?php echo $_GET["linkReset"] ?>">
                        <div class="form-group">
                          <button type="submit" class="btn btn-default btn-estandar-dreconstec"
                          id="btnSubmitReset">Reestablecer</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </section>
              </div>
            <?php
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
                                        <p>El link de reseteo ya ha sido usado. <br>Diríjase a la página principal para iniciar su sesión.</p>
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
                                      <p>El link de reseteo ya ha caducado, por favor generar <br>uno nuevamente en la opción <span style="text-decoration: underline;font-weight: bold;">¿Olvidó su contraseña?</span></p>
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
                                    <p>El link de reseteo no se encuentra registrado. <br>Contáctate con nosotros para indicarnos de esta novedad.</p>
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
      }
      ?>    
        <div class="poppupAlert" id="alertNewClaveParametros">
          <a href="#" class="close aAlert" data-dismiss="alert">&times;</a>
          <strong>La clave debe cumplir todos los parámetros.
        </div>
      <?php 
    }
    else {
      $pdo->rollBack();
    }
      
  } catch (\PDOException $e) {
      echo $e->getMessage();
  }        
  template_footer($data_template, $js_dreconstec); 
?>