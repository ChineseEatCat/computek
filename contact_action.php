<?php
include 'header.php';
?>

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
$msg = 'vous devez renseigner tout les champ';
if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['objet']) || empty($_POST['message'])) {
    header('location: contact.php?msg=Vous devez renseigner tout les champs');
}
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
    $mail->setFrom($_POST['email'], $_POST['prenom'] . ' ' . $_POST['nom']);
    $mail->addAddress('contact@computek.fr', 'contact computek');
    $mail->addCustomHeader('BTS SIO', 'CompuTek - Contact');


    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = $_POST['objet'];
    $mail->Body    = 'Vous avez reçus un message: '.$_POST['message'];
    $mail->AltBody = 'Vous avez reçus un message: '.$_POST['message'];

    // Définir l'encodage UTF-8
    $mail->CharSet = 'UTF-8';
    $mail->send();
    echo 'L\'e-mail a été envoyé avec succès';
    header('location :contact.php?msg=Envoyé avec succès');
} catch (Exception $e) {
    echo "L'e-mail n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
}



?>




<?php

include 'footer.php';
?>

