<?php

/**
 *    Validate login credentials
 *      param user email
 *      param user password
 * 
 *    return full_name, password, status
 */
function validateUser($username, $password) {
  $pdo = connector();

  if($_SESSION['env'] === 'Localhost')  {
    $query = "SELECT u.id, u.password, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.status FROM users u WHERE u.username = :username AND u.active = 1 LIMIT 1";
  } else {
    $query = "SELECT u.id, u.password, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.status FROM users u WHERE u.username = :username AND u.active LIMIT 1";
  }
  $stmt = $pdo->prepare($query);

  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->execute();

  $result = $stmt->fetch();
  $stmt->closeCursor();

  return ($result['password'] === $password) ? $result : false;
  // return ($result['password'] === hashIt($password)) ? $result : false;
}


/**
 *    Validate Email credentials
 *      param user email
 *      param user password
 * 
 *    return full_name, password, status
 */
function validateEmail($email, $password) {
  $pdo = connector();

  if($_SESSION['env'] === 'Localhost')  {
    $query = "SELECT u.password, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.status FROM users u WHERE u.email = :email AND u.active = 1 LIMIT 1";
  } else {
    $query = "SELECT u.password, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.status FROM users u WHERE u.email = :email AND u.active LIMIT 1";
  }
  $stmt = $pdo->prepare($query);

  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();

  $result = $stmt->fetch();
  $stmt->closeCursor();

  return ($result['password'] === $password) ? $result : false;
  // return ($result['password'] === hashIt($password)) ? $result : false;
}

function register($first_name, $last_name, $username, $email, $password)  {
  $pdo = connector();

  // $hashedPassword = hashIt($password);
  $hashedPassword = $password;

  if($_SESSION['env'] === 'Localhost')  {
    $query = "INSERT INTO users (first_name, last_name, username, password, email, status, active) 
    VALUES (:first_name, :last_name, :username, :hashedPassword, :email, 'guest', 1)";
  } else {
    $query = "INSERT INTO users (first_name, last_name, username, password, email, status) 
    VALUES (:first_name, :last_name, :username, :hashedPassword, :email, 'guest', 1)";
  }
  $stmt = $pdo->prepare($query);

  $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
  $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':hashedPassword', $hashedPassword, PDO::PARAM_STR);

  $stmt->execute();

  $result = $stmt->rowCount();
  $stmt->closeCursor();

  return $result;

}

function hashIt($toHash) {
  return password_hash($toHash, PASSWORD_DEFAULT);
}

function verify_hashIt($toCheck)  {
  return password_verify($toCheck, PASSWORD_DEFAULT);
}