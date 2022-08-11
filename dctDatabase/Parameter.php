<?php
	/****************** Fecha	************/
	$hora = new DateTime();
	$hora->setTimezone(new DateTimeZone('America/Bogota'));	
	$fechaActual_1 = $hora->format("Y-m-d H:i:s");
	$fechaActual_2 = $hora->format("Y-m-d_His");
	$fechaActual_3 = $hora->format("Ymd_His");
	$fechaActual_4 = $hora->format("Y-m-d");
	$fechaActual_5 = $hora->format("H:i:s");
	$fechaActual_6 = $hora->format("Ymd");
	$fechaActual_7 = $hora->format("Y");
	$fechaActual_8 = $hora->format("H:i");
	$fechaActual_9 = $hora->format("Y-m-d H:i:s.u");
	/****************** Mail ************/
	$mailSMTP = 'tls';
	$mailPort = 587;
	/*$mailSMTP = 'ssl';
	$mailPort = 465;*/
	$hostSince = "mail.dreconstec.com";
    $passSince = "?}24zK&m;_UU";
    $mailSince = "app.web@dreconstec.com";
	$deCorreo = "app.web@dreconstec.com";
	$nombreSetFrom = "APP Dreconstec";
	/****************** TOKEN ************/
	$token_csrf = bin2hex(openssl_random_pseudo_bytes(32));
	/****************** ERROR REPORTING *************************/
	// 1 - Se ven todo tipo de error y advertencias
	// 0 - No se ven error ni anvertencias
	$app_error_reporting = 1;
	$http = ($app_error_reporting == 0) ? "https://" : "http://";
	/****************** TIMEOUT SESSION *************************/
	// 15 min = 900 seg
	// 20 min = 1200 seg
	// 30 min = 1800 seg
	// 45 min = 2700 seg
	$param_timeout = 2700;
	/****************** VERSIONES CSS Y JS *************************/
	$version_css_js = "?dct_1.1";
	/****************** REESTABLECIMIENTO PASS *************************/
	$reestablecimeinto_pass = 90;
	/****************** URL ACTUAL *************************/
	$url_actual = "$http$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	/****************** WHATSAPP *************************/
	$ultramsg_token="glpr98u1bxxd6job";
	$instance_id="instance12736";
	/****************** URL POS *************************/
	$host="http://localhost/GIT/webPrestadores/";
?>