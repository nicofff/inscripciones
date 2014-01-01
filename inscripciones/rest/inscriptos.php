<?php

function handleGet(){
    echo Inscripto::getAll();
}

function handleDelete(){
    $status=Inscripto::delete($_REQUEST["id"]);
    $data=array("status"=>$status);
    echo json_encode($data);
}

include "../model/Inscripto.php";

switch ($_SERVER["REQUEST_METHOD"]){
    case "GET":
        handleGet();
        break;
    case "DELETE":
        handleDelete();
        break;
}
