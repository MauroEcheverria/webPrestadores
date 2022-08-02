<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/vendor/autoload.php';

class sendEmail {
  public function enviarCorreo($tipo, $nombre,$claveAcceso,$email) {

    $mailSMTP = 'tls';
    $mailPort = 587;

    /*$mailSMTP = 'ssl';
    $mailPort = 465;*/

    $hostSince = "mail.dreconstec.com";
    $passSince = "T6YQuertyreu53&%1";
    $mailSince = "app-web@dreconstec.com";

    /*$hostSince = "smtp.office365.com";
    $passSince = "Vinicio1984";
    $mailSince = "app.ceibos@iess.gob.ec";*/

    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = $hostSince;
    $mail->SMTPAuth = true;
    $mail->CharSet = "UTF-8";
    $mail->Username = $mailSince;
    $mail->Password = $passSince;
    $mail->SMTPSecure = $mailSMTP;
    $mail->Port = $mailPort;
    $mail->setFrom($mailSince);

    $bodyContent = "Estimado(a):<br><bold> " . $nombre . "</bold><br> Le informamos que su comprobante electronico ha sido emitido exitosamente y se encuentra adjunto al presente correo.";

    $mail->addAddress($email);
    $mail->Subject = $tipo . ' Facturacion Electronica';
    $body = $bodyContent;

    $mail->addAttachment('../../webPosOperaciones/comprobantesElectronicos/'.$claveAcceso.'.pdf');
    $mail->addAttachment('../../webPosOperaciones/comprobantesElectronicos/'.$claveAcceso.'_aprobada.xml');

    $mail->MsgHTML($body);
    $mail->IsHTML(true);
    if ($mail->send()) {
      return true;
    } else {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
  }
}
