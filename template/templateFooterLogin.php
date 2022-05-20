<?php 
  function template_footer($data_template,$js_dreconstec){ 
?>
    <script src="../../../plugins/jquery/jquery-3.6.0.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../plugins/jquery-ui/jquery-ui.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../plugins/bootstrap-5.1.3/dist/js/bootstrap.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../dist/js/adminlte.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../dist/js/webInspector.js<?php echo $data_template["version_css_js"]; ?>"></script>
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