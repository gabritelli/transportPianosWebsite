<?php

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
  header('Access-Control-Allow-Headers: token, Content-Type');
  header('Access-Control-Max-Age: 1728000');
  header('Content-Length: 0');
  header('Content-Type: text/plain');
  die();
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Recupera i dati dal form
$name = $_POST['name'];
$email = $_POST['email'];
$ritiro = $_POST['ritiro'];
$consegna = $_POST['consegna'];
$piano = $_POST['piano'];
$piano_type = $_POST['piano_type'];

// Crea un'istanza di PHPMailer
$mail = new PHPMailer(true);
try {
  // Configura le impostazioni del server SMTP
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'degiovannitp@gmail.com';
  $mail->Password = 'pianoforte1';
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;

  // Imposta l'email mittente e destinatario
  $mail->setFrom($email, 'Preventivo da sito web');
  $mail->addAddress('gabritelli@gmail.com', 'Preventivo da sito web');

  // Imposta il soggetto e il contenuto dell'email
  $mail->Subject = 'Richiesta di preventivo da ' . $name;
  $mail->Body = 'Nome: ' . $name . '<br>' .
                'Email: ' . $email . '<br>' .
                'Indirizzo di ritro: ' . $ritiro;

  // Invia l'email
  $mail->send();
  echo 'Email inviata con successo';
} catch (Exception $e) {
  echo 'Errore nell\'invio dell\'email: ' . $mail->ErrorInfo;
}
