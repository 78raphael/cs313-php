<?php
/**
 *    Week 6 Model
 */

function validate($email, $password) {
  $pdo = connector();

  $stmt = $pdo->prepare("SELECT u.password FROM users u WHERE u.email = :email LIMIT 1");

  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();

  $result = $stmt->fetch();
  $stmt->closeCursor();

  $status = ($result['password'] === $password) ? true : false;

  return $status;
}