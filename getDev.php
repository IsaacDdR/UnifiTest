<?php
require('mysql.php');

$filePath = 'output.txt';

$file = file($filePath);

$arrayFile = array($file);

function getDevice ($device){
  $totalMatches = [];
  $arrayUnique = [];
  foreach($device as $probe => $probeLine){
    foreach($probeLine as $line => $sentence){
      preg_match_all("/\b[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}\b/su", $sentence, $matches);
      foreach($matches as $item){
        foreach($item as $prop ){
          array_push($totalMatches,  $prop);
          $arrayUnique = array_unique($totalMatches);
        }
      }
    }
    return $arrayUnique;
  }
}

$macUniques = getDevice($arrayFile);

$macJson = json_decode(json_encode($macUniques), true);

function getMac($arrayMac){
  foreach($arrayMac as $newMac){
    print_r('<pre>' . $newMac . '</pre>');
  }
}


?>
