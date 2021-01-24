<?php
/**
 *    Index Controller
 */

(!isset($_SESSION)) ? session_start() : var_dump($_SESSION);

require_once 'views/php/top.php';
require_once 'views/php/nav.php';
require_once 'views/php/bottom.php';

// $_SESSION['message'] = "Welcome to the page";

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
  case 'week5':
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
