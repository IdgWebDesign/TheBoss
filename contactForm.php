<?php

if( $_SERVER ['REQUEST_METHOD'] != 'POST'){
    header("Location: index.html");
}

require 'mailer/PHPMailer.php';
require 'mailer/Exception.php';
require 'mailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mailer= new PHPMailer();

try {
 //Server settings
 $mailer->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
 $mailer->isSMTP();                                            //Send using SMTP
 $mailer->Host       = 'vargasr.com.ar';                     //Set the SMTP server to send through
 $mailer->SMTPAuth   = true;                                   //Enable SMTP authentication
 $mailer->Username   = 'hola@vargasr.com.ar';                     //SMTP username
 $mailer->Password   = 'vargas2022';                               //SMTP password
 $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
 $mailer->Port       = 25;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

$ip = $_SERVER['REMOTE_ADDR'];
$captcha = $_POST ['g-recaptcha-response'];
$secretkey= "6Le0r4ooAAAAAOJMO5kN5trA22TkLJBP6Ylpzjfp";

$returnCaptcha= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=$ip");

$atributos= json_decode($returnCaptcha, TRUE);



$nombre = $_POST['contactName'];
$mail = $_POST['contactEmail'];
$phone = $_POST['contactPhone'];
$text = $_POST['contactMessage'];
$subject = $_POST['contactSubject'];
$body = <<<HTML
<p>Mensaje enviado desde la web <br> por: $nombre <br> Mail de contacto: $mail <br> Telefono: $phone</p>
<p>--------------------------------------------------------------------------------</p> <br> <br>
<p>$text</p>
HTML;

$mailer->setFrom($mail, "$nombre");
$mailer->addAddress('hola@vargasr.com.ar', 'Formulario Web' );
$mailer->Subject=$subject;
$mailer->msgHTML($body);

if($atributos['success']){
    $mailer->send();
    echo 'Enviado';
}

else{
    echo 'Captcha invalido';
}

} 

catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
}