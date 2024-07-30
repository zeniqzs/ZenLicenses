<?php
require 'dbconfig.php';

$ip = $_GET['ip'];
$port = $_GET['port'];
$plugin = $_GET['plugin'];
$key = $_GET['key'];

$response = "INVALID";

$sql = "SELECT * FROM licenses WHERE `key` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $key);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Invalid key.";
    exit();
}

$license = $result->fetch_assoc();

$expire_date = $license['expire_date'];
$allowed_ips = $license['allowed_ips'];
$allowed_ports = $license['allowed_ports'];
$product = $license['product'];

if ($expire_date !== '*' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $expire_date)) {
    echo "Invalid expire date format. Use YYYY-MM-DD.";
    exit();
}

if ($expire_date !== '*' && strtotime($expire_date) < time()) {
    echo "License expired.";
    exit();
}

if ($allowed_ips !== '*' && strpos($allowed_ips, $ip) === false) {
    echo "Invalid IP address.";
    exit();
}

if ($allowed_ports !== '*' && strpos($allowed_ports, (string)$port) === false) {
    echo "Invalid port.";
    exit();
}

if ($product !== '*' && $product !== $plugin) {
    echo "Invalid product.";
    exit();
}

$response = "VALID;" . $license['id'] . ";" . $license['owner'] . ";" . $license['discord'] . ";" . $license['product'] . ";" . $license['expire_date'] . ";" . $license['creation_date'];
echo $response;
?>
