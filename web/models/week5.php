<?php

function week5($where)  {
  $db = connector();

  $scripture = '';

  foreach ($db->query($where) as $row)  {
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