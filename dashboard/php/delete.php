<?php
header('Content-Type: application/json');
include 'dbconfig.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();

if (!$conn) {
    ob_end_clean();
    echo json_encode(["success" => false, "message" => "Database connection failed: " . mysqli_connect_error()]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $deleteVars);
    $id = $deleteVars['id'];

    if ($id) {
        $sql = "DELETE FROM licenses WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            ob_end_clean();
            echo json_encode(["success" => true, "message" => "License deleted successfully"]);
        } else {
            ob_end_clean();
            echo json_encode(["success" => false, "message" => "No license found with the given ID"]);
        }

        $stmt->close();
    } else {
        ob_end_clean();
        echo json_encode(["success" => false, "message" => "No ID provided"]);
    }
} else {
    ob_end_clean();
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}

$conn->close();
?>
