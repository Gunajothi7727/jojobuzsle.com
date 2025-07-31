<?php
$host = "localhost";
$user = "root";
$password = "";   // Leave empty if using XAMPP
$database = "users";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
