<?php 
  function template_footer($pdo,$dataSesion,$js_dreconstec){ 
?>

      </div>
    </div>

    <script src="../../../plugins/jquery/jquery-3.6.0.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
    <script src="../../../plugins/bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
    <script src="../../../dist/js/webInspector.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="../../../plugins/bootstrap-5.1.3/dist/js/dashboard.js<?php echo $dataSesion["version_css_js"]; ?>"></script>

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