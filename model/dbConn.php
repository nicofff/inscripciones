<?php

$DB_USER= "inscripciones";
$DB_PASS = "inscripciones";
$DB_NAME =  "inscripciones";
$DB_PRIMARY_SERVER= "db";
$DB_SECONDARY_SERVER= "web";

$MYSQLI = new mysqli($DB_PRIMARY_SERVER,$DB_USER,$DB_PASS,$DB_NAME);
if (!$MYSQLI->connect_errno){
    $MYSQLI = new mysqli($DB_SECONDARY_SERVER,$DB_USER,$DB_PASS,$DB_NAME);    
}
$MYSQLI->set_charset("utf8");
