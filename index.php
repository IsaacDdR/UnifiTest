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
*Create Unifi Conection and Login
*/
$unifidata = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id);
$login  = $unifidata->login();

/**
*Here we request the selected type of array from Unifi cloud API
*later, we decode and encode it into a Json object.
*/

#----------List_Users-------------------------

/**We select to stat the full array of users in the current Unifi site
*/

$unifiUsers = NULL;
$unifiUsers = $unifidata->list_clients();

/**We define the main function
*/
function showClients($thisJson){

/**We decode and encode the current array for its full access
*/
  $usersJson = json_decode(json_encode($thisJson), true);

  /**We point the encoded array to new variable for conviniencew
  */
  $indexUsers = $usersJson;

  /**We define the key we want to search in the current array
  */
  $hostname = "hostname";

  /**We define a counter to save the numbers of keys in the array
  */
  $count = count($indexUsers);

  /**Counter we are using to print in the list
  */
  $counter = 0;

  /**We loop the same number of keys in the array.
  */
  for($i = 0; $i <= $count;$i ++ ){

  /**We select the same array from the current number in the loop
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
