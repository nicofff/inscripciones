<?php

$DB_USER= "root";
$DB_PASS = "";
$DB_NAME =  "inscripciones";
$DB_SERVER= "localhost";

$MYSQLI = new mysqli($DB_SERVER,$DB_USER,$DB_PASS,$DB_NAME);
$MYSQLI->set_charset("utf8");