<?php

header('Content-Type: application/json');
require_once("./../../includes/functions.php");

init_session();

$username = $_SESSION["username"];
$total_tasks = getTotalTasks($username);
$done_tasks  = getDoneTasks($username);
$undone_tasks= getUndoneTasks($username);

echo json_encode([
  "total_tasks"=> $total_tasks,
  "done_tasks"=> $done_tasks,
  "undone_tasks"=> $undone_tasks
]);

?>