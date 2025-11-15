<?php

require_once("./../../includes/config.php");
require_once("./../../includes/functions.php");

init_session();

header('Content-Type: application/json');

$username = $_SESSION['username'];
$conn = (new Database())->getConnection();
$query = $conn->prepare('SELECT tasks.id, tasks.name, tasks.description, tasks.status from tasks
INNER JOIN users ON (SELECT id FROM users WHERE username = ?) = tasks.user_id;');
$query->bind_param('s', $username); 


$execution_success = $query->execute();
if (!$execution_success) {
  echo json_encode([
    'success' => false,
    'message' => 'Erro de conexão ou consulta ao banco de dados.'
  ]);
  exit();
}

$tasks = $query->get_result()->fetch_all(MYSQLI_ASSOC);

echo json_encode([
  'success' => true,
  'data'=> $tasks
]);

?>