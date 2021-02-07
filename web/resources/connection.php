<?php

function connector() {
  if(check_local()) {

    $server = '127.0.0.1';
    $db = 'CSE341';
    $username = 'root';
    $password = 'Xf=(ln!6VX';
    $dsn = "mysql:host=$server;dbname=$db";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
      $link = new PDO($dsn, $username, $password, $options);
      return $link;
    } 
    catch(PDOException $e)  {
      echo $e;
      exit;
    }
  } else {

    try {
      $dbUrl = getenv('DATABASE_URL');

      $dbOpts = parse_url($dbUrl);

      $dbHost = $dbOpts["host"];
      $dbPort = $dbOpts["port"];
      $dbUser = $dbOpts["user"];
      $dbPassword = $dbOpts["pass"];
      $dbName = ltrim($dbOpts["path"],'/');

      $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex)  {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }
}

function check_local()  {
  $whitelist = array( '127.0.0.1', '::1' );

  if(in_array($_SERVER['REMOTE_ADDR'], $whitelist )) {
    return true;
  }
}