<?php

require_once "./../../includes/config.php";

$task_id = $_GET["task_id"];
$task_status = $_GET["task_status"];

$conn = (new Database())->getConnection();
$conn->query("UPDATE tasks SET status = \"$task_status\" WHERE id = $task_id");

?>