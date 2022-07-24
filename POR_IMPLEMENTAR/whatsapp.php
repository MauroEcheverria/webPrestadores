<?php
require_once('../plugins/apiWhatsapp/ultramsg.class.php');

$ultramsg_token="glpr98u1bxxd6job";
$instance_id="instance12736";
$client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);

$to="593962304485"; 
$body="👻 Ejemplo 2 🥶"; 
$api=$client->sendChatMessage($to,$body);
echo $api["message"];