<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$servername = $data['dbHost'];
$username = $data['dbUser'];
$password = $data['dbPassword'];
$dbname = $data['dbName'];

$configContent = "<?php\n";
$configContent .= "\$servername = \"$servername\";\n";
$configContent .= "\$username = \"$username\";\n";
$configContent .= "\$password = \"$password\";\n";
$configContent .= "\$dbname = \"$dbname\";\n\n";
$configContent .= "\$conn = new mysqli(\$servername, \$username, \$password, \$dbname);\n\n";
$configContent .= "if (\$conn->connect_error) {\n";
$configContent .= "    die(\"Connection failed: \" . \$conn->connect_error);\n";
$configContent .= "}\n";
$configContent .= "?>";

if (file_put_contents('dbconfig.php', $configContent)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to write configuration file.']);
}
?>