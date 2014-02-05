<?php
function encodeCSV(&$value, $key,$file){
    //fwrite($file, $value."\t");
    $value = mb_convert_encoding($value, 'Windows-1252',"UTF-8");
    //fwrite($file, $value."\n");
}

function file_get_contents_utf8($fn) {
     $content = file_get_contents($fn);
      return mb_convert_encoding($content, 'ISO-8859-1', 'UTF-8');
}

$json = file_get_contents("php://input");



$array = json_decode($json, true);
$filename ='downloads/'.uniqid("export").'.csv';
//$filename ='downloads/test.html';
$f = fopen($filename, 'w');
//file_put_contents($filename, $json);
//file_put_contents($filename, mb_detect_encoding($json));

$firstLineKeys = false;
fputs($f, "sep=,\r\n", 7);
foreach ($array as $line) {
    array_walk($line, 'encodeCSV',$f);
    if (empty($firstLineKeys)) {
        $firstLineKeys = array_keys($line);
        fputcsv($f, $firstLineKeys);
        $firstLineKeys = array_flip($firstLineKeys);
    }
    // Using array_merge is important to maintain the order of keys acording to the first element
    fputcsv($f, array_merge($firstLineKeys, $line));
}

echo json_encode(array("url"=>$filename));