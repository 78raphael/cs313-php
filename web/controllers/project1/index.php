<?php
/**
 *    Project 1 (Week 7) Controller
 */
if(!isset($_SESSION)) {
  session_start();
}

require_once '../../resources/connection.php';
require_once '../../resources/login.php';

/**
 *  VIEWS
 */
require_once '../../views/php/top.php';
require_once '../../views/php/nav.php';
require_once '../../views/php/bottom.php';

/**
 *  MODELS
 */
require_once '../../models/project1.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch($action) {
  case 'logout':
    unset($_SESSION['p1_login']);
    unset($_SESSION['p1_full_name']);
    unset($_SESSION['p1_status']);

    $_SESSION['message'] = '<div class="success">Logout Successful</div>';
    include '../../views/week7/index.php';
    break;
  case 'login':
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $result = validateUser($username, $password);

    if(!$result) {
      $_SESSION['message'] = '<div class="failed">Please enter correct email or password</div>';
      header('Location: /?action=week7');
      exit;
    }

    $_SESSION['p1_login'] = true;
    $_SESSION['p1_full_name'] = $result['full_name'];
    $_SESSION['p1_status'] = $result['status'];
    $_SESSION['p1_id'] = $result['id'];

    $userNav = generateNav($_SESSION['p1_status']);
    $appointments = formatAppointments(getAppointments($_SESSION['p1_status'], $_SESSION['p1_id']), $_SESSION['p1_status']);

    include '../../views/week7/landing.php';
    break;
  case 'signup':
    include '../../views/week7/signup.php';
    break;
  case 'register':
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $register = register($first_name, $last_name, $username, $email, $password);

    if($register == 0) {
      include '../../views/week7/signup.php';
      exit;
    }

    $_SESSION['message'] = '<div class="success">Registered Successful</div>';

    include '../../views/week7/index.php';
    break;
  case 'update':

    $review_id = filter_input(INPUT_POST, 'UpdateBtn', FILTER_SANITIZE_NUMBER_INT);
    if($review_id != null)  {
      $note_id = 'note_' . $review_id;
      $note = filter_input(INPUT_POST, $note_id, FILTER_SANITIZE_STRING);

      $updated = updateAppointments($review_id, $note);
      $_SESSION['message'] = "<div class='success'>Notes Updated</div>";
      
    } else {
      $appt_id = filter_input(INPUT_POST, 'DeleteBtn', FILTER_SANITIZE_NUMBER_INT);

      $deleted = deleteAppointments($appt_id);
      $_SESSION['message'] = "<div class='success'>Appointment Removed</div>";
    }

    $userNav = generateNav($_SESSION['p1_status']);
    $appointments = formatAppointments(getAppointments($_SESSION['p1_status'], $_SESSION['p1_id']), $_SESSION['p1_status']);

    include '../../views/week7/landing.php';
    break;

  case 'createAppt':
    $userList = formatUsers(getUsers());
    $sessionList = formatSessions(getSessions());

    include '../../views/week7/create.php';
    break;
  case 'create':

    $user_id = filter_input(INPUT_POST, 'usersList', FILTER_VALIDATE_INT);
    $session_id = filter_input(INPUT_POST, 'sessionsList', FILTER_VALIDATE_INT);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING);
    $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);

    $dateTime = $date . ' ' . $time;

    $result = createAppointments($user_id, $session_id, $dateTime, $notes);
    
    $userList = formatUsers(getUsers());
    $sessionList = formatSessions(getSessions());

    if($result > 0) {
      $userNav = generateNav($_SESSION['p1_status']);
      $appointments = formatAppointments(getAppointments($_SESSION['p1_status'], $_SESSION['p1_id']), $_SESSION['p1_status']);

      $_SESSION['message'] = '<div class="success">Appointment successfully created</div>';

      include '../../views/week7/landing.php';
      exit;
    }

    $_SESSION['message'] = '<div class="failed">Appointment not created. Try creating again.</div>';
    include '../../views/week7/create.php';
    break;
  default:
    include '../../views/week7/index.php';
    break;
}