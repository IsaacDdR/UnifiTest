<?php
require('vendor/autoload.php');

require('config.php');

require('mysql.php');

$filePath = 'output.txt';

ftruncate($filePath);




$unifidata = new UniFi_API\Client($controlleruser, $controllerpassword,
$controllerurl, $site_id);

$login  = $unifidata->login();

unset($usersJson);

$unifiUsers = $unifidata->list_clients();

$usersJson = json_decode(json_encode($unifiUsers), true);



function uniqueConnected ($listConnected){
  $connectedArray = [];
  foreach($listConnected as $arrayItem){
    foreach($arrayItem as $keyValue => $value){
      if($keyValue == "oui"){
        array_push($connectedArray, $value);
      }
    }
  }
  return $connectedArray;
}

$uniArray = uniqueConnected($usersJson);

function uniqueArray ($device){
  $jsonDevice = json_decode(json_encode($device), true);
  foreach($jsonDevice as $newDevice){
    return $newDevice;
  }
}
print_r(uniqueArray($uniArray));







?>

<!DOCTYPE html>

<html>
  <head>
    <link rel='icon' href='favicon.png' type='image/x-icon'/>
    <title>SMART DETECTION</title>
    <link rel='stylesheet' href="style.css" type='text/css'>
  </head>
  <style>

  </style>
  <body>
    <div class="main">
      <div class="logo-title">

        <img class="logo" src='logo-corpo.jpeg'>
        <p class='logo-text'>SMART DETECTOR</p>
      </div>
      <div class="wrapper">
        <div class="clients data-div">
          <h3 class='titles'>DISPOSITIVOS CONECTADOS</h3>
          <div class='content-wrapper'>
          <?php
            $counter = 0;
            for($i = 0; $i <= count($usersJson); $i ++ ){

              $printName = $usersJson[$i];

              foreach($printName as $key => $value){

                if($key == 'hostname'){
                $values = strval($value);
                }
              }

              foreach($printName as $keyRes => $valueRes){

                if($keyRes == 'mac'){
                  $counter ++;
                  $result;
                  $result = $counter . ' - '.  $valueRes.  ': ' . $values. '<br>';
                  $printWord = '<pre>'. $result. '</pre>';
                  print $printWord;
                }
              }
            }
          ?>
        </div>
        </div>
        <div class="near-devices data-div">
          <h3 class = 'titles'>DISPOSITIVOS CERCANOS</h3>
          <div class = 'content-wrapper'>
          <?php
            $stack = [];

            $openFile = file('output.txt');

            $devicesJson = array($openFile);

            $mainStack = [];

            $devicesCount = count($devicesJson[0]);
            $otherJson = $devicesJson;

            for($i = 0; $i < $devicesCount; $i++){
              foreach($devicesJson as $device){
                array_push( $mainStack, $device[$i] );
              }
            }

            for ($s = 0; $s < count($mainStack); $s ++){
              $devicesName = $mainStack[$s];
              $arrayDevices = array($devicesName);

              foreach($arrayDevices as $lines => $valueLine){

                preg_match_all("/\b[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}\b/su", $valueLine, $matches);

                foreach($matches as $mac => $hexMac){
                  $cleanMac = implode($hexMac);
                  array_push($stack, $cleanMac);
                  $uniques = array_unique($stack);


                }
              }
            }

            $count = 0;

            foreach($uniques as $mainValue => $thisValue){
              static $newStack = [];
              array_push($newStack, $thisValue);
              $count ++;
              print_r ( '<pre class = "connected">'.$count . "-" .$thisValue. '</pre>');
            }


            if (count($newStack) > 30){

              unset($newStack[0]);
            }
          ?>
          </div>
        </div>
        <div class="known-devices">
        </div>
      </div>
    </div>
  </body>
<html>
