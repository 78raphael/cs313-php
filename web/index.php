<?php
/**
 *    Index Controller
 */

(!isset($_SESSION)) ? session_start() : var_dump($_SESSION);

require_once 'resources/connection.php';
require_once 'views/php/top.php';
require_once 'views/php/nav.php';
require_once 'views/php/bottom.php';

require_once 'models/week5.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch($action) 
{
  case 'assignments':
    require_once 'views/php/assignments-list.php';
    include 'views/week2/assignments.php';
    break;
  case 'week1':
    include 'views/week1/index.php';
    break;
  case 'week2':
    include 'views/week2/index.php';
    break;
  case 'week3':
    include 'views/week3/index.php';
    break;
  case 'week4':
    include 'views/week4/index.php';
    break;
  case 'team5':
    echo 'inside team5<br>';
    if(isset($_POST['search']))   {
      echo 'inside $_POST[search] - IF<br>';   // <—————————————————————————————————— TESTING

      $where = "SELECT id, book, chapter, verse, content FROM scriptures WHERE book = '".$_POST['search']."'";
    } else  {
      echo 'inside $_POST[search] - ELSE<br>';   // <—————————————————————————————————— TESTING
      $where = "SELECT id, book, chapter, verse, content FROM scriptures";
    }

    echo 'WHERE: '. $where . '<br><br>';   // <—————————————————————————————————— TESTING
    echo 'before $toPrint<br>';   // <—————————————————————————————————— TESTING
    $toPrint = week5($where);
    echo 'after $toPrint: '. $toPrint . '<br>';   // <—————————————————————————————————— TESTING

    include 'views/team5/index.php';
    break;
  case 'team5details':
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $where = "SELECT id, book, chapter, verse, content FROM scriptures WHERE id = '". $id ."'";

    $toPrint = week5details($where);
    include 'views/team5/details.php';
    break;
  case 'week5':
    echo 'inside week5';   // <—————————————————————————————————— TESTING
    $query = "SELECT u.id, u.first_name, u.last_name, u.email, u.status AS userStatus, u.active, a.appt_time, a.status AS apptStatus, r.notes, s.name, s.price, s.status AS sessionStatus
      FROM users u
      INNER JOIN appointments a ON a.user_id = u.id
      INNER JOIN reviews r ON r.appointment_id = a.id
      INNER JOIN sessions s ON a.session_id = s.id";

    echo 'Query: ' . $query . '<br>';   // <—————————————————————————————————— TESTING

    $results = infoDump($query);

    include 'views/week5/index.php';
    break;
  case 'week6':
    include 'views/week6/index.php';
    break;
  case 'week7':
    include 'views/week7/index.php';
    break;
  case 'week8':
    include 'views/week8/index.php';
    break;
  case 'week9':
    include 'views/week9/index.php';
    break;
  case 'week10':
    include 'views/week10/index.php';
    break;
  case 'week11':
    include 'views/week11/index.php';
    break;
  case 'week12':
    include 'views/week12/index.php';
    break;
  case 'week13':
    include 'views/week13/index.php';
    break;
  case 'week14':
    include 'views/week14/index.php';
    break;
  default:
    include 'views/week2/index.php';
}
