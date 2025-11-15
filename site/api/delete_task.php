<?php

require_once("./../../includes/config.php");
require_once("./../../includes/functions.php");

init_session();

$task_id = $_GET["task_id"];
$username = $_SESSION["username"];

$conn = (new Database())->getConnection();
$query = $conn->prepare("DELETE FROM tasks WHERE user_id = (SELECT id FROM users WHERE username = \"$username\") AND tasks.id = $task_id");
$query->execute();

?>