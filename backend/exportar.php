<?php

function encodeCSV(&$value, $key, $file) {
    $value = mb_convert_encoding($value, 'Windows-1252', "UTF-8");
}

$json = file_get_contents("php://input");
$array = json_decode($json, true);

foreach ($array as &$inscripto) {
    unset($inscripto["CategoriaShow"]);
    $inscripto["Institucion"] = $inscripto["Laboratorio"];
    unset($inscripto["Laboratorio"]);
}

$filename = 'downloads/' . uniqid("export") . '.csv';
$f = fopen($filename, 'w');
$firstLineKeys = false;
fputs($f, "sep=,\r\n", 7);
foreach ($array as $line) {
    array_walk($line, 'encodeCSV', $f);
    if (empty($firstLineKeys)) {
        $firstLineKeys = array_keys($line);
        fputcsv($f, $firstLineKeys);
        $firstLineKeys = array_flip($firstLineKeys);
    }
    // Using array_merge is important to maintain the order of keys acording to the first element
    fputcsv($f, array_merge($firstLineKeys, $line));
}

echo json_encode(array("url" => $filename));
