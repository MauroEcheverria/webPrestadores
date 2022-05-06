<?php 
  function template_footer($data_template,$js_dreconstec){ 
?>

    <script src="../../../plugins/jquery/jquery-3.6.0.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../plugins/jquery-ui/jquery-ui.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../dist/js/adminlte.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../dist/js/jquery.validate.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../plugins/bootstrap-validator/dist/validator.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../dist/js/webInspector.js<?php echo $data_template["version_css_js"]; ?>"></script>

    <!--
    <script src="../../../plugins/moment/moment.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../plugins/select2/dist/js/select2.full.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../plugins/DataTables/media/js/jquery.dataTables.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../../../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.js<?php echo $data_template["version_css_js"]; ?>"></script>
    -->
    
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