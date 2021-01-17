<?php
/**
 *    Index Controller
 */
require_once 'views/php/top.php';
require_once 'views/php/nav.php';
require_once 'views/php/bottom.php';


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
  default:
    include 'views/week2/index.php';
}
