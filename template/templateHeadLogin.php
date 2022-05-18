<?php 
  function template_head($data_template,$css_dreconstec){ 

    $var = "?dct_111";
?>
    <!doctype html>
      <html lang="es">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Prestores IESS</title>

          <link href="../../../plugins/fonts/source_sans_pro.min.css<?php echo $dataSesion["version_css_js"]; ?>" rel="stylesheet">
          <link href="../../../plugins/fontawesome/css/all.min.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
          <link href="../../../dist/css/adminlte.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
          <link href="../../../dist/css/webSistema.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">

          <!-- 
          <link href="../../../plugins/select2/dist/css/select2.min.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
          <link href="../../../plugins/DataTables/media/css/jquery.dataTables.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
          <link href="../../../plugins/DataTables/extensions/Responsive/css/responsive.dataTables.css<?php echo $data_template["version_css_js"]; ?>" rel="stylesheet">
          -->

          <?php
            for ($i = 0; $i < count($css_dreconstec); ++$i){
              echo $css_dreconstec[$i];
            }
          ?>

        </head>

        <body class="hold-transition login-page">

        <div id="loading">
          <img src="../../../dist/img/loading.gif" style="margin-top: 15%;"/>
        </div>
<?php 
  } 
?>