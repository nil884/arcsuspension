<?php
$to = "niksjagtap9@gmail.com";
$subject = "Test Email from PHP (Linux Sendmail)";
$message = "This is a test email sent using sendmail.";
$headers = "From: noreply@arcsuspension.in\r\n";
$headers .= "Reply-To: noreply@arcsuspension.in\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo "✅ Mail sent successfully.";
} else {
    echo "❌ Mail sending failed.";
}
?>
