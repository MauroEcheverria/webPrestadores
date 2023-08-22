<?php

require_once('PHPSendMail/PHPMailerAutoload.php');

try {

    $mailSMTP = 'tls';
    $mailPort = 587;

    /*$mailSMTP = 'ssl';
    $mailPort = 465;*/

    /*$hostSince = "mail.dreconstec.com";
    $passSince = "T6YQuertyreu53&%1";
    $mailSince = "app-web@dreconstec.com";*/

    $hostSince = "smtp.office365.com";
    $passSince = "Vinicio1984";
    $mailSince = "app.ceibos@iess.gob.ec";

    $mail = new PHPMailer;
    $mail->SMTPDebug = 1;
    $mail->isSMTP();
    $mail->Host       = $hostSince;
    $mail->SMTPAuth   = true;
    $mail->Username   = $mailSince;
    $mail->Password   = $passSince;
    $mail->SMTPSecure = $mailSMTP;
    $mail->Port       = $mailPort;
    /*$mail->SMTPOptions = array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
    );*/

    $mail->setFrom($mailSince, 'Mailer');
    $mail->addAddress('kaceto104@gmail.com', 'Joe User');
    //$mail->addAddress('ellen@example.com');
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('kaceto104@gmail.com');
    //$mail->addBCC('bcc@example.com');

    //$mail->addAttachment('/var/tmp/file.tar.gz');
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');

    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}