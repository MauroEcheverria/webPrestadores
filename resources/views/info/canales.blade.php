<!DOCTYPE html>
  <html lang="en">
  <head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>DreConsTec - Soluciones Informáticas</title>
    <!-- site icons -->
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    <!-- bootstrap css -->
    <link href="{{ asset('vendor/bootstrap-5.1.3/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- DreConsTec -->
    <link href="{{ asset('vendor/dct_sistema/dist/css/dct_canales.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-147975416-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-147975416-1');
    </script>

    <style type="text/css" media="screen">
      .btn-transparent {
        background-color: #ffffff00;
        border: 1px solid #ccc;
        color: #ccc;
        border-radius: 22px;
        margin-top: 30px;
        width: 140px;
      }
      .imgLogoCanales {
        width: 220px;
        margin: 0 0 10px -2px;
      }
      .centrarContenCanales {
        position: absolute;
        left: 50%;
        top: 46%;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        text-align: center;
      }
      .logoBotones {
        margin-top: 15px;
      }
    </style>
  </head>
<body>
  <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
  <div id='stars'></div>
  <div id='stars2'></div>
  <div id='stars3'></div>
  <div class="centrarContenCanales">
    <div class="divLogo">
      <img src="{{ asset('vendor/dct_sistema/dist/img/logos/dreconstec_gris.png') }}" class="imgLogoCanales">
      <span class="spanLogo">Soluciones Informáticas</span>
    </div>
    <div class="row logoBotones">
      <div class="col-md-12">
        <button type="button" class="btn btn-default btn-transparent" id="btnCanalWeb">Página Web</button>
      </div>
      <div class="col-md-12">
        <button type="button" class="btn btn-default btn-transparent" id="btnCanalWhatsapp">WhatsApp</button>
      </div>
      <div class="col-md-12">
        <button type="button" class="btn btn-default btn-transparent" id="btnCanalInstagram">Instagram</button>
      </div>
      <div class="col-md-12">
        <button type="button" class="btn btn-default btn-transparent" id="btnCanalFacebook">Facebook</button>
      </div>
      <div class="col-md-12">
        <button type="button" class="btn btn-default btn-transparent" id="btnCanalLinkedin">Linkedin</button>
      </div>
      <div class="col-md-12">
        <button type="button" class="btn btn-default btn-transparent" id="btnCanalContactenos">Contáctenos</button>
      </div>
    </div>   
  </div>
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/dct_sistema/dist/js/dct_canales.js') }}"></script>
</body>
</html>