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
    $postdata = file_get_contents("php://input");
    $data = json_decode($postdata,true);
    if (isset($data["ID"])){
        handleUpdate();
    }
}

function handleUpdate(){
    $postdata = file_get_contents("php://input");
    $data = json_decode($postdata,true);

    $inscripto = new Inscripto($data);
    if (!$inscripto->validate()) {
        echo json_encode(array("success"=> false, "valid" => false));
        return;
    }
    $inscripto->update($data["ID"]);
    echo json_encode(array("success"=> true ));
    die();

}
session_start();

if (!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) {
    header("location: login.html");
    exit();
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
