<?php
include 'dbconfig.php';

$sql = "
    DROP TABLE IF EXISTS licenses;
    CREATE TABLE licenses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        `key` VARCHAR(255) UNIQUE NOT NULL,
        expire_date VARCHAR(10),
        owner VARCHAR(255) NOT NULL,
        discord VARCHAR(255) NOT NULL,
        product VARCHAR(255) NOT NULL,
        allowed_ips VARCHAR(255) NOT NULL,
        allowed_ports VARCHAR(255) NOT NULL,
        creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
";

if ($conn->multi_query($sql) === TRUE) {
    echo "Setup completed successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
