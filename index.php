<?php
/**
*Load necessary Unifi files
*/
require('vendor/autoload.php');

/**
*Define Unifi login credentials
*/
$site_id            = 'default';

$controlleruser     = 'admin';

$controllerpassword = 'Smhau$31.%';

$controllerurl      = 'https://unifi.smarthaus.com.mx:8443';

#--------------------------Connections------------------------------------

/**
*Create Unifi Connection and Login
*/
$unifidata = new UniFi_API\Client($controlleruser, $controllerpassword,
$controllerurl, $site_id);
$login  = $unifidata->login();

/**
*Request the selected array from Unifi cloud API
*Decode and encode it into a Json object.
*/

#----------List_Users-------------------------

/**Stat array from the current Unifi site
*/
unset($unifiUsers);

$unifiUsers = $unifidata->list_clients();

/**Main function
*/
function showClients($thisJson){

/*Decode and encode the current array
*/
  $usersJson = json_decode(json_encode($thisJson), true);

  /**save the encoded array into a new variable for convinience
  */
  $indexUsers = $usersJson;

  /**Key we want to search in the current array
  */
  $hostname = "hostname";

  /**Counter we are using to print in the list
  */
  $counter = 0;

  /**We loop times amount of the counter.
  */
  for($i = 0; $i <= count($indexUsers) ; $i ++ ){

  /**Select the same array from the current number in the loop
  */
    $printName = $indexUsers[$i];

  /**We start looping through every indentation level in the array
  */
    foreach($printName as $key => $value){

  /**if the key is equal as the string defined in $hostname variable print its
  *current number in the new list, its key and value
  */
      if($key == $hostname){
        $counter ++;
        $keys = $key;
        $values = $value;
      }
    }
    foreach($printName as $keyRes => $valueRes){

  /**Here we search for the manufacturer name of each device and print it in a single line
  */
      if($keyRes == 'oui'){
          echo $counter . ' - '.  $valueRes.  ': ' . $values. '<br>';
      }
    }
  }
}
showClients($unifiUsers);

header("refresh:1;");
