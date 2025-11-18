<?php

require_once 'config.php';

function init_session () {
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
}
function handleIsLogged () {
  init_session();

  if (!isset($_SESSION["username"])) {
    header("Location: ./../site/login.php");
    exit();
  }
}

function registerUser ($username, $password): string {

  init_session();

  $con = (new Database())->getConnection();
  $query = $con->prepare("INSERT INTO users (username, password) VALUES (?,?)");
  $query->bind_param ("ss", $username, $password);

  $check_username = $con->prepare('SELECT * FROM users WHERE username = ?');
  $check_username->bind_param('s', $username);
  
  if ($check_username->execute() && $check_username->get_result()->num_rows > 0) {
    return 'Tente outro nome de usuário!';
  }

  if ($query->execute()) {
    $_SESSION['username'] = $username;
    return '';
  }

  return 'Erro de consulta ou de conexão!';

}

function loginUser ($username, $password) {
 
  init_session();
 
  $db   = new Database();
  $conn = $db->getConnection();

  $query = $conn->prepare('SELECT username, password FROM users WHERE username = ? AND password = ?');
  $query->bind_param('ss', $username, $password);
  $execution_sucess = $query->execute();

  if (!$execution_sucess)
    return false;

  $result = $query->get_result();

  if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    return true;
  } else {
    return false;
  }
}

function getDoneTasks ($username) {
  $conn = (new Database())->getConnection();
  $query = $conn->prepare('SELECT tasks.id, tasks.name, tasks.description, tasks.status from tasks
  INNER JOIN users ON (SELECT id FROM users WHERE username = ?) = tasks.user_id
    WHERE tasks.status = "DONE" ');
  $query->bind_param('s', $username);
  if ($query->execute()) {
    $result = $query->get_result();
    return $result->num_rows;
  } else {
    return 0;
  }
}

function getUndoneTasks ($username) {
  $conn = (new Database())->getConnection();
  $query = $conn->prepare('SELECT tasks.id, tasks.name, tasks.description, tasks.status from tasks
  INNER JOIN users ON (SELECT id FROM users WHERE username = ?) = tasks.user_id
    WHERE tasks.status = "UNDONE" ');
  $query->bind_param('s', $username);
  if ($query->execute()) {
    $result = $query->get_result();
    return $result->num_rows;
  } else {
    return 0;
  }
}

function getTotalTasks ($username) {
  $conn = (new Database())->getConnection();
  $query = $conn->prepare('SELECT tasks.id, tasks.name, tasks.description, tasks.status from tasks
  INNER JOIN users ON (SELECT id FROM users WHERE username = ?) = tasks.user_id;');
  $query->bind_param('s', $username);
  if ($query->execute()) {
    $result = $query->get_result();
    return $result->num_rows;
  } else {
    return 0;
  }
}


?>