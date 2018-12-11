<?php

 require('getDev.php');
 require('getConn.php');
 require('mysql.php');

 $getDates = "SHOW TABLES;";

$datesList = mysqli_query($conn, $getDates);



function returnDates($dates){
  $time = ("Y/m/d");
  foreach($dates as $date){
    foreach($date as $day){
      if($day != $time){
        $dateState;
      }
      return $dateState = TRUE;
    }
  }
}
$thisState = (returnDates($datesList));

/*
$thisDate = authData($getDates);
function getDateList(authDate){


  $getDates = "CREATE TABLE .'"$time"'. (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    mac VARCHAR(30) NOT NULL,
    register VARCHAR(30) NOT NULL
  )";
}




foreach($macJson as $mac){
  $getTable = "INSERT INTO MacDevices (MAC_name) VALUES ('".$mac."')";
  if(mysqli_query($conn, $getTable)){
    echo "Se pudo";
  } else {
    echo "No pudo";
    echo '<br>';
  }
}
*/

?>
