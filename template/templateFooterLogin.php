<?php 
  function template_footer($js_dreconstec){ 
?>
    <script src="../../../plugins/jquery/jquery-3.6.0.min.js?dct_v_1.1"></script>
    <script src="../../../plugins/bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js?dct_v_1.1"></script>

    <?php
      foreach ($js_dreconstec as $js_dreconstec) {
        echo $js_dreconstec;
      }
    ?>
        
    </body>

  </html>
<?php 
  } 
?>