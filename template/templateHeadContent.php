<?php 
  function template_head($data_template,$css_dreconstec){ 
?>
  <!doctype html>
    <html lang="es">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prestores IESS</title>
     
        <link href="../plugins/bootstrap-5.1.3/dist/css/bootstrap.min.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../plugins/fontawesome-free-5.15.4-web/css/all.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../plugins/bootstrap-5.1.3/dist/css/carousel.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../plugins/bootstrap-5.1.3/dist/css/features.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../dist/css/webSistema.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">

        <?php
          for ($i = 0; $i < count($css_dreconstec); ++$i){
            echo $css_dreconstec[$i];
          }
        ?>

      </head>

      
<?php 
  } 
?>