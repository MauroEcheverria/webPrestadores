<?php
	/************	Fecha	************/
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
	/************	Mail ************/
	$mailSMTP = 'ssl';
	$mailPort = 465;
	$hostSince = "mail.dreconstec.com";
	$passSince = "T6YQuertyreu53&%1";
	$mailSince = "app-web@dreconstec.com";
	$deCorreo = "app-web@dreconstec.com";
	/****************** ERROR REPORTING *************************/
	// 1 - Se ven todo tipo de error y advertencias
	// 0 - No se ven error ni anvertencias
	$app_error_reporting = 1;
	/****************** TIMEOUT SESSION *************************/
	// 15 min = 900 seg
	// 20 min = 1200 seg
	// 30 min = 1800 seg
	// 45 min = 2700 seg
	$param_timeout = 2700;
	/****************** VERSIONES CSS Y JS *************************/
	$version_css_js = "?dct_1.0";
?>