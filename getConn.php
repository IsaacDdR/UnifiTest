<?php

require('vendor/autoload.php');

require('config.php');


$unifidata = new UniFi_API\Client($controlleruser, $controllerpassword,
$controllerurl, $site_id);


$login  = $unifidata->login();

$unifiUsers = $unifidata->list_clients();

$usersJson = json_decode(json_encode($unifiUsers), true);


function uniqueConnected ($listConnected){
  $connectedArray = [];
  foreach($listConnected as $arrayItem){
    foreach($arrayItem as $keyValue => $value){
      if($keyValue == 'oui'){
        $prop = $value;
      }
    }
    foreach($arrayItem as $macArray => $valueArray){
      if($macArray == 'mac'){
        array_push($connectedArray, $prop. ": " .$valueArray);
      }
    }
  }
  return $connectedArray;
}


function returnDevices($devicesArray){
  foreach($devicesArray as $item){
    print_r('<pre>'.$item . '</pre>');
  }
}

$jsonArray = json_decode(json_encode(uniqueConnected($usersJson)));


?>
