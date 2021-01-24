<?php
session_start();

  require_once '../views/php/top.php';
  require_once '../views/php/nav.php';
  require_once '../views/php/bottom.php';

  $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
  if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
  }

  switch($action) {
    // case 'cart':
    //   include '../views/week3/cart.php';
    //   break;
    default:
      include 'views/week2/index.php';
      break;
  }