<?php

function week5($where)  {
  $db = connector();

  $scripture = '';
  
  try {
    $query = $db->prepare($where);
    $query->execute();

    $result = $query>fetchAll();

    return 'inside WEEK5: RESULT :::: ' . $result . '<br>';   // <—————————————————————————————————— TESTING

    foreach ($query as $row)  {
      $scripture .= '<p><a href="index.php?action=team5details&id='.$row['id'].'">' . $row['book'] . ' '. $row['chapter'] . ':'. $row['verse'] . '</a></p>';
    }

    return 'inside WEEK5: ' . $scripture . '<br>';   // <—————————————————————————————————— TESTING

    return $scripture;
  } catch(PDOexception $error) {
    return $error;
  }
}

function week5details($where)  {
  $db = connector();

  $scripture = '';

  foreach ($db->query($where) as $row)  {
    $scripture .= '<p>'.$row['id'].') ' . $row['book'] . ' ' . ' '. $row['chapter'] . ':'. $row['verse'] . ' - ' . $row['content'] . '</p>';
  }

  return $scripture;
}

function infoDump($query) {
  $db = connector();

  $results = '';

  foreach($db->query($query) as $row) {
    $results .= 'Fullname: ' . $row['first_name'] . ' ' . $row['last_name'] . 
    '<br>Email: ' . $row['email'] . 
    '<br>User Status: ' . $row['userStatus'] .
    '<br>Appointment Time: ' . $row['appt_time'] .
    '<br>Appointment Status: ' . $row['apptStatus'] .
    '<br>Appointment Notes: ' . $row['notes'] .
    '<br>Session Name: ' . $row['name'] .
    '<br>Price: $' . $row['price'] .
    '<br>Session Status: ' . $row['sessionStatus'];

    $results .= '<br><hr>';
  }

  return $results;

}