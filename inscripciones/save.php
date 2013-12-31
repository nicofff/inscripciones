<?php
include "Inscripto.php";
$data = $_POST;

$inscripto = new Inscripto($data);
if (!$inscripto->validate()){
    header("Location: nueva.html");
}

if ($inscripto->estaRegistrado()){
    header("Location: UsuarioRegistrado.html");
}

$inscripto->save();
