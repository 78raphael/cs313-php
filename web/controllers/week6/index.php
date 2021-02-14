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
  case 'logout':
    $_SESSION['w6_login'] = false;
    $_SESSION['full_name'] = '';
    $_SESSION['status'] = '';
    $_SESSION['message'] = '<div class="success">Logout Successful</div>';
    include '../../views/week6/index.php';
    break;
  case 'login':
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $result = validate($email, $password);

    if(!$result) {
      $_SESSION["message"] = "<div class='failed'>Please enter correct username or password</div>";

      header('Location: /?action=week6');
      exit;
    }

    $_SESSION['w6_login'] = true;
    $_SESSION['full_name'] = $result['full_name'];
    $_SESSION['status'] = $result['status'];

    $appointments = formatAppointments(getAppointments($result['status']));

    include '../../views/week6/login.php';
    break;
  case 'updateAppt':
    $review_id = filter_input(INPUT_POST, 'SbmtBtn', FILTER_SANITIZE_NUMBER_INT);
    $note_id = 'note_' . $review_id;
    $note = filter_input(INPUT_POST, $note_id, FILTER_SANITIZE_STRING);


    $updated = updateAppointments($review_id, $note);
    $appointments = formatAppointments(getAppointments($_SESSION['status']));

    $_SESSION['message'] = "<div class='success'> Review Updated</div>";

    include '../../views/week6/login.php';
    break;
  default:
  include '../../views/week6/index.php';
    break;
}