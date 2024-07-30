<?php
header('Content-Type: application/json');
include 'dbconfig.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!$conn) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . mysqli_connect_error()]);
    exit;
}

$sql = "SELECT * FROM licenses";
$result = $conn->query($sql);

$licenses = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $licenses[] = $row;
    }
}

echo json_encode(["success" => true, "licenses" => $licenses]);

$conn->close();
?>
