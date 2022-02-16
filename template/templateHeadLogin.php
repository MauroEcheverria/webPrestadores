<?php 
  function template_head($data_template,$css_dreconstec){ 
?>
    <!doctype html>
      <html lang="es">
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Checkout example · Bootstrap v5.1</title>

          <link href="../../../plugins/bootstrap-5.1.3/dist/css/bootstrap.min.css?dct_v_1.1" rel="stylesheet">
          <link href="../../../plugins/fontawesome-free-5.15.4-web/css/all.css?dct_v_1.1" rel="stylesheet">
          <link href="../../../plugins/bootstrap-5.1.3/dist/css/signin.css?dct_v_1.1" rel="stylesheet">
          <link href="../../../dist/css/webSistema.css?dct_v_1.1" rel="stylesheet">

          <?php
            for ($i = 0; $i < count($css_dreconstec); ++$i){
              echo $css_dreconstec[$i];
            }
          ?>

        </head>

        <body class="text-center">
<?php 
  } 
?>