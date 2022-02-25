<?php 
  function modalViews(){
?>

  <div class="modal fade" id="myModalInactivity" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-1">
              <img src="../../../dist/img/dct_alert.png" width="30px" heigth="20px">
            </div>
            <div class="col-md-11" style="width: 430px;">
              <h4 class="modal-title" id="myModalLabel">Información</h4>
            </div>
          </div>
        </div>
        <div class="modal-body"><strong>Se ha detectado 2 horas de inactividad, por su seguridad se procederá a cerrar su sesión actual.</strong></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal" onClick="location.href = '../../../'">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModalErrorGeneral" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-3"><img src="../../../dist/img/error.png" width="30px" heigth="20px"></div>
            <div class="col-md-9">
              <h4 class="modal-title">Información</h4>
            </div>
          </div>
        </div>
        <div class="modal-body">Se ha detectado un error al procesar la solicitud requerida. Código de error: <strong><span id="idCodErrorGeneral"></span></strong>, por favor enviar un correo electrónico a <strong>app-web@dreconstec.com</strong> indicando la novedad presentada.</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-estandar-dreconstec" onClick="location.reload();">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalGenericoInfo" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class="col-md-3" id="putIconModalgeneric"></div>
            <div class="col-md-9">
              <h4 class="modal-title" id="putTitleModalgeneric"></h4>
            </div>
          </div>
        </div>
        <div class="modal-body"><strong id="putMessaggeModalgeneric"></strong></div>
        <div class="modal-footer" id="putButtonModalgeneric"></div>
      </div>
    </div>
  </div>

<?php
  } 
?>