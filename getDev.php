<?php

$filePath = 'output.txt';

$file = file($filePath);

$arrayFile = array($file);

function getDevice ($device){
  foreach($device as $probe => $probeLine){
    preg_match_all("/\b[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}\b/su", $probeLine , $matches);
    print_r($matches);
  }
}

getDevice($arrayFile);
?>
