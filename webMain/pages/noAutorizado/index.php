<?php 
function noAutorizado($pdo,$dataSesion){ 
include("../../../template/templateHead.php");
include("../../../template/templateFooter.php");
include("../../../template/templateServices.php");
template_head($pdo,$dataSesion); ?>

  <div class="slider_area">
    <div class="slider_active owl-carousel">
        <div class="single_slider  d-flex align-items-center slider_bg_buscar_por">
            <div class="container">
              <div class="slider_text slider_text_bscar_por">
                  <div class="centrarContent">
                  	<img src="../../../dist/img/exclamation.png" style="width: 100px;">
                  </div>
									<div>No tiene autorización para acceder a esta sección de la web.</div>
                  <div class="btn_buscar_por">
                    <button type="button" class="btn btn-success btn-estandar-dreconstec" onclick="window.location.href = '../../../';">Principal</button>
                  </div>
              </div>
            </div>
        </div>
    </div>
  </div>

  <?php
  template_services("../../../buscarPor/","../../../webSalud/pages/agendarCita/")
  ?>

<?php template_footer(); } ?>