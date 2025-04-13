<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Adjust path if necessary

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; // Replace with your SMTP host
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@example.com'; // Replace with your email
    $mail->Password = 'your_password'; // Replace with your password
    $mail->SMTPSecure = 'tls'; // or 'ssl' depending on your server
    $mail->Port = 587; // or 465

    // Connect to the SMTP server
    $mail->setFrom('your_email@example.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name'); // Replace with a test recipient

    $mail->Subject = 'SMTP Test';
    $mail->Body = 'This is a test email sent via SMTP.';

    // Send the email
    if ($mail->send()) {
        echo 'Message sent successfully';
    } else {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
