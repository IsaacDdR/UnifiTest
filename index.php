<?php
/**
*Load necessary Unifi files
*/
require('vendor/autoload.php');


$openFile = fopen('output.txt', 'r');

while ($line = fgets($openFile)){
  echo($line);
}

echo $probeFile;

foreach ($probeFile as $devices)
{
  echo $devices;
}
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
$unifiUsers;

unset($unifiUsers);
#----------List_Users-------------------------

/**Clear array from previous fetch
*/


/**Stat array from the current selection from Unifi site
*/

$unifiUsers = $unifidata->list_clients();

/**Main function
*/

function showClients($thisJson){


/*Decode and encode the current array
*/
  $usersJson = json_decode(json_encode($thisJson), true);

  /**save the encoded array into a new variable for convenience
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

  /**Select array indentation from the current number in the loop
  */
    $printName = $indexUsers[$i];

  /**We start looping through every indentation level in the array
  */
    foreach($printName as $key => $value){

  /**if the key is equal as the string defined at $hostname variable, print
  *current number in the new list, its key and value
  */
      if($key == $hostname){
        $counter ++;
        $keys = $key;
        $values = strval($value);
      }
    }
    foreach($printName as $keyRes => $valueRes){

  /**search for the manufacturer name of each device and print it in a single line
  */
      if($keyRes == 'oui'){

        global $result;
        $result = $counter . ' - '.  $valueRes.  ': ' . $values. '<br>';
        unset($result);
      }
    }
  }
}
showClients($unifiUsers);

header("refresh:1;");

?>

<html>
  <head>
    <title>SMART DETECTION</title>
  </head>
  <body>
    <form action="#" method="post">

    </form>
    <div class="main">
      <div class="wrapper">
        <div class="clients">
          <pre><?php echo $result; ?></pre>
        </div>
      </div>
    </div>
  </body>
</html>
