<?php
$servername = "plk2.pein-gbr.de";
$username = "zylox1xx_XYZ";
$password = "5lmt0P_865lmt0P_86";
$dbname = "zylox1xx_XYZ";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>