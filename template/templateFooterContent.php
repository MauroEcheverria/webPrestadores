<?php 
  function template_footer($data_template,$js_dreconstec){ 
?>
    <div class="container">
      <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Regresar</a></li>
        </ul>
        <p class="text-center text-muted">&copy; <script>document.write(new Date().getFullYear());</script> Company, Inc</p>
      </footer>
    </div>
    <script src="../plugins/jquery/jquery-3.6.0.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../plugins/bootstrap-5.1.3/dist/js/bootstrap.bundle.min.js<?php echo $data_template["version_css_js"]; ?>"></script>
    <script src="../dist/js/webInspector.js<?php echo $dataSesion["version_css_js"]; ?>"></script>
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