<?php
include "model/Inscripto.php";
$data = $_POST;

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
