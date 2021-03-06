<?php

function connector() {
  $pdo = NULL;

  if(check_local()) {

    try {

      $server = '127.0.0.1';
      $db = 'CSE341';
      $username = 'root';
      $password = 'Xf=(ln!6VX';
      $dsn = "mysql:host=$server;dbname=$db";
      $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

      $pdo = new PDO($dsn, $username, $password, $options);
    } 
    catch(PDOException $e)  {
      echo $e;
      exit;
    }
  } 
  else {

    try {

      $env = getenv('DATABASE_URL');
      $dbOpts = parse_url($env);

      $dbHost = $dbOpts["host"];
      $dbPort = $dbOpts["port"];
      $dbUser = $dbOpts["user"];
      $dbPassword = $dbOpts["pass"];
      $dbName = ltrim($dbOpts["path"],'/');

      $pdo = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex)  {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
  }
  return $pdo;
}

function check_local()  {
  $whitelist = array( '127.0.0.1', '::1' );
  $_SESSION['env'] = "Heroku";

  if(in_array($_SERVER['REMOTE_ADDR'], $whitelist )) {
    $_SESSION['env'] = "Localhost";
    return true;
  }
}