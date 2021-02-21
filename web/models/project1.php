<?php
/**
 *    Project 1 Model
 */


/**
 *    return appointment information from DB
 *      param User status
 */
function getAppointments($status, $id = null)  {
  $pdo = connector();

  if($status === 'admin')  {
    if($_SESSION['env'] === 'Localhost')  {
      $query = "SELECT a.id AS appt_id, a.user_id, a.session_id, a.appt_time, a.status AS appt_status, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.status AS user_status, s.name AS session_name, s.status AS session_status, r.id AS review_id, r.notes
      FROM appointments a
      INNER JOIN users u ON u.id = a.user_id
      INNER JOIN sessions s ON s.id = a.session_id
      LEFT JOIN reviews r ON r.appointment_id = a.id
      WHERE u.active = 1
      ORDER BY a.appt_time;
      ";
    } else {
      $query = "SELECT a.id AS appt_id, a.user_id, a.session_id, a.appt_time, a.status AS appt_status, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.status AS user_status, s.name AS session_name, s.status AS session_status, r.id AS review_id, r.notes
      FROM appointments a
      INNER JOIN users u ON u.id = a.user_id
      INNER JOIN sessions s ON s.id = a.session_id
      LEFT JOIN reviews r ON r.appointment_id = a.id
      WHERE u.active
      ORDER BY a.appt_time;
      ";
    }

    $stmt = $pdo->prepare($query);

  } else {
    if($_SESSION['env'] === 'Localhost')  {
      $query = "SELECT a.id AS appt_id, a.user_id, a.session_id, a.appt_time, a.status AS appt_status, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.status AS user_status, s.name AS session_name, s.status AS session_status, r.id AS review_id, r.notes
      FROM appointments a
      INNER JOIN users u ON u.id = a.user_id
      INNER JOIN sessions s ON s.id = a.session_id
      LEFT JOIN reviews r ON r.appointment_id = a.id
      WHERE u.active = 1
      AND u.id = :id
      ORDER BY a.appt_time;
      ";
    } else {
      $query = "SELECT a.id AS appt_id, a.user_id, a.session_id, a.appt_time, a.status AS appt_status, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.status AS user_status, s.name AS session_name, s.status AS session_status, r.id AS review_id, r.notes
      FROM appointments a
      INNER JOIN users u ON u.id = a.user_id
      INNER JOIN sessions s ON s.id = a.session_id
      LEFT JOIN reviews r ON r.appointment_id = a.id
      WHERE u.active
      AND u.id = :id
      ORDER BY a.appt_time;
      ";
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  }

  $stmt->execute();

  $result = $stmt->fetchAll();
  $stmt->closeCursor();

  return $result;
}


/**
 *    Format Appointment information into table
 *      param $results array
 */
function formatAppointments($results, $status) {
  $appointments = '';
  $readonly = ($status !== 'admin') ? "readonly" : "";

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
        <td colspan='3'><textarea $readonly name='note_$appt[review_id]' cols='75' rows='10'>$appt[notes]</textarea></td>
      </tr>
      <tr>
        <th colspan='1'></th>";

      if($status == 'admin')  {
        $appointments .= "
        <td colspan='1'><button type='submit' name='UpdateBtn' value='$appt[review_id]'>Update</button></td>
        <td></td>";
      } else {
        $appointments .= "
        <td></td><td></td>";
      }

      $appointments .= "
        <td colspan='1'><button type='submit' name='DeleteBtn' value='$appt[appt_id]'>Delete Appt</button></td>";

      $appointments .= "<tr></table>";
  }

  return $appointments;
}


/**
 *    CREATE appointment
 *      param $
 */
function createAppointments($user_id, $session_id, $appt_time, $notes = null) {
  $pdo = connector();

  if($_SESSION['env'] === 'Localhost')  {
    $query = "INSERT INTO appointments (user_id, session_id, appt_time, status) VALUES (:user_id, :session_id, :appt_time, 'requested')";
  } else {
    $query = "INSERT INTO appointments (user_id, session_id, appt_time, status, created_at, updated_at) VALUES (:user_id, :session_id, :appt_time, 'requested', NOW(), NOW())";
  }

  $stmt = $pdo->prepare($query);

  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindValue(':session_id', $session_id, PDO::PARAM_INT);
  $stmt->bindValue(':appt_time', $appt_time, PDO::PARAM_STR);

  $stmt->execute();

  $appointment_id = $pdo->lastInsertId();
  return $appointment_id;
  $result = $stmt->rowCount();
  $stmt->closeCursor();

  // $reviewResult = createReview($appointment_id, $notes);

  return $result;
}


