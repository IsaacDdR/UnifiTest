<?php

$servername = 'localhost';

$username   = 'unifi';

$password   = 'TEST';

$db = "unifi";

$conn = mysqli_connect($servername, $username, $password, $db);

if(!$conn){
  die("Fallo en la conexion " . mysqli_connect_error());
}

/* CREATE DATABASE

if(mysqli_query($conn, $sql)){
  echo "Base de datos creada";
}else{
  echo "Error al crear la base de datos" . mysqli_error($conn);
}
*/

/* CREATE TABLE

$sql = "CREATE TABLE unifiDevices(
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  email VARCHAR(50),
  reg_date TIMESTAMP
)";

if(mysqli_query($conn, $sql)){
  echo "Tabla creada con exito";
}else{
  echo "Error al crear la tabla" . mysql_error($conn);
}
*/
?>
