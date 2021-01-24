<?php
/**
 *    Week3 Controller
 */
require_once '../../views/php/top.php';
require_once '../../views/php/nav.php';
require_once '../../views/php/bottom.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch($action) {
  case 'week3':
    if(count($_POST) > 1)  {
      include '../../views/week3/cart.php';
    } else {
      $_SESSION["message"] = 'Please select at least 1 item';
      include '../../views/week3/index.php';
    }
    break;
  case 'checkout':
    include '../../views/week3/checkout.php';
    break;
  case 'cart':
    include '../../views/week3/cart.php';
    break;
  case 'confirm':
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
    $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_NUMBER_INT);

    if( empty($firstName) || empty($lastName) || 
    empty($address) || empty($city) ||
    empty($state) || empty($zip)
    )  
    {
      $_SESSION['message'] = "<p class='warning'>Please provide correct information for all fields.</p>";
      include '../../views/week3/checkout.php';
      exit;
    }


    include '../../views/week3/confirm.php';
    break;
  default:
    include '../..views/week2/index.php';
    break;
}