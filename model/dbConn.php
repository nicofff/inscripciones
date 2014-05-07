<?php

$DB_USER= "inscripciones";
$DB_PASS = "8uExIUbpGd9x";
$DB_NAME =  "inscripciones";
$DB_SERVER= "localhost";

$MYSQLI = new mysqli($DB_SERVER,$DB_USER,$DB_PASS,$DB_NAME);
$MYSQLI->set_charset("utf8");