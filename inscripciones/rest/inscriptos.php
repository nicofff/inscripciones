<?php

function handleGet() {
    if (isset($_GET["id"])) {
        echo Inscripto::get($_GET["id"]);
    } else {
        echo Inscripto::getAll();
    }
}

function handleDelete() {
    $status = Inscripto::delete($_REQUEST["id"]);
    $data = array("status" => $status);
    echo json_encode($data);
}

function handlePost() {
    $data = $_POST;
    if (isset($data["ID"])){
        handleUpdate();
    }

    $inscripto = new Inscripto($data);
    if (!$inscripto->validate()) {
        header("Location: nueva.html");
        die();
    }

    if ($inscripto->estaRegistrado()) {
        header("Location: UsuarioRegistrado.php?existente=1&tipoDoc=" . $inscripto->tipoDoc . "&NumeroDoc=" . $inscripto->numeroDoc);
        die();
    }

    $inscripto->save();
    header("Location: UsuarioRegistrado.php?existente=0&tipoDoc=" . $inscripto->tipoDoc . "&NumeroDoc=" . $inscripto->numeroDoc);
    die();
}

function handleUpdate(){
    $data = $_POST;

    $inscripto = new Inscripto($data);
    if (!$inscripto->validate()) {
        header("Location: admin.html");
        die();
    }
    $inscripto->update($data["ID"]);
    header("Location: ../admin.php");
    die();

}
include "../model/Inscripto.php";

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        handleGet();
        break;
    case "DELETE":
        handleDelete();
        break;
    case "POST":
        handlePost();
        break;
}
