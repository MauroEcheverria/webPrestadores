<?php 
  function template_head($data_template,$css_dreconstec){ 
?>
  <!doctype html>
    <html lang="es">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Checkout example · Bootstrap v5.1</title>
     
        <link href="../../../plugins/bootstrap-5.1.3/dist/css/bootstrap.min.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../../../plugins/fontawesome-free-5.15.4-web/css/all.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../../../dist/css/webSistema.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">

        <?php
          for ($i = 0; $i < count($css_dreconstec); ++$i){
            echo $css_dreconstec[$i];
          }
        ?>

      </head>

      <body>

        <header>
          <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
              <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                  <h4 class="text-white">About</h4>
                  <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                  <h4 class="text-white">Contact</h4>
                  <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Follow on Twitter</a></li>
                    <li><a href="#" class="text-white">Like on Facebook</a></li>
                    <li><a href="#" class="text-white">Email me</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
              <a href="login.php" class="navbar-brand d-flex align-items-center">
                <i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;<strong>Inicio de Sesión</strong>
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>
          </div>
        </header>
<?php 
  } 
?>