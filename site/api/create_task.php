<?php

require_once("./../../includes/config.php");
require_once("./../../includes/functions.php");

init_session();

$username = $_SESSION["username"];
$task_name = $_GET["task_name"]; 
$task_description = $_GET["task_description"];

$conn = (new Database())->getConnection();
$query= $conn->prepare("INSERT INTO tasks(user_id, name, description, status)
VALUES ((SELECT id FROM users WHERE username = \"$username\"), \"$task_name\", \"$task_description\", \"UNDONE\")");

$query->execute();

?>