<?php
  $server = "localhost";
  $user = "root";
  $password = "Eskere99";

  $conn = mysqli_connect($server, $user, $password);

  if (!$conn){
    die("Error en conexion: " . mysqli_connect_error());
  }

  $sql = "CREATE DATABASE unfidb";

  if (mysqli_query($conn, $sql)){
      echo "Se creo base de datos";
  } else {
      echo "Error al crear base de datos" . mysqli_error($conn);
  }

  mysqli_close($conn);
?>
