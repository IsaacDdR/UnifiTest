<?php

$servername = 'localhost';

$username = 'unifi';

$password = 'TEST';

$db = 'unifi';

$conn = mysqli_connect($servername, $username,  $password, $db);

$filePath = 'output.txt';

$file = file($filePath);

$arrayFile = array($file);

function readArray($probesArray){
  foreach($probesArray as $item){
    return $item;
  }
}

$probes = readArray($arrayFile);



function cleanArray($probesArray){
  $totalMatches = [];
  foreach($probesArray as $item => $mac){
    preg_match_all("/\b[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}\b/su", $mac, $matches);
    array_push($totalMatches, $matches);
  }
  return $totalMatches;
}

$clean = cleanArray($probes);

function macArray($probesArray, $link){
  foreach($probesArray as $item){
    foreach($item as $values => $mac){
      $sql = "INSERT INTO MacDevices (MAC_name) VALUES ('".$mac[0]."')";
      if(mysqli_query($link, $sql)){
        echo "<br>";
        echo "Se grabo " . $mac[0] . " con exito";
      } else {
        echo "Error: " . mysqli_error($link);
        echo '<br>';
      }
    }
  }
}

print_r(macArray($clean, $conn));






if(!$conn){
  die("Fallo en la conexion " . mysql_connect_error());
}
?>
