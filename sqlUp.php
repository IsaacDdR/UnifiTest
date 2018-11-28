<?php
 require('getDev.php');
 require('getConn.php');
 require('mysql.php');

$getTable = "INSERT INTO MacDevices (MAC_name) VALUES ('".$newMac."')";

foreach($macJson){
  if(mysqli_query($conn, $getTable)){
    echo "Se pudo";
  }
}



?>
