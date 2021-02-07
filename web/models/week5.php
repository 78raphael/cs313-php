<?php

function week5($where)  {
  $db = connector();

  $scripture = '';
  
  $stmt = $db->prepare($where);
  $stmt->execute();

  $result = $stmt->fetchAll();
  $stmt->closeCursor();

  foreach ($result as $row)  {
    $scripture .= '<p><a href="index.php?action=team5details&id='.$row['id'].'">' . $row['book'] . ' '. $row['chapter'] . ':'. $row['verse'] . '</a></p>';
  }

  return $scripture;
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

  $build = '';

  $stmt = $db->prepare($query);
  $stmt->execute();

  $result = $stmt->fetchAll();
  $stmt->closeCursor();

  foreach($result as $row) {
    $build .= 'Fullname: ' . $row['first_name'] . ' ' . $row['last_name'] . 
    '<br>Email: ' . $row['email'] . 
    '<br>User Status: ' . $row['userStatus'] .
    '<br>Appointment Time: ' . $row['appt_time'] .
    '<br>Appointment Status: ' . $row['apptStatus'] .
    '<br>Appointment Notes: ' . $row['notes'] .
    '<br>Session Name: ' . $row['name'] .
    '<br>Price: $' . $row['price'] .
    '<br>Session Status: ' . $row['sessionStatus'];

    $build .= '<br><hr>';
  }

  return $build;

}