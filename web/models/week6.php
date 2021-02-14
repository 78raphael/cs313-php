<?php
/**
 *    Week 6 Model
 */


/**
 *    Validate login credentials
 *      param user email
 *      param user password
 * 
 *    return full_name, password, status
 */
function validate($email, $password) {
  $pdo = connector();

  $stmt = $pdo->prepare("SELECT u.password, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.status FROM users u WHERE u.email = :email AND u.active LIMIT 1");

  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();

  $result = $stmt->fetch();
  $stmt->closeCursor();

  return ($result['password'] === $password) ? $result : false;
}


/**
 *    return appointment information from DB
 *      param User status
 */
function getAppointments($status)  {
  $pdo = connector();

  if($status == 'admin')  {
    $mysql = "SELECT a.id AS appt_id, a.user_id, a.session_id, a.appt_time, a.status AS appt_status, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.status AS user_status, s.name AS session_name, s.status AS session_status, r.id AS review_id, r.notes
    FROM appointments a
    INNER JOIN users u ON u.id = a.user_id
    INNER JOIN sessions s ON s.id = a.session_id
    INNER JOIN reviews r ON r.appointment_id = a.id
    WHERE u.active = 1
    ORDER BY a.appt_time;
    ";

    $postgresql = "SELECT a.id AS appt_id, a.user_id, a.session_id, a.appt_time, a.status AS appt_status, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.status AS user_status, s.name AS session_name, s.status AS session_status, r.id AS review_id, r.notes
    FROM appointments a
    INNER JOIN users u ON u.id = a.user_id
    INNER JOIN sessions s ON s.id = a.session_id
    INNER JOIN reviews r ON r.appointment_id = a.id
    WHERE u.active
    ORDER BY a.appt_time;
    ";
  } else {
    $query = "";
  }

  $stmt = $pdo->prepare($postgresql);
  $stmt->execute();

  $result = $stmt->fetchAll();
  $stmt->closeCursor();

  return $result;
}


/**
 *    Format Appointment information into table
 *      param $results array
 */
function formatAppointments($results) {
  $appointments = '';

  foreach($results AS $appt) {
    $appointments .= "<table class='appt_table'>";
    $appointments .= "
      <tr>
        <th>Name</th>
        <td>$appt[full_name]</td>
        <th>Status</th>
        <td>$appt[user_status]</td>
      </tr>
      <tr>
        <th>Appt Time</th>
        <td>$appt[appt_time]</td>
        <th>Session</th>
        <td>$appt[session_name]</td>
      </tr>
      <tr>
        <th colspan='1'>Notes</th>
        <td colspan='3'><textarea name='note_$appt[review_id]' cols='75' rows='10'>$appt[notes]</textarea></td>
      </tr>
      <tr>
        <th colspan='1'></th>
        <td colspan='3'><button type='submit' name='SbmtBtn' value='$appt[review_id]'>Update</button></td>
      <tr>
      ";
      $appointments .= "</table>";
  }

  return $appointments;
}


/**
 *    UPDATE appointment notes
 *      param $review_id
 */
function updateAppointments($review_id, $note) {
  $pdo = connector();

  $mysql = "UPDATE reviews r SET r.notes = :note WHERE r.id = :review_id";

  $postgresql = "UPDATE 'reviews' AS r SET 'notes' = :note WHERE r.id = :review_id";

  $stmt = $pdo->prepare($postgresql);

  return $postgresql;

  $stmt->bindValue(':review_id', $review_id, PDO::PARAM_STR);
  $stmt->bindValue(':note', $note, PDO::PARAM_STR);
  $stmt->execute();

  $result = $stmt->rowCount();
  $stmt->closeCursor();

  return $result; 


}