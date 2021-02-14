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

    echo 'Email: ' . $email . '<br>';
    echo 'Password: ' . $password . '<br>';

    $result = validate($email, $password);

    var_dump($result);

    if(!$result) {
      $_SESSION["message"] = "<div class='failed'>Please enter correct username or password</div>";

      header('Location: /?action=week6');
      exit;
    }

    $_SESSION['full_name'] = $result['full_name'];
    $_SESSION['status'] = $result['status'];

    var_dump("SESSION: ", $_SESSION);

    $appointments = formatAppointments(getAppointments($result['status']));

    $

    include '../../views/week6/login.php';
    break;
  case 'updateAppt':
    $review_id = filter_input(INPUT_POST, 'SbmtBtn', FILTER_SANITIZE_NUMBER_INT);
    $note_id = 'note_' . $review_id;
    $note = filter_input(INPUT_POST, $note_id, FILTER_SANITIZE_STRING);

    echo 'Review ID: '. $review_id . '<br>';
    echo 'Note ID: '. $note_id . '<br>';
    echo 'Note: '. $note . '<br>';

    $updated = updateAppointments($review_id, $note);

    $appointments = formatAppointments(getAppointments($_SESSION['status']));

    $_SESSION['message'] = "<div class='success'> Reviews updated: $updated</div>";

    include '../../views/week6/login.php';
    break;
  default:
  include '../../views/week6/index.php';
    break;
}