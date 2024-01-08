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





$nombre = $_POST['POPUPName'];
$mail = $_POST['POPUPMail'];
$phone = $_POST['POPUPTel'];
$text = $_POST['POPUPMsg'];
$categoria = $_POST['POPUPCat'];
$body = <<<HTML
<p>Mensaje enviado desde la web <br> por: $nombre <br> Mail de contacto: $mail <br> Telefono: $phone <br> Categoría solicitad: $categoria <br></p>
<p>--------------------------------------------------------------------------------</p> <br> <br>
<p>$text</p>
HTML;

$mailer->setFrom($mail, "$nombre");
$mailer->addAddress('hola@vargasr.com.ar', 'Formulario Web' );
$mailer->Subject="Nuevo pedido de: $categoria" ;
$mailer->msgHTML($body);
$mailer->send();
echo 'Enviado';



} 

catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
}