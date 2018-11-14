<?php

require('vendor/autoload.php');

require('config.php');

$filePath = 'output.txt';

ftruncate($filePath);




$unifidata = new UniFi_API\Client($controlleruser, $controllerpassword,
$controllerurl, $site_id);

$login  = $unifidata->login();

unset($usersJson);

$unifiUsers = $unifidata->list_clients();

$usersJson = json_decode(json_encode($unifiUsers), true);


?>

<!DOCTYPE html>

<html>
  <head>
    <title>SMART DETECTION</title>
  </head>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Questrial');
    .main{
      font-family: 'Questrial', sans-serif;
      margin: 0px;
    }
    .data-div{
      -webkit-box-shadow: 0px 0px 22px 0px rgba(87,87,87,0.34);
      -moz-box-shadow: 0px 0px 22px 0px rgba(87,87,87,0.34);
      box-shadow: 0px 0px 22px 0px rgba(87,87,87,0.34);
      padding:1%;
      border-radius: 5px;
      width:50%;
      margin:auto;
      margin-top: 5%;
      background-color: rgb(195, 206, 244);
    }

    .titles
    {
      text-align: center;
      margin: auto;
      margin-top: 2%;
      width: 50%;
    }
    .content-wrapper{

      text-align: left;
      margin:5%;
    }
    .connected{
      padding:3%;
      margin:3%;

    }
  </style>
  <body>
    <div class="main">
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

                if($keyRes == 'oui'){
                  $counter ++;
                  global $result;
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

            $stackCount = count($mainStack);

            if($stackCount > 30){
              unset($mainStack[0]);
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

            foreach($uniques as $mainValue){
              $newStack = [];
              echo '<pre class = "connected">'.  $mainValue. '</pre>';
              array_push($newStack, $mainValue);
            }
          ?>
          </div>
        </div>
        <div class="known-devices">
        </div>
      </div>
    </div>
  </body>
</html>
