<?php
header('Content-Type: application/json');
include 'dbconfig.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $key = $_POST['key'];
    $expire_date = $_POST['expire-date'];
    $owner = $_POST['owner'];
    $discord = $_POST['discord'];
    $product = $_POST['product'];
    $allowed_ips = $_POST['allowed-ips'];
    $allowed_ports = $_POST['allowed-ports'];

    if (!$conn) {
        echo json_encode(["success" => false, "message" => "Database connection failed: " . mysqli_connect_error()]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO licenses (`key`, expire_date, owner, discord, product, allowed_ips, allowed_ports) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        echo json_encode(["success" => false, "message" => "Prepare statement failed: " . $conn->error]);
        exit;
    }

    $bind = $stmt->bind_param("sssssss", $key, $expire_date, $owner, $discord, $product, $allowed_ips, $allowed_ports);
    if ($bind === false) {
        echo json_encode(["success" => false, "message" => "Bind parameters failed: " . $stmt->error]);
        exit;
    }

    $execute = $stmt->execute();
    if ($execute) {
        echo json_encode(["success" => true, "message" => "New license created successfully", "key" => $key]);
    } else {
        echo json_encode(["success" => false, "message" => "Execute statement failed: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
