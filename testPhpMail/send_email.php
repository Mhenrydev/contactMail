<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$message = 'Message envoyé';
//Si $_POST[name] est soumis
if (isset($_GET['name'])) {
    $nom = htmlspecialchars($_POST['name']);
    $email = trim($_POST["email"]);
    $message = htmlspecialchars($_POST['message']);

    //Import class PHPMailer, class Exception, class SMTP
    require 'PHPmailer/src/Exception.php';
    require 'PHPmailer/src/PHPMailer.php';
    require 'PHPmailer/src/SMTP.php';

    //Nouvel objet PHPMailer
    $mail = new PHPMailer;

    //Configuration du SMTP Server
    $mail->isSMTP();                                        // Préciser que c'est du SMTP
    $mail->Host = 'smtp.gmail.com';                         // Spécifier le server SMTP utilisé
    // $mail->SMTPDebug = 2;                                // Log de débug, a décommenter si problème d'envoi
    $mail->SMTPAuth = true;                                 // Activer SMTP authentification
    $mail->Username = 'marchenry0645@gmail.com';            // SMTP username
    $mail->Password = 'hjbpztmkuqvgzbzw';                   // SMTP password(clef application google)
    $mail->SMTPSecure = 'tls';                              // Activer TLS encryptage, `ssl` aussi accepté
    $mail->Port = 587;                                      // TCP port
    var_dump($email);
    //Destinataire
    $mail->setFrom($email, $email);             // From à brancher sur formulaire avec mail du user
    $mail->addReplyTo($email);                  // From à brancher sur formulaire avec mail du user
    $mail->addAddress('marchenry0645@gmail.com', "Marc Gmail");          // Addresse cible pour recevoir les mails
    $mail->AddBCC('');
    //Contenu du mail
    $mail->isHTML(true);
    $mail->addCustomHeader('In-Reply-To', 'test');                                  // Configurer email au format HTML
    $mail->Subject = 'Sujet: Demande de contact';           // Sujet du mail
    $mailContent = "<h2>Demande de contact</h2><br>         
    <p><strong>Nom client:</strong> $nom</p><br>
    <p><strong>Email client:</strong> $email</p><br>
    <p><strong>Message client:</strong> $message</p>";       // Contenu du mail

    //Ajout du contenu
    $mail->Body = $mailContent;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //Si mail est différent de send -> "message + rapport érreur", Sinon -> "message envoyé"
    if (!$mail->send()) {
        echo 'Message non envoyé.';
        echo 'Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message envoyé';
        // header('Location: form_email.html');
    }
}
