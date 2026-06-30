<?php

// include("../includes/configuration.php");
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

  function sendMail($to, $subject, $body, $fromEmail = "info@arcsuspension.in", $fromName = "arc") {
       

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'arcsuspension.in';  // ✅ Correct hostname
            $mail->SMTPAuth = true;
            $mail->Username = '_mainaccount@arcsuspension.in';
            $mail->Password = 'mTX)Jm4N&Kly';
            $mail->SMTPSecure = 'ssl'; // or 'ssl' depending on port
            $mail->Port = 465;         // use 587 for TLS, 465 for SSL

            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            
            $result = $mail->send();
            echo 'Message has been sent successfully';
        } catch (Exception $e) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

$mail1 = 'niksjagtap9@gmail.com';
$subject_buyer = "test";
$body_buyer = "message here";
$sentmail = sendMail($mail1, $subject_buyer, $body_buyer);
var_dump($sentmail);
