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

#--------------------------Connections------------------------------------

/**
*Create Unifi Conection and Login
*/
$unifidata = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id);

$login  = $unifidata->login();

#------------Unifi---Options------------------

/**
*Here we request the selected type of array from Unifi cloud API
*later, we decode and encode it into a Json object.
*/

#----------List_Users-------------------------

/**We select to stat the full array of users in the current Unifi site
*/

$unifiUsers = $unifidata->stat_allusers();

$usersJson = json_decode(json_encode($unifiUsers), true);

$indexUsers = $usersJson;

$hostname = "hostname";

$count = count($indexUsers);

$counter = 0;

for($i = 0; $i <= $count;$i ++ ){
  $printName = $indexUsers[$i];
  foreach($printName as $key => $value){
    if($key == $hostname){
      $counter ++;
      print_r($counter . ' - ' . $key . ' : ' . $value);
      echo '<br>';
    }
  }
}
