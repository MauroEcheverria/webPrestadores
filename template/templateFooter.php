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
  <script src="../../../plugins/bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../plugins/moment/moment.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../dist/js/adminlte.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../dist/js/jquery.validate.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script src="../../../dist/js/webInspector.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
  <script> $.widget.bridge('uibutton', $.ui.button) </script>

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