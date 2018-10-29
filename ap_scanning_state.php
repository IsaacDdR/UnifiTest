<?php
/**
 * PHP API usage example
 *
 * contributed by: Art of WiFi
 * description: example basic PHP script to fetch an Access Point's scanning state/results
 */

/**
 * using the composer autoloader
 */
require_once('vendor/autoload.php');

/**
 * include the config file (place your credentials etc. there if not already present)
 * see the config.template.php file for an example
 */
require_once('config.php');

/**
 * site id and MAC address of AP to query
 */
<<<<<<< HEAD
$ap_mac  = 'fc:ec:da:1c:e0:50';
=======
$site_id = '<enter your site id here>';
$ap_mac  = '<enter MAC address of Access Point to check>';
>>>>>>> 74d0778974ec7938ff26570166d80de0c802af9a

/**
 * initialize the UniFi API connection class and log in to the controller and do our thing
 * spectrum_scan_state()
 */
$unifi_connection = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id, $controllerversion);
$set_debug_mode   = $unifi_connection->set_debug($debug);
$loginresults     = $unifi_connection->login();
$data             = $unifi_connection->spectrum_scan_state($ap_mac);

/**
 * provide feedback in json format
 */
<<<<<<< HEAD

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Scan State</title>
  </head>
  <body>
    <pre><?php echo json_encode($data, JSON_PRETTY_PRINT);?> </pre>
  </body>
</html>
=======
echo json_encode($data, JSON_PRETTY_PRINT);
>>>>>>> 74d0778974ec7938ff26570166d80de0c802af9a
