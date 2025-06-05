<?php
// career_mail.php
// This script handles the career form submission and sends an email using PHPMailer without Composer.
// Please download PHPMailer from https://github.com/PHPMailer/PHPMailer and place the 'src' folder inside 'mailing/phpmailer' directory.

// Include PHPMailer classes manually
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"] ?? ''));
    $phone = strip_tags(trim($_POST["phone"] ?? ''));
    $email = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $position = strip_tags(trim($_POST["status"] ?? ''));
    $experience = strip_tags(trim($_POST["experience"] ?? ''));
    $details = strip_tags(trim($_POST["details"] ?? ''));

    // Validate required fields
    if (empty($name) || empty($email) || empty($position) || empty($experience) || empty($details)) {
        http_response_code(400);
        echo "Please complete all required fields.";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Invalid email address.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];
        $mail->Host = 'smtp.gmail.com'; // Set your SMTP server here
        $mail->SMTPAuth = true;
        $mail->Username = 'dalmat.repair@gmail.com'; // SMTP username
        $mail->Password = 'nufa twcu ujka cawg'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('dalmat.repair@gmail.com', 'Z Electric Careers');
        // Change recipient to SMTP username email to send email only to one address
        $mail->addAddress('dalmat.repair@gmail.com', 'Z Electric Careers');

        // Attach resume if uploaded
        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] !== UPLOAD_ERR_NO_FILE) {
            if ($_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
                $uploadTmpName = $_FILES['fileToUpload']['tmp_name'];
                $uploadName = $_FILES['fileToUpload']['name'];
                $mail->addAttachment($uploadTmpName, $uploadName);
            } else {
                // Handle file upload error
                http_response_code(400);
                echo "File upload error: " . $_FILES['fileToUpload']['error'];
                exit;
            }
        }

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Career Application from ' . $name;
        $mail->Body = "
            <h2>New Career Application</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Position Applied For:</strong> {$position}</p>
            <p><strong>Years of Experience:</strong> {$experience}</p>
            <p><strong>Other Details:</strong> {$details}</p>
        ";

        $mail->send();
        header("Location: ../careers.html?sent=1");
        exit;
    } catch (Exception $e) {
        http_response_code(500);
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
