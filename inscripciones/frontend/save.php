<?php

$redirectURL =  "http://$_SERVER[HTTP_HOST]/inscripciones/frontend/UsuarioRegistrado.php";

include "../model/Inscripto.php";
$postdata = file_get_contents("php://input");
$data = json_decode($postdata,true);

$inscripto = new Inscripto($data);
if (!$inscripto->validate()){
    echo json_encode(array("success"=> false));
    return;
}

if ($inscripto->estaRegistrado()){
    echo json_encode(array("success"=> true, "redirect" => "$redirectURL?existente=1&email=".$inscripto->email));
    return;
}


$inscripto->save();

include "../lib/PHPMailer/PHPMailerAutoload.php";

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@nicolasfar.com.ar';                            // SMTP username
$mail->Password = 'tuvieja!';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'info@nicolasfar.com.ar';
$mail->FromName = 'Mailer';
$mail->addAddress($inscripto->email);  // Add a recipient


$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Confirmacion Inscripcion';
$mail->Body    = 'Ud se ha subscripto correctamente <br/> Para imprimir los datos de su subscripcion haga click <a href="'.$redirectURL.'?email='.$inscripto->email.'"> aqui</a>';

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}


echo json_encode(array("success"=> true, "redirect" => "$redirectURL?email=".$inscripto->email));
return;