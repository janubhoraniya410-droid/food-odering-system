<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';  // Load PHPMailer

function sendWelcomeEmail($toEmail, $toName) {
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hungerhub9@gmail.com';        
        $mail->Password   = 'eurw tbzl ffya mznz';             
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Email content
        $mail->setFrom('hungerhub9@gmail.com', 'Hunger Hub');
        $mail->addAddress($toEmail, $toName);
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to Hunger Hub!';
        $mail->Body    = "<div style='font-family: Arial, sans-serif; color: #333;'>
        <h2>Welcome, $toName!</h2>
        <p>Thank you for registering at <strong>Hunger Hub</strong>.</p>
        <p>We're excited to have you. Start ordering delicious food now!</p>
        <br>
        <p>🍽️ Enjoy your food!,<br>Team Hunger Hub</p>
    </div>";
        $mail->AltBody = "Hello $toName,\nThank you for registering at Hunger Hub.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
?>
