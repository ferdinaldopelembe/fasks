<?php

require_once("./../../includes/config.php");
require_once("./../../includes/functions.php");

init_session();

$username = $_SESSION["username"];
$data = json_decode(file_get_contents("php://input"), true);

$task_name = $data['task_name']; 
$task_description = $data['task_description'];

$conn = (new Database())->getConnection();
$query= $conn->prepare("INSERT INTO tasks(user_id, name, description, status)
VALUES ((SELECT id FROM users WHERE username = \"$username\"), \"$task_name\", \"$task_description\", \"UNDONE\")");

$query->execute();

?>