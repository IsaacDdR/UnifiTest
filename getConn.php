<?php

require('mysql.php');

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
$servername = "localhost"; 
$username = "root";
$password = "RootPass";
$db = "MAC";
$conn = mysqli_connect($servername, $username, $password, $db);
  foreach($devicesArray as $item){
    $insertMac = "INSERT INTO DEVICES (mac) VALUES ('".$item."')";
    if(mysqli_query($conn, $insertMac)){
      echo 'se pudo';
    }
    echo '<br>';
    print_r($item);
    echo '<br>';
  }
}


$jsonArray = json_decode(json_encode(uniqueConnected($usersJson)));
?>
