<?php
/**
 *    Week 6 Controller
 */

if(!isset($_SESSION)) {
  session_start();
} 

require_once '../../resources/connection.php';
require_once '../../views/php/top.php';
require_once '../../views/php/nav.php';
require_once '../../views/php/bottom.php';

require_once '../../models/week6.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch($action) {
  case 'login':
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if(validate($email, $password)) {
      include '../../views/week6/login.php';
    } else  {
      $_SESSION["message"] = "<div class='failed'>Please enter correct username or password</div>";
      echo $_SESSION["message"];
      header('Location: /?action=week6');
      exit;
    }
    break;
  case '':
    include '';
    break;
  default:
  include '../../views/week6/index.php';
    break;
}