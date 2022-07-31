<?php 
  function modalViews(){
?>

  <div class="modal fade" id="myModalInactivity" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row width_100">
            <div class="col-md-1">
              <img src="../../../dist/img/modal_alerta.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-11" style="width: 430px;">
              <h4 class="modal-title">Información</h4>
            </div>
          </div>
        </div>
        <div class="modal-body"><strong>Se ha detectado 2 horas de inactividad, por su seguridad se procederá a cerrar su sesión actual.</strong></div>
        <div class="modal-footer centralFooter">
          <button type="button" class="btn btn-warning btn-dreconstec" data-dismiss="modal" onClick="location.href = '../../../'">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModalErrorGeneral" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row width_100">
            <div class="col-md-1">
              <img src="../../../dist/img/modal_error.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-11">
              <h4 class="modal-title">Información</h4>
            </div>
          </div>
        </div>
        <div class="modal-body">Se ha detectado un error al procesar la solicitud requerida. Código de error: <strong><span id="idCodErrorGeneral"></span></strong>, por favor enviar un correo electrónico a <strong>info@dreconstec.com</strong> indicando la novedad presentada.</div>
        <div class="modal-footer centralFooter">
          <button type="button" class="btn btn-danger btn-dreconstec" onClick="location.reload();">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalGenericoInfo" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row width_100">
            <div class="col-md-1" id="putIconModalgeneric"></div>
            <div class="col-md-11">
              <h4 class="modal-title" id="putTitleModalgeneric"></h4>
            </div>
          </div>
        </div>
        <div class="modal-body"><strong id="putMessaggeModalgeneric"></strong></div>
        <div class="modal-footer centralFooter" id="putButtonModalgeneric"></div>
      </div>
    </div>
  </div>

<?php
  } 
?>