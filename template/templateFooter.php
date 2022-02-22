<?php 
  function template_footer($pdo,$dataSesion,$js_dreconstec){ 
?>
 
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>

  <script src="../../../plugins/jquery/jquery-3.6.0.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../plugins/jquery-ui/jquery-ui.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  
  <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../../plugins/chart.js/Chart.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../plugins/sparklines/sparkline.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../plugins/jqvmap/jquery.vmap.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../plugins/jqvmap/maps/jquery.vmap.usa.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../plugins/jquery-knob/jquery.knob.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../plugins/moment/moment.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../plugins/daterangepicker/daterangepicker.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../plugins/summernote/summernote-bs4.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../dist/js/adminlte.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../dist/js/demo.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../dist/js/dashboard.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../dist/js/webInspector.js<?php echo $dataSesion["version_css_js"]; ?>"></script>

  <?php
    for ($i = 0; $i < count($js_dreconstec); ++$i){
      echo $js_dreconstec[$i];
    }
  ?>

  </body>

  </html>
<?php 
  } 
?>