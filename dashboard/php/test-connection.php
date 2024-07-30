<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$servername = $data['dbHost'];
$username = $data['dbUser'];
$password = $data['dbPassword'];
$dbname = $data['dbName'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => $conn->connect_error]);
} else {
    echo json_encode(['success' => true]);
}

$conn->close();
?>
