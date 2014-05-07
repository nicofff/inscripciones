<?php

include "../model/Inscripto.php";
$redirectURL = Inscripto::getRedirectURL();

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
echo json_encode(array("success"=> true, "redirect" => "$redirectURL?email=".$inscripto->email));
return;
