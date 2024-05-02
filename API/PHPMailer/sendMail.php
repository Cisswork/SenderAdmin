<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);



try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
     $mail->Host       = 'mail.cerbr.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'info@cerbr.com';                   // SMTP username (your Gmail address)
    $mail->Password   = 'M(_WcXYOx@ul';     
    // $mail->Username   = 'barkhapatelciss@gmail.com';                   // SMTP username (your Gmail address)
    // $mail->Password   = 'cpqncknsuhawonjf' ;  //'phjwptaxdnaunqol';               // SMTP password (your Gmail password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('vasubirla@gmail.com', 'Ciss');
    $mail->addAddress('kilvishbirla@gmail.com', 'Kilvish'); // Add a recipient

    // Content
    $mail->isHTML(true);                                      // Set email format to HTML
    $mail->Subject = 'Subject Here';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
