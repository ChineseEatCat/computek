<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

date_default_timezone_set('Europe/Paris');
$mail = new PHPMailer(true);
$mail->setLanguage('fr', 'PHPMailer/language/');
$mail->Encoding = "base64";

try {
    // Configuration du serveur SMTP
    $mail->isSMTP();
    $mail->Host = 'localhost'; // Remplacez par l'adresse de votre serveur SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'test'; // Remplacez par votre nom d'utilisateur SMTP
    $mail->Password = '$2a$04$qxRo.ftFoNep7ld/5jfKtuBTnGqff/fZVyj53mUC5sVf9dtDLAi/S'; // Remplacez par votre mot de passe SMTP
    $mail->SMTPSecure = '';
    $mail->Port = 1025; // Port du serveur SMTP

    // Destinataires
    $mail->setFrom('expediteur@example.com', 'Expéditeur');
    $mail->addAddress('destinataire@example.com', 'Destinataire');
    $mail->addReplyTo('admin@ozier.local', 'Admin');
    $mail->addCustomHeader('BTS SIO', 'CompuTek - Contact');

    // Pièces jointes
    $filePath = 'index.php';
    if (file_exists($filePath)) {
        $mail->addAttachment($filePath);
        echo "Le fichier a été ajouté en pièce jointe.\n";
    } else {
        echo "Le fichier $filePath n'existe pas.";
    }

    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Sujet de l\'e-mail';
    $mail->Body    = 'Ceci est le <b>contenu</b> de l\'e-mail.';
    $mail->AltBody = 'Ceci est le contenu de l\'e-mail en texte brut pour les clients de messagerie qui ne supportent pas le HTML.';

    // Définir l'encodage UTF-8
    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo 'L\'e-mail a été envoyé avec succès';
} catch (Exception $e) {
    echo "L'e-mail n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
}
