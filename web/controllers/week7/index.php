<?php
/**
 *    Week 7 Controller
 */

if(!isset($_SESSION)) {
  session_start();
} 

require_once '../../resources/connection.php';
require_once '../../resources/login.php';
require_once '../../views/php/top.php';
require_once '../../views/php/nav.php';
require_once '../../views/php/bottom.php';

// require_once '../../models/week7.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch($action) {
  case 'logout':

    unset($_SESSION['w7_login']);
    unset($_SESSION['full_name']);
    unset($_SESSION['status']);

    $_SESSION['message'] = '<div class="success">Logout Successful</div>';
    include '../../views/team7/index.php';
    break;
  case 'login':
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $result = validateUser($username, $password);

    if(!$result) {
      header('Location: /?action=team7');
      exit;
    }

    $_SESSION['w7_login'] = true;
    $_SESSION['full_name'] = $result['full_name'];
    $_SESSION['status'] = $result['status'];
    include '../../views/team7/landing.php';
    break;
  case 'signup':
    include '../../views/team7/signup.php';
    break;
  case 'register':
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $register = register($first_name, $last_name, $username, $email, $password);

    if($register == 0) {
      include '../../views/team7/signup.php';
      exit;
    }

    include '../../views/team7/index.php';
    break;
  default:
    include '../../views/team7/index.php';
    break;
}