<?php 

require "phpmailer\PHPMailerAutoload.php";
require "phpmailer\class.phpmailer.php";
require "phpmailer\class.smtp.php";
require "phpmailer\confidentiel.php";
require "vendor\autoload.php";

    
 $mail = new PHPMailer;
 $e_mail=$_POST['mail'];
 $e_mail=base64_encode(urlencode($_POST['mail']));

 date_default_timezone_set("Europe/Paris");
$time_expired =date(("Y-m-d H:i:s"), time() + 30*30);
$time_expired =base64_encode(urlencode($time_expired));

//$date= date("Y-m-d H:i:s");


$mail ->isSMTP ();                                      
$mail->SMTPDebug = SMTP:: DEBUG_OFF;//il faut changer ça pour voir ou et l'erreur 


$mail ->Host  =  'smtp.gmail.com' ;  // Spécifiez les serveurs SMTP principaux et de sauvegarde 
$mail ->SMTPAuth  =  true ;                               // Activer l'authentification SMTP 
$mail ->Username  =EMAIL ;                 // Nom d'utilisateur SMTP 
$mail ->Password  =  PASS;                           // Mot 
 
 $mail->SMTPSecure = 'tls';                            // Activer le cryptage TLS, `ssl` a également accepté 
 $mail->Port  = 587 ;                                    // Port TCP auquel se connecter
 
$mail->setFrom (EMAIL); 
$mail->addAddress ( $_POST['mail']);     // Ajouter un destinataire 
 



 $mail->isHTML ( true );                                  // Définir le format de l'e-mail sur HTML

$mail->Subject  =  " Confirm your email adress " ; 
$mail->Body     =  " <h1 style='color:#9A452D; margin-left:220px;  font-family:Segoe Script; '>THank you for sing in and Welcome </h1>
 <p style='font-family:Segoe Script; margin-left:320px; font-weight:bold; font-size: 21px; '> Click here to verify your Email </p> 
<p style='margin-left:350px;  font-family:Segoe Script; font-weight:bold; font-size: 16px;  '> This link is available for 30 min </p><br>
<a href='http://localhost/Project/Validation_Email.php?eid={$e_mail} && exd={$time_expired} ' style='color:#9A452D;  margin-left:430px; font-size: 15px; font-weight:bold;  padding: 10px 20px; font-family:Segoe Script; text-decoration:none; border:1px solid #D57C63; background-color:#D57C63; border-radius: 25px;'> Verify </a> <p style='padding:20px'></p>";
  $mail->AltBody  =  " Ceci est le corps en texte brut pour les clients de messagerie non HTML " ;

if (!$mail ->send()) { 
echo "Le message n'a pas pu être envoyé. " ; echo " Mailer Error: "  .$mail->ErrorInfo ; } 


else { 
    require "Senregistrer.php";
      }     






 ?>
