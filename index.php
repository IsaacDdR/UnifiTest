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
    .main{
      margin: 0px;
    }
    .data-div{
      border: solid black;
      width:50%;
      margin:auto;

    }

    .titles
    {
      text-align: center;
      margin: auto;
      width: 50%;
    }
    .content-wrapper{
      text-align: center;
      margin:5%;
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
                  echo '<pre>'. $result. '</pre>';
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
            $openFile = file('output.txt');

            $devicesJson = array($openFile);


            for ($s = 0; $s < count($devicesJson); $s ++ )
            {
              $devicesName = $devicesJson[$s];

              foreach($devicesName as $lines => $valueLine)
              {
                echo '<pre>' . $valueLine . '</pre>';
              }
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
