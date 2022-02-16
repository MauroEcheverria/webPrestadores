<?php 
  function template_footer($data_template,$js_dreconstec){ 
?>
    <script src="../../../plugins/jquery/jquery-3.6.0.min.js?dct_v_1.1"></script>
    <script src="../../../plugins/bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js?dct_v_1.1"></script>

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