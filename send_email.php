<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\Users\Ameer06\OneDrive\Documents\PHPMailer-master\src\Exception.php';
require 'C:\Users\Ameer06\OneDrive\Documents\PHPMailer-master\src\PHPMailer.php';
require 'C:\Users\Ameer06\OneDrive\Documents\PHPMailer-master\src\SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $message = $_POST['message'];

  $mail = new PHPMailer(true);

  try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ezersluhh0523@gmail.com';
    $mail->Password = 'ebwrlxqiultbooqh';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Sender and recipient
    $mail->setFrom($email, $name);
    $mail->addAddress('ezersluhh0523@gmail.com');

    // Email content
    $mail->Subject = 'Contact Form Submission';
    $mail->Body = "Name: $name\nEmail: $email\nContact No: $contact\n\n$message";

    // Send the email
    $mail->send();
    echo '<script>alert("Email sent successfully."); window.location.href = "contact.php";</script>';
  } catch (Exception $e) {
    echo '<script>alert("An error occurred. Please try again later."); window.location.href = "contact.php";</script>';
  }
}
?>
