<?php 
  function template_footer($data_template,$js_dreconstec){ 
?>
    <div class="container">
      <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item"><a href="" class="nav-link px-2 text-muted">Inicio</a></li>
          <li class="nav-item"><a href="productos/" class="nav-link px-2 text-muted">Productos</a></li>
          <li class="nav-item"><a href="planes/" class="nav-link px-2 text-muted">Planes</a></li>
          <li class="nav-item"><a href="contactanos/" class="nav-link px-2 text-muted">Contáctanos</a></li>
          <li class="nav-item"><a href="login.php" class="nav-link px-2 text-muted">Inicio de Sesión</a></li>
        </ul>
        <p class="text-center text-muted">&copy; <script>document.write(new Date().getFullYear());</script> Company, Inc</p>
      </footer>
    </div>
    <script src="plugins/jquery/jquery-3.6.0.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="plugins/bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="dist/js/webInspector.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#ctn_inicio").addClass("text-white").removeClass("text-secondary");
        $("#ctn_productos").addClass("text-secondary").removeClass("text-white");
        $("#ctn_planes").addClass("text-secondary").removeClass("text-white");
        $("#ctn_contactanos").addClass("text-secondary").removeClass("text-white");
      });
    </script>
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