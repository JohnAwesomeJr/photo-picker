<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader
require 'vendor/autoload.php';

$selectedPhotos = $_POST['checkedPhotos'];
$url = $_POST['url'];

// Create an instance of PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '<Gmail Email Address Here>';              // SMTP username
    $mail->Password   = '<Google App Password (no spaces)>';                     // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    // Recipients
    $mail->setFrom('<Gmail Email Address Here>', 'Photo Picker Website');
    $mail->addAddress('<Gmail Email Address Here>', 'Photographer');     // Add a recipient

    // Content
    $mail->isHTML(false);                                       // Set email format to plain text
    $mail->Subject = 'Photos Bought';
    
    // Construct email body with image names
    $mail->Body = "The Order Info.\n\n";
    $mail->Body .= $url . "\n\n";
    $mail->Body .= "Selected photos:\n";
    foreach ($selectedPhotos as $photo) {
        $mail->Body .= "- " . $photo . "\n";
    }

    // Send email
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: start;
            height: 100vh;
            text-align: center;
            padding: 20px;
        }
        .thank-you {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .contact-info {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .contact-info a {
            color: #007bff;
            text-decoration: none;
        }
        .selected-photos {
            margin-top: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(40px, 1fr));
            gap: 10px;
            justify-items: center;
        }
        .selected-photos img {
            width: 100%;
            height: auto;
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div>
    <div class="thank-you">Thank You for Your Order</div>
    <div class="contact-info">
        Annalyn will contact you with the finished photos over email.<br>
        If you have any questions, please reach out to <a href="mailto:<Gmail Email Address Here>">Email Address</a><br>
        or by phone <a href="tel:+1<phoner number here>">Phone Number</a>.
    </div>

    <div class="selected-photos">
        <?php foreach ($selectedPhotos as $photo): ?>
            <img src="photos/<?php echo $photo; ?>" alt="<?php echo $photo; ?>">
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
