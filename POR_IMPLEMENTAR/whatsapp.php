<?php

$curl = curl_init();

$instancia = "instance3387";
$token = "6tlv7zyeipwi3zqi";
$enviar = 960939030;
$mensaje = "Un ejemplo de envio por Dreconstec";

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.ultramsg.com/".$instancia."/messages/chat",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "token=".$token."&to=+593".$enviar."&body=".$mensaje."&priority=1&referenceId=",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}