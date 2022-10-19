<?php

function transacciones($pdo, $dataSesion) {
    include("../../../template/templateHead.php");
    include("../../../template/templateFooter.php");
    include("../../../dialogs/modalViews.php");

    $css_dreconstec = array();
    $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/DataTables/media/css/jquery.dataTables.min.css' . $dataSesion["version_css_js"] . '" rel="stylesheet">';
    $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css' . $dataSesion["version_css_js"] . '" rel="stylesheet">';
    $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css' . $dataSesion["version_css_js"] . '">';
    $css_dreconstec[] = '<link rel="stylesheet" href="../../../plugins/toastr-master/build/toastr.min.css'.$dataSesion["version_css_js"].'">';

    $js_dreconstec = array();
    $js_dreconstec[] = '<script src="../../../plugins/DataTables/media/js/jquery.dataTables.min.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../plugins/bootstrap-validator/dist/validator.min.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../dist/js/webPOSAdministracion.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../dist/js/webPOSProductos.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../dist/js/webPOSVinculacion.js' . $dataSesion["version_css_js"] . '"></script>';
    $js_dreconstec[] = '<script src="../../../plugins/toastr-master/build/toastr.min.js'.$dataSesion["version_css_js"].'"></script>';

    template_head($pdo, $dataSesion, $css_dreconstec);
    if (!empty($_POST["ftr_tipo_accion"])) {
    ?>
    <div class="content-wrapper">
      <section class="content">
        <div class="container container_main">
          <div class="card">
            <div class="card-header">
              <span class="panel-title">
                <b>
                  <?php
                    switch ($_POST["ftr_tipo_accion"]) {
                      case 'generarNotaCredito':
                        echo "Generar Nota de Crédito";
                        break;
                      case 'generarNotaDebito':
                        echo "Generar Nota de Débito";
                        break;
                      case 'generarComprobanteRetencion':
                        echo "Generar Comprobante de Retención";
                        break;
                      case 'generarGuiRemision':
                        echo "Generar Guía de Remisión";
                        break;
                      default:
                        ?>
                          <script type="text/javascript">
                            window.location.href = "../reporteTransacciones/"
                          </script>
                        <?php
                        break;
                    }
                  ?>
                </b>
              </span>
            </div>
            <div class="card-body">
              <?php
                switch ($_POST["ftr_tipo_accion"]) {
                  case 'generarNotaCredito':
                    echo "Generar Nota de Crédito";
                    break;
                  case 'generarNotaDebito':
                    echo "Generar Nota de Débito";
                    break;
                  case 'generarComprobanteRetencion':
                    echo "Generar Comprobante de Retención";
                    break;
                  case 'generarGuiRemision':
                    echo "Generar Guía de Remisión";
                    break;
                }
              ?>
            </div>
          </div>
        </div>
      </section>
    </div>
    <?php
    }
    else {
      ?>
        <script type="text/javascript">
          window.location.href = "../reporteTransacciones/"
        </script>
      <?php
    }
    modalViews();
    template_footer($pdo, $dataSesion, $js_dreconstec);
}
?>