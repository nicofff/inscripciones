<?php

$DB_USER= "root";
$DB_PASS = "InfraYVirt";
$DB_NAME =  "inscripciones";
$DB_PRIMARY_SERVER= "db";
$DB_SECONDARY_SERVER= "web";

$MYSQLI = new mysqli($DB_PRIMARY_SERVER,$DB_USER,$DB_PASS,$DB_NAME);
if (!$MYSQLI){
    $MYSQLI = new mysqli($DB_SECONDARY_SERVER,$DB_USER,$DB_PASS,$DB_NAME);    
}
$MYSQLI->set_charset("utf8");
