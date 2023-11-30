<?php
ini_set('display_errors', '0');

$servername = "localhost";
$username = "root";
$password = "";
$database = "db_nt3102";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}