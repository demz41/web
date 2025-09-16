<?php
session_start();

$conn = new mysqli("SERVER_NAME", "USERNAME", "PASSWORD", "DATABASE_NAME");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    echo "✅ Connected successfully!";
}
?>