function createReview($appointment_id, $notes = null) {
  $pdo = connector();

  if($_SESSION['env'] === 'Localhost')  {
    $query = "INSERT INTO reviews (appointment_id, notes) 
    VALUES (:appointment_id, :notes)";
  } else {
    $query = "INSERT INTO reviews (appointment_id, notes, created_at, updated_at) 
    VALUES (:appointment_id, :notes, NOW(), NOW())";
  }

  $stmt = $pdo->prepare($query);

  $stmt->bindValue(':appointment_id', $appointment_id, PDO::PARAM_INT);
  $stmt->bindValue(':notes', $notes, PDO::PARAM_STR);

  $stmt->execute();

  $result = $stmt->rowCount();
  $stmt->closeCursor();

  return $result;
}



/**
 *    UPDATE appointment notes
 *      param $review_id
 */
function updateAppointments($review_id, $note) {
  $pdo = connector();

  if($_SESSION['env'] === 'Localhost')  {
    $query = "UPDATE reviews r SET r.notes = :note WHERE r.id = :review_id";
  } else {
    $query = 'UPDATE "reviews" AS r SET "notes" = :note WHERE r.id = :review_id';
  }

  $stmt = $pdo->prepare($query);

  $stmt->bindValue(':review_id', $review_id, PDO::PARAM_INT);
  $stmt->bindValue(':note', $note, PDO::PARAM_STR);

  $stmt->execute();

  $result = $stmt->rowCount();
  $stmt->closeCursor();

  return $result;
}


/**
 *    DELETE appointment notes
 *      param $review_id
 */
function deleteAppointments($id) {
  $pdo = connector();

  if($_SESSION['env'] === 'Localhost')  {
    $query = "DELETE FROM appointments WHERE id = :id";
  } else {
    $query = 'DELETE FROM "appointments" WHERE id = :id';
  }

  $stmt = $pdo->prepare($query);

  $stmt->bindValue(':id', $id, PDO::PARAM_INT);

  $stmt->execute();

  $result = $stmt->rowCount();
  $stmt->closeCursor();

  return $result;
}

/**
 *    Generate buttons for user
 *      param $status
 */
function generateNav($status)  {
  $userNav = '<div class="user-nav">';

  $userNav .= '<div class="btn-div nav-btn">';
  $userNav .= '<a href="/controllers/project1/?action=createAppt" alt="Create Appointment">';
  $userNav .= '<div class="">Create Appointment</div>';
  $userNav .= '</a></div>';

  if($status === 'admin') {
    $userNav .= '<div class="btn-div nav-btn">';
    $userNav .= '<a href="/controllers/project1/?action=adminAppt" alt="Admin Appointment">';
    $userNav .= '<div class="">Admin Appointment</div>';
    $userNav .= '</a></div>';
  }

  // $userNav .= '';
  $userNav .= '</div>';

  return $userNav;
}


/**
 *    Get Users for Admin create appointment
 */
function getUsers() {
  $pdo = connector();

  if($_SESSION['env'] === 'Localhost')  {
    $query = "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS full_name, 
    u.status AS user_status 
    FROM users u 
    WHERE u.active = 1 
    AND u.status != 'admin'";
  } else {
    $query = "SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS full_name, 
    u.status AS user_status 
    FROM users u 
    WHERE u.active
    AND u.status != 'admin'";
  }

  $stmt = $pdo->prepare($query);

  // $stmt->bindValue(':id', $id, PDO::PARAM_INT);

  $stmt->execute();

  $result = $stmt->fetchAll();
  $stmt->closeCursor();

  return $result;
}


/**
 *    Get Sessions for Admin create appointment
 */
function getSessions() {
  $pdo = connector();

  if($_SESSION['env'] === 'Localhost')  {
    $query = "SELECT s.id, s.name
    FROM sessions s
    WHERE s.status = 'active'";
  } else {
    $query = "SELECT s.id, s.name
    FROM sessions s
    WHERE s.status = 'active'";
  }

  $stmt = $pdo->prepare($query);

  // $stmt->bindValue(':id', $id, PDO::PARAM_INT);

  $stmt->execute();

  $result = $stmt->fetchAll();
  $stmt->closeCursor();

  return $result;
}


/**
 *    Format Users for drop-down
 */
function formatUsers($users)  {
  $dropDown = '<label class="label" for="usersList">Users</label><br>';

  $dropDown .= '<select name="usersList" id="usersList">';
  $dropDown .= "<option selected disabled>Select User</option>";

  foreach($users AS $user) {
    $dropDown .= "<option value='$user[id]'>$user[full_name]</option>";
  }

  $dropDown .= '</select>';

  return $dropDown;
}


/**
 *    Format Sessions for drop-down
 */
function formatSessions($sessions)  {
  $dropDown = '<label class="label" for="sessionsList">Session</label><br>';

  $dropDown .= '<select name="sessionsList" id="sessionsList">';
  $dropDown .= "<option selected disabled>Select Session</option>";

  foreach($sessions AS $session) {
    $dropDown .= "<option value='$session[id]'>$session[name]</option>";
  }

  $dropDown .= '</select>';

  return $dropDown;
}