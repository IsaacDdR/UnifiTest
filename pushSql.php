<?php

require('vendor/autoload.php');

require('config.php');

$servername = 'localhost';

$username   = 'unifi';

$password   = 'TEST';

$db = "unifi";

$conn = mysqli_connect($servername, $username, $password, $db);

$unifidata = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id);

$login = $unifidata->login();

$unifiUsers = $unifidata->list_clients();

$unifiJson = json_decode(json_encode($unifiUsers), true);

function returnSQL($unifiArray, $link){
  $devicesList = [];
  foreach($unifiArray as $array){
    foreach ($array as $item => $value){
      if($item == 'mac'){
        $sql = "INSERT INTO MacDevices (MAC_name) VALUES ('".$value."')";
        if(mysqli_query($link, $sql)){
          print_r("Se ha grabado" . $value . " en base de datos");
        }else {
          echo "Error: " . mysqli_error($link);
          echo '<br>';
        }
      }
    }
  }
}

returnSQL($unifiJson, $conn);




?>
