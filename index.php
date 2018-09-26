<?php

#----------------------------Variables--------------------------

/**
*Load necessary Unifi files
*/
require('vendor/autoload.php');

/**
*Define Unifi login
*/
$site_id            = 'default';

$controlleruser     = 'admin';

$controllerpassword = 'Smhau$31.%';

$controllerurl      = 'https://unifi.smarthaus.com.mx:8443';

$cookietimeout      = '3600';

#--------------------------Connections------------------------------------


/**
*Create Unifi Conection and Login
*/
$unifidata = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id);

$login  = $unifidata->login();


#------------Unifi---Options------------------
/**
*Here we request the selected type of array from Unifi cloud API
*later, we decode and encode it into a Json object,
*at last we index the first array's indentation level.
*/
#------------List_Devices--------------------


$unifiDevices = $unifidata->list_devices();

$devicesJson = json_decode(json_encode($unifiDevices),true);

$indexDevices = $devicesJson;




#echo $indexArray['ip'];



#----------List_Users-------------------------


$unifiUsers = $unifidata->stat_allusers();

$usersJson = json_decode(json_encode($unifiUsers), true);

$indexUsers = $usersJson;

$hostname = "hostname";


$count = count($indexUsers);

for($i = 0; $i <= $count;$i ++ ){
  $printName = $indexUsers[$i];
  foreach($printName as $key => $value){
    if($key == "hostname"){
      print_r($i. ': ' .$value);
      echo '<br>';
    }
  }
}

#-------------List_Clients---------------------


$unifiClients = $unifidata->list_clients();

$clientsJson = json_decode(json_encode($unifiClients), true);

$indexClients = $clientsJson;



#------------List_Guests-------------------------
/**

*$unifiGuests = $unifidata->list_guests();

*$guestsJson = json_decode(json_encode($unifiGuests), true);

*$indexGuests = $guestsJson;

*/

#---------------------Functions-----------------------------------------------
/**
*Each function echoes a different property from the Unifi indexed array
*/

/**
*In this case we echo the keys and the values from the Unifi's selected arrays.
*/
function dropIndex($index){
  echo '<br>';
  echo '-------------Start full drop------------'. '<br>';
  echo '<br>';
  foreach  ($index as $key => $value){
    echo $key . " : ". $value . "<br>";
  }
  echo '<br>';
  echo '-----------End full drops-------------'. '<br>';
  echo '<br>';
}
#dropIndex() Inside the function's arguments you must add a Json decoded UniFi array
?>

<?php
function dropKeys($keys){
  foreach($keys as $x => $y){
    if($x == "_id"){
      print_r("Muestra ID: " .$y);
      echo '<br>';
    }elseif($x == "uptime"){
      print_r ("Muestra Uptime: ". $y);
      echo '<br>';
    }
  }
}
#dropKeys($indexDevices)

?>

<?php
function dropValues($values){
  echo '<br>';
  echo '-------------Start values drop----------' . '<br>';
  echo '<br>';
  foreach($values as $x => $y){
    echo $y .  '<br>';
  }
  echo '<br>';
  echo '-------------End values drop---------' . '<br>';
  echo '<br>';
}
#dropValues($indexDevices)
?>

<?php

for($i = 0; $i <=  $keys; $i ++){
  echo $newTry[$i];
}
?>
