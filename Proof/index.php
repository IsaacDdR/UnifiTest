<?php

require('vendor/autoload.php');

require('config.php');



$servername = 'localhost';

$username   = 'unifi';

$password   = 'TEST';

$db = "unifi";




$unifidata = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id);

$login = $unifidata->login();

$unifiArray = $unifidata->list_clients();

$jsonList = json_decode(json_encode($unifiArray), true);

function returnList ($theList){
  $servername = 'localhost';

  $username   = 'unifi';

  $password   = 'TEST';

  $db = "unifi";

  $conn = mysqli_connect($servername, $username, $password, $db);

  $totalArray = [];

  foreach($theList as $macro => $micro){

    foreach($micro as $mini => $nano){

      if($mini == "oui"){

        array_push($totalArray, $nano);

        $sql = "INSERT INTO unifiDevices (firstname, lastname)

        VALUES(  '$nano' , '$mini' )";

        if (mysqli_query($conn, $sql)){
          echo "Se grabo la info " . $nano;
          echo "<br>";
        } else {
          echo "Hubo error " . $sql . "<br>" . mysqli_error($conn);
        }

      }
    }
  }
  return $totalArray;
}
$arrayResult = returnList($jsonList);

print_r ($arrayResult);

?>
