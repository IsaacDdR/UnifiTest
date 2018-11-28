<!DOCTYPE html>

<html>

  <head>
    <link rel='icon' href='favicon.png' type='image/x-icon'/>
    <title>SMART DETECTION</title>
    <link rel='stylesheet' href="style.css" type='text/css'>
  </head>

  <body>
    <div class="main">
      <div class="logo-title">
        <img class="logo" src='logo-corpo.jpeg'>
        <p class='logo-text'>SMART DETECTOR</p>
      </div>

      <div class="wrapper">

        <div class="clients data-div">
          <h3 class='titles'>DISPOSITIVOS CONECTADOS</h3>
          <div class='content-wrapper'>
          <?php
            require('getConn.php');
            print_r(returnDevices($jsonArray));
          ?>
          </div>
        </div>

        <div class="near-devices data-div">
          <h3 class = 'titles'>DISPOSITIVOS CERCANOS</h3>
          <div class = 'content-wrapper'>
          <?php
            require('getDev.php');
            print_r(getMac($macJson));
          ?>
          </div>
        </div>

      </div>
    </div>
  </body>

<html>
