<?php
include "model/Inscripto.php";
$postdata = file_get_contents("php://input");
$data = json_decode($postdata,true);

$inscripto = new Inscripto($data);
if (!$inscripto->validate()){
    header("Location: nueva.html");
    die();
}

if ($inscripto->estaRegistrado()){
    header("Location: UsuarioRegistrado.php?existente=1&tipoDoc=".$inscripto->tipoDoc."&NumeroDoc=".$inscripto->numeroDoc);
    die();
}

$inscripto->save();
header("Location: UsuarioRegistrado.php?existente=0&tipoDoc=".$inscripto->tipoDoc."&NumeroDoc=".$inscripto->numeroDoc);
die();
