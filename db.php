<?php
require 'loadEnv.php';

loadEnv(__DIR__ . '/.env');

// Now, you can access the variables
$servername = $_ENV['DB_HOST'];
$dbUsername = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASS'];
$dbName = $_ENV['DB_NAME'];

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
