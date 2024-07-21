<?php
$servername = "connection2024.php";
$username = "ShadowedWard11";
$password = "pdge2015MF";
$dbname = "student-demo-registration-db";
$port = "3306";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}