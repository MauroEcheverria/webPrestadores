<?php

$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];

$fechaInicio = substr($fechaInicio,4, 11);
$fechaInicio = date('Y-m-d',strtotime($fechaInicio));

$fechaFin = substr($fechaFin,4, 11);
$fechaFin= date('Y-m-d',strtotime($fechaFin));

$fechaActual=date('Y-m-d');

if($fechaActual <= $fechaFin){
  $data_result["message"] = "certificadoVigente";
  echo json_encode($data_result);
}else{
  $data_result["message"] = "certificadoExtemporaneo";
  echo json_encode($data_result);
}