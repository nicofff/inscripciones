<?php
include "../model/Inscripto.php";
$postdata = file_get_contents("php://input");
$data = json_decode($postdata,true);

$inscripto = new Inscripto($data);
if (!$inscripto->validate()){
    echo json_encode(array("success"=> false));
    return;
}

if ($inscripto->estaRegistrado()){
    echo json_encode(array("success"=> true, "redirect" => "UsuarioRegistrado.php?existente=1&tipoDoc=".$inscripto->tipoDoc."&NumeroDoc=".$inscripto->numeroDoc));
    return;
}

$inscripto->save();
echo json_encode(array("success"=> true, "redirect" => "UsuarioRegistrado.php?existente=0&tipoDoc=".$inscripto->tipoDoc."&NumeroDoc=".$inscripto->numeroDoc));
return;