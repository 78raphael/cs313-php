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
    if(isset($_POST['search']))   {

      $where = "SELECT id, book, chapter, verse, content FROM Scriptures WHERE book = '".$_POST['search']."'";
    } else  {

      $where = "SELECT id, book, chapter, verse, content FROM Scriptures";
    }

    $toPrint = week5($where);

    include 'views/team5/index.php';
    break;
  case 'team5details':
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $where = "SELECT id, book, chapter, verse, content FROM Scriptures WHERE id = '". $id ."'";

    $toPrint = week5details($where);
    include 'views/team5/details.php';
    break;
  case 'week5':
    $query = "SELECT u.id, u.first_name, u.last_name, u.email, u.status AS userStatus, u.active, a.appt_time, a.status AS apptStatus, r.notes, s.name, s.price, s.status AS sessionStatus
      FROM users u
      INNER JOIN appointments a ON a.user_id = u.id
      INNER JOIN reviews r ON r.appointment_id = a.id
      INNER JOIN sessions s ON a.session_id = s.id";

    $results = infoDump($query);

    include 'views/week5/index.php';
    break;
  case 'team6':

    require_once 'models/team6.php';
    $toPrint = '';

    $topics = getTopics();

    var_dump($topics);

    echo 'before if<br>';
    if(isset($_POST['book'])) {

      $book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_STRING);
      $chapter = filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_STRING);
      $verse = filter_input(INPUT_POST, 'verse', FILTER_SANITIZE_STRING);
      $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
      $faith = filter_input(INPUT_POST, 'Faith', FILTER_SANITIZE_NUMBER_INT);
      $sacrifice = filter_input(INPUT_POST, 'Sacrifice', FILTER_SANITIZE_NUMBER_INT);
      $charity = filter_input(INPUT_POST, 'Charity', FILTER_SANITIZE_NUMBER_INT);
      $userCheckbox = filter_input(INPUT_POST, 'UserCheckbox', FILTER_SANITIZE_NUMBER_INT);
      $userText = filter_input(INPUT_POST, 'UserText', FILTER_SANITIZE_STRING);

      echo 'before team6()<br>';

      echo "Book: " . $book. "<br>"; 
      echo "Chapter: " . $chapter. "<br>"; 
      echo "Verse: " . $verse. "<br>"; 
      echo "Content: " . $content. "<br>"; 
      echo "Faith: " . $faith. "<br>"; 
      echo "Sacrifice: " . $sacrifice. "<br>"; 
      echo "Charity: " . $charity. "<br>"; 
      echo "userCheckbox: " . $userCheckbox. "<br>"; 
      echo "userText: " . $userText. "<br>";

      $team6 = team6($book, $chapter, $verse, $content, $faith, $sacrifice, $charity, $userCheckbox, $userText);

      echo $team6;
  
    }

    include 'views/team6/index.php';
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
