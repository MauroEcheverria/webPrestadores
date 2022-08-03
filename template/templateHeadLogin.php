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
        <link href="../../../plugins/fonts/source_sans_pro.min.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../../../plugins/fontawesome/css/all.min.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../../../dist/css/adminlte.min.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <link href="../../../dist/css/webSistema.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
        <?php
          for ($i = 0; $i < count($css_dreconstec); ++$i){
            echo $css_dreconstec[$i];
          }
        ?>
      </head>
      <body class="hold-transition login-page">
      <div id="loading"><img src="../../../dist/img/loading.gif"/></div>
<?php 
  } 
?>