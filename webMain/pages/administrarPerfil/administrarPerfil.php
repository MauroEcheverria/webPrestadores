<?php 
function administrarPerfil($pdo,$dataSesion){ 
include("../../../template/templateHead.php");
include("../../../template/templateFooter.php");
include("../../../dialogs/modalViews.php"); 
template_head($pdo,$dataSesion); modalViews();?>
<script src="../../../dist/js/webMain.js?v1.1"></script>
<script src="../../../dist/js/jquery.md5.js"></script>
<script src="../../../dist/js/webSaludAdminPacientes.js?v1.1"></script>
<link rel="stylesheet" href="../../../dist/css/validadorContrasena.css" />
<link rel="stylesheet" href="../../../dist/css/webSaludGeneral.css">
<script src="../../../plugins/jquery-redirect/jquery.redirect.js"></script>
<link rel="stylesheet" href="../../../plugins/bootstrap-fileinput/css/fileinput.css">
<script src="../../../plugins/bootstrap-fileinput/js/fileinput.js"></script>
<script src="../../../plugins/bootstrap-fileinput/themes/fa/theme.js" > </script> 
<script src="../../../plugins/bootstrap-fileinput/js/locales/es.js"></script>

<div class="container container_main">

  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="idTogglable_2-tab" data-toggle="tab" href="#idTogglable_2" role="tab" aria-controls="idTogglable_2" aria-selected="false">Datos Personales</a>
    </li>
    
    <?php if ($dataSesion["id_role"] == "3") {?>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="idTogglable_3-tab" data-toggle="tab" href="#idTogglable_3" role="tab" aria-controls="idTogglable_3" aria-selected="true">Antecedentes Familiares</a>
      </li>
    <?php } ?>
    <?php if ($dataSesion["id_role"] == "1" || $dataSesion["id_role"] == "2") {?>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="idTogglable_4-tab" data-toggle="tab" href="#idTogglable_4" role="tab" aria-controls="idTogglable_4" aria-selected="true">Académico Médico</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="idTogglable_5-tab" data-toggle="tab" href="#idTogglable_5" role="tab" aria-controls="idTogglable_5" aria-selected="true">Archivos Médicos</a>
      </li>
    <?php } ?>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="idTogglable_1-tab" data-toggle="tab" href="#idTogglable_1" role="tab" aria-controls="idTogglable_1" aria-selected="true">Actualizar Contraseña</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade" id="idTogglable_1" role="tabpanel" aria-labelledby="idTogglable_1-tab">
      <div class="divPanelTogglable">
        <div class="card">
          <div class="card-header">
            <span class="panel-title"><b>Cambio de Contraseña</b></span>
          </div>
          <div class="card-body">
            <form id="formExpirePass" data-toggle="validator" role="form">
              <div class="form-group">
                <label for="passPassAnt" class="control-label">Contraseña Antigua:</label>
                <input type="password" class="form-control" id="passPassAnt" name="passPassAnt" required maxlength="15">
                <div class="help-block with-errors"></div>
              </div>
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
                      <li id="letter" class="invalid_pass">Al menos debería tener <strong>una letra</strong></li>
                      <li id="capital" class="invalid_pass">Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                      <li id="number" class="invalid_pass">Al menos debería tener <strong>un número</strong></li>
                      <li id="length" class="invalid_pass">Debe tener <strong>5 carácteres</strong> como mínimo</li>
                  </ul>
                </div>
              </div>
              <hr>
              <div class="form-group centrarContent">
                <button type="submit" class="btn btn-default btn-estandar-dreconstec" id="idBtnSaveValidar">Guardar</button>
              </div>
            </form> 
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade show active" id="idTogglable_2" role="tabpanel" aria-labelledby="idTogglable_2-tab">
      <div class="divPanelTogglable">
        <div class="card">
          <div class="card-header">
            <span class="panel-title"><b>Actualizar Perfil</b></span>
          </div>
          <div class="card-body">
            <form id="formAdminPerfil" data-toggle="validator" role="form">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pct_provincia" class="control-label">Provincia</label><br/>
                    <select class="form-control select2" name="pct_provincia" id="pct_provincia" style="width: 100%" required></select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="pct_canton" class="control-label">Cantón</label><br/>
                    <select class="form-control select2" name="pct_canton" id="pct_canton" style="width: 100%" required></select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="pct_parroquia" class="control-label">Parroquia</label><br/>
                    <select class="form-control select2" name="pct_parroquia" id="pct_parroquia" style="width: 100%" required></select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="pct_direccion" class="control-label">Dirección exacta</label>
                    <input class="form-control" type="text" name="pct_direccion" id="pct_direccion" 
                    required maxlength="80" />
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="pct_referencia" class="control-label">Referencia</label>
                    <input class="form-control" type="text" name="pct_referencia" id="pct_referencia" 
                    required maxlength="50" />
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="pct_estado_civil" class="control-label">Estado Civil</label>
                    <select class="form-control" name="pct_estado_civil" id="pct_estado_civil" required>
                      <option value="">Seleccione una opción</option>
                      <option value="CASADO/A">CASADO/A</option>
                      <option value="DIVORCIADO/A">DIVORCIADO/A</option>
                      <option value="SOLTERO/A">SOLTERO/A</option>
                      <option value="VIUDO/A">VIUDO/A</option>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="pct_telefono" class="control-label">Teléfono Convencional / Celular</label>

                    <div class="row">
                      <div class="col-md-6">

                        <select class="form-control select2" name="pct_prefijo" id="pct_prefijo" required style="width: 100%">
                          <option value="1907">1907 - Alaska</option>
                          <option value="355">355 - Albania</option>
                          <option value="49">49 - Alemania</option>
                          <option value="376">376 - Andorra</option>
                          <option value="244">244 - Angola</option>
                          <option value="966">966 - Arabia Saudí</option>
                          <option value="213">213 - Argelia</option>
                          <option value="54">54 - Argentina</option>
                          <option value="374">374 - Armenia</option>
                          <option value="61">61 - Australia</option>
                          <option value="43">43 - Austria</option>
                          <option value="973">973 - Bahreim</option>
                          <option value="880">880 - Bangladesh</option>
                          <option value="32">32 - Bélgica</option>
                          <option value="591">591 - Bolivia</option>
                          <option value="387">387 - Bosnia</option>
                          <option value="55">55 - Brasil</option>
                          <option value="359">359 - Bulgaria</option>
                          <option value="238">238 - Cabo Verde</option>
                          <option value="855">855 - Camboya</option>
                          <option value="237">237 - Camerún</option>
                          <option value="1">1 - Canadá</option>
                          <option value="236">236 - Centroafricana, Rep.</option>
                          <option value="420">420 - Checa, Rep.</option>
                          <option value="56">56 - Chile</option>
                          <option value="86">86 - China</option>
                          <option value="357">357 - Chipre</option>
                          <option value="57">57 - Colombia</option>
                          <option value="242">242 - Congo, Rep. del</option>
                          <option value="243">243 - Congo, Rep. Democ.</option>
                          <option value="850">850 - Corea, Rep. Democ.</option>
                          <option value="82">82 - Corea, Rep.</option>
                          <option value="225">225 - Costa de Marfil</option>
                          <option value="506">506 - Costa Rica</option>
                          <option value="385">385 - Croacia</option>
                          <option value="53">53 - Cuba</option>
                          <option value="45">45 - Dinamarca</option>
                          <option value="1809">1809 - Dominicana, Rep.</option>
                          <option value="593" selected="">593 - Ecuador</option>
                          <option value="20">20 - Egipto</option>
                          <option value="503">503 - El Salvador</option>
                          <option value="971">971 - Emiratos Árabes Unidos</option>
                          <option value="421">421 - Eslovaca, Rep.</option>
                          <option value="386">386 - Eslovenia</option>
                          <option value="34">34 - España</option>
                          <option value="1">1 - Estados Unidos</option>
                          <option value="372">372 - Estonia</option>
                          <option value="251">251 - Etiopía</option>
                          <option value="63">63 - Filipinas</option>
                          <option value="358">358 - Finlandia</option>
                          <option value="33">33 - Francia</option>
                          <option value="9567">9567 - Gibraltar</option>
                          <option value="30">30 - Grecia</option>
                          <option value="299">299 - Groenlandia</option>
                          <option value="502">502 - Guatemala</option>
                          <option value="240">240 - Guinea Ecuatorial</option>
                          <option value="509">509 - Haití</option>
                          <option value="1808">1808 - Hawai</option>
                          <option value="504">504 - Honduras</option>
                          <option value="852">852 - Hong Kong</option>
                          <option value="36">36 - Hungría</option>
                          <option value="91">91 - India</option>
                          <option value="62">62 - Indonesia</option>
                          <option value="98">98 - Irán</option>
                          <option value="964">964 - Irak</option>
                          <option value="353">353 - Irlanda</option>
                          <option value="354">354 - Islandia</option>
                          <option value="972">972 - Israel</option>
                          <option value="39">39 - Italia</option>
                          <option value="1876">1876 - Jamaica</option>
                          <option value="81">81 - Japón</option>
                          <option value="962">962 - Jordania</option>
                          <option value="254">254 - Kenia</option>
                          <option value="965">965 - Kuwait</option>
                          <option value="856">856 - Laos</option>
                          <option value="371">371 - Letonia</option>
                          <option value="961">961 - Líbano</option>
                          <option value="231">231 - Liberia</option>
                          <option value="218">218 - Libia</option>
                          <option value="41">41 - Liechtenstein</option>
                          <option value="370">370 - Lituania</option>
                          <option value="352">352 - Luxemburgo</option>
                        </select>

                      </div>
                      <div class="col-md-6">
                        <input class="form-control" type="text" onkeypress="return soloNumeros(event);" name="pct_telefono" id="pct_telefono" maxlength="10" required=""/>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>

                  </div>
                  <div class="form-group">
                    <label for="pct_instruccion" class="control-label">Instrucción</label>
                    <select class="form-control" name="pct_instruccion" id="pct_instruccion" required>
                      <option value="">Seleccione una opción</option>
                      <option value="BASICA">BASICA</option>
                      <option value="PRIMARIA">PRIMARIA</option>
                      <option value="SECUNDARIA">SECUNDARIA</option>
                      <option value="SUPERIOR">SUPERIOR</option>
                      <option value="NINGUNA">NINGUNA</option>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="pct_tipo_sangre" class="control-label">Tipo de Sangre</label>
                    <select class="form-control" name="pct_tipo_sangre" id="pct_tipo_sangre" required>
                      <option value="">Seleccione una opción</option>
                      <option value="A +">A +</option>
                      <option value="O +">O +</option>
                      <option value="B +">B +</option>
                      <option value="AB +">AB +</option>
                      <option value="A -">A -</option>
                      <option value="O -">O -</option>
                      <option value="B -">B -</option>
                      <option value="AB -">AB -</option>
                      <option value="DESCONOCE">DESCONOCE</option>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="pct_sexo" class="control-label">Sexo</label>
                    <select class="form-control" name="pct_sexo" id="pct_sexo" required>
                      <option value="">Seleccione una opción</option>
                      <option value="MASCULINO">MASCULINO</option>
                      <option value="FEMENINO">FEMENINO</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group centrarContent">
                <button type="submit" class="btn btn-default btn-estandar-dreconstec">Guardar</button>
              </div>
            </form> 
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade show" id="idTogglable_3" role="tabpanel" aria-labelledby="idTogglable_3-tab">
      <div class="divPanelTogglable">
        <div class="card">
          <div class="card-header">
            <span class="panel-title"><b>Datos Familiares</b></span>
          </div>
          <div class="card-body">

            <form id="form_evo_1_1" data-toggle="validator" role="form" autocomplete="false">
              <div class="row">
                <div class="col-md-6">
                  <h3 class="labelEvoluciones">Hábitos</h3>
                  <div class="form-group">
                    <label for="evo_1_tabaco" class="control-label">Tabaco</label>
                    <select class="form-control formSelect2" name="evo_1_tabaco" id="evo_1_tabaco" required="">
                      <option value="">Seleccione una opción</option>
                      <option value="SI CONSUME">SI CONSUME</option>
                      <option value="NO CONSUME">NO CONSUME</option>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="evo_1_drogas" class="control-label">Drogas</label>
                    <select class="form-control formSelect2" name="evo_1_drogas" id="evo_1_drogas" required="">
                      <option value="">Seleccione una opción</option>
                      <option value="SI CONSUME">SI CONSUME</option>
                      <option value="NO CONSUME">NO CONSUME</option>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="evo_1_alcohol" class="control-label">Alcohol</label>
                    <select class="form-control formSelect2" name="evo_1_alcohol" id="evo_1_alcohol" required="">
                      <option value="">Seleccione una opción</option>
                      <option value="SI CONSUME">SI CONSUME</option>
                      <option value="NO CONSUME">NO CONSUME</option>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <h3 class="labelEvoluciones">Antecedentes Familiares</h3>
                  <div class="form-group">
                    <label for="evo_3_padre" class="control-label">Padre</label>
                    <textarea class="form-control" rows="1" cols="4" id="evo_3_padre" name="evo_3_padre" maxlength="100" style="resize: none;"  required=""></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="evo_3_madre" class="control-label">Madre</label>
                    <textarea class="form-control" rows="1" cols="4" id="evo_3_madre" name="evo_3_madre" maxlength="100" style="resize: none;"  required=""></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="evo_3_otras" class="control-label">Otros</label>
                    <textarea class="form-control" rows="1" cols="4" id="evo_3_otras" name="evo_3_otras" maxlength="100" style="resize: none;" ></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h3 class="labelEvoluciones">Antecedentes Patológicos</h3>
                  <div class="pato_ninguno">
                    Si no posee ningún antecedente patológico, escriba la palabra <strong>""Ninguno""</strong>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="evo_2_alergico" class="control-label">Alérgico</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_alergico" name="evo_2_alergico" maxlength="100" style="resize: none;"  required=""></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="evo_2_metabolica" class="control-label">Metabólica</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_metabolica" name="evo_2_metabolica" maxlength="100" style="resize: none;"  required=""></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="evo_2_cardiovascular" class="control-label">Cardiovascular</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_cardiovascular" name="evo_2_cardiovascular" maxlength="100" style="resize: none;"  required=""></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="evo_2_gineobstetrico" class="control-label">Gineobstetrico</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_gineobstetrico" name="evo_2_gineobstetrico" maxlength="100" style="resize: none;"  required=""></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="evo_2_otras" class="control-label">Otras</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_otras" name="evo_2_otras" maxlength="100" style="resize: none;" ></textarea>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="evo_2_broncopulmonar" class="control-label">Broncopulmonar</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_broncopulmonar" name="evo_2_broncopulmonar" maxlength="100" style="resize: none;"  required=""></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="evo_2_genitourinaria" class="control-label">Genitourinaria</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_genitourinaria" name="evo_2_genitourinaria" maxlength="100" style="resize: none;"  required=""></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="evo_2_digestiva" class="control-label">Digestiva</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_digestiva" name="evo_2_digestiva" maxlength="100" style="resize: none;"  required=""></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="evo_2_medicinas" class="control-label">Toma alguna medicina</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_medicinas" name="evo_2_medicinas" maxlength="100" style="resize: none;" required=""></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="evo_2_ostearticulares" class="control-label">Ostearticulares</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_ostearticulares" name="evo_2_ostearticulares" maxlength="100" style="resize: none;"  required=""></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="evo_2_psiquiatria" class="control-label">Psiquiatría</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_psiquiatria" name="evo_2_psiquiatria" maxlength="100" style="resize: none;"  required=""></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="evo_2_quirurgica" class="control-label">Quirúrgica</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_quirurgica" name="evo_2_quirurgica" maxlength="100" style="resize: none;"  required=""></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                      <div class="form-group">
                        <label for="evo_2_operado" class="control-label">Ha sido operado</label>
                        <textarea class="form-control" rows="1" cols="40" id="evo_2_operado" name="evo_2_operado" maxlength="100" style="resize: none;" required=""></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>  
                  <div class="form-group centrarContent">
                    <button type="submit" class="btn btn-default btn-estandar-dreconstec">Guardar</button>
                  </div>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade show" id="idTogglable_4" role="tabpanel" aria-labelledby="idTogglable_4-tab">
      <div class="divPanelTogglable">
        <div class="card">
          <div class="card-header">
            <span class="panel-title"><b>Perfil Académico Médico</b></span>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-12">
                <form id="formCargaArchivoPerfil" data-toggle="validator" role="form" autocomplete="false" enctype="multipart/form-data">
                    
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="usr_cod_usuario_1" class="control-label">Médico</label>
                        <select class="form-control" name="usr_cod_usuario_1" id="usr_cod_usuario_1" required=""></select>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>

                  <div id="perfilAdmin_1" class="dct_main">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="pct_provincia" class="control-label">Descripción</label><br/>
                          <textarea class="form-control" rows="4" cols="40" id="usp_descripcion" name="usp_descripcion" maxlength="3000" style="resize: none;" required=""></textarea>
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="pct_provincia" class="control-label">Formación Académica</label><br/>
                          <textarea class="form-control" rows="4" cols="40" id="usp_formacion" name="usp_formacion" maxlength="3000" style="resize: none;" required=""></textarea>
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="pct_provincia" class="control-label">Dirección Consultorio</label><br/>
                          <textarea class="form-control" rows="4" cols="40" id="usp_dir_consultorio" name="usp_dir_consultorio" maxlength="3000" style="resize: none;"></textarea>
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <strong>Consideraciones: </strong>
                      <ul>
                        <li> Máximo de 1 archivo</li>
                        <li> Solo formatos <code>PNG, JPG, JPEG</code></li>
                        <li> Tamaño máximo por archivo de 3MB</li>
                      </ul>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input id_file_perfi" id="fileUploadPerfil" name="fileUploadPerfil">
                      <label class="custom-file-label form_file_perfil" for="customFileLang">Foto para perfíl de médico</label>
                    </div>
                    <div class="form-group centrarContent">
                      <button type="submit" class="btn btn-default btn-estandar-dreconstec">Guardar</button>
                    </div>
                  </div>
                    
                  <br>

                </form>
              </div>
              <div class="col-md-12 dct_main" id="perfilAdmin_2">
                <table id="dtArchivosPerfil" class="cell-border" cellspacing="0" width="100%"></table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade show" id="idTogglable_5" role="tabpanel" aria-labelledby="idTogglable_5-tab">
      <div class="divPanelTogglable">
        <div class="card">
          <div class="card-header">
            <span class="panel-title"><b>Archivos de Médico</b></span>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-12">
                <form id="formCargaArchivoGeneral" data-toggle="validator" role="form" autocomplete="false" enctype="multipart/form-data">
                  
                  <div class="form-group">
                    <label for="usr_cod_usuario_2" class="control-label">Médico</label>
                    <select class="form-control" name="usr_cod_usuario_2" id="usr_cod_usuario_2" required=""></select>
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <div class="dct_main" id="perfilAdmin_3">
                    <div>
                      <strong>Consideraciones: </strong>
                      <ul>
                        <li> Máximo de 5 archivo</li>
                        <li> solo formatos <code>PDF, JPG, JPEG, PNG</code></li>
                        <li> Tamaño máximo por archivo de 3MB</li>
                      </ul>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input id_file_general" id="fileUploadGeneral" name="fileUploadGeneral" required="">
                      <label class="custom-file-label form_file_general" for="customFileLang">Seleccionar Archivo</label>
                    </div>
                    <div class="form-group centrarContent">
                      <button type="submit" class="btn btn-default btn-estandar-dreconstec">Guardar</button>
                    </div>
                  </div>

                </form>
              </div>

              <div class="col-md-12 dct_main" id="perfilAdmin_4">
                <table id="dtArchivosGeneral" class="cell-border" cellspacing="0" width="100%"></table>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<div class="poppupAlert" id="alertNewClaveParametros">
  <a href="#" class="close aAlert" data-dismiss="alert">&times;</a>
  <strong>La clave debe cumplir todos los parámetros.
</div>
<?php template_footer(); } ?>