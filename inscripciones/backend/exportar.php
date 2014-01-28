<?php
function encodeCSV($value, $key){
    
    $value = strtr($value,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}

function file_get_contents_utf8($fn) {
     $content = file_get_contents($fn);
      return mb_convert_encoding($content, 'UTF-8',
          mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
}

$json = file_get_contents_utf8("php://input");
$array = json_decode($json, true);
$filename ='downloads/'.uniqid("export").'.csv';
$f = fopen($filename, 'w');

$firstLineKeys = false;
fputs($f, "sep=,\r\n", 7);
foreach ($array as $line) {
    array_walk($line, 'encodeCSV');
    if (empty($firstLineKeys)) {
        $firstLineKeys = array_keys($line);
        fputcsv($f, $firstLineKeys);
        $firstLineKeys = array_flip($firstLineKeys);
    }
    // Using array_merge is important to maintain the order of keys acording to the first element
    fputcsv($f, array_merge($firstLineKeys, $line));
}

echo json_encode(array("url"=>$filename));