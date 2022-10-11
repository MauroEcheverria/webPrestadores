<?php 
  function template_head($data_template,$css_dreconstec){ 
?>
  <!doctype html>
    <html lang="es">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sistema de Negocios">
        <title>Prestores IESS</title>
        <link href="../plugins/bootstrap-5.1.3/dist/css/bootstrap.min.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../plugins/bootstrap-5.1.3/dist/css/carousel.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../plugins/bootstrap-5.1.3/dist/css/features.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../plugins/fontawesome/css/all.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../dist/css/webSistema.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <?php
          for ($i = 0; $i < count($css_dreconstec); ++$i){
            echo $css_dreconstec[$i];
          }
        ?>
      </head>
      <body>
        <div id="loading"><img src="../dist/img/loading.gif"/></div>
        <header class="p-3 bg-dark text-white">
          <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
              <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
              </a>
              <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../" class="nav-link px-2 text-secondary">Inicio</a></li>
                <li><a href="../productos/" class="nav-link px-2 text-white">Productos</a></li>
                <li><a href="../planes/" class="nav-link px-2 text-white">Planes</a></li>
                <li><a href="../contactanos/" class="nav-link px-2 text-white">Contáctanos</a></li>
              </ul>
              <div class="text-end">
                <button type="button" class="btn btn-outline-light me-2" onclick="location.href='../login.php';">Login</button>
              </div>
            </div>
          </div>
        </header>
<?php 
  } 
?>