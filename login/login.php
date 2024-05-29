<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASSWORD = "@VKcentury100";
$DB_NAME = "user";

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: dashboard.html");
    exit();
} else {
    header("Location: index.php?error=true");
    exit();
}

$stmt->close();
$conn->close();
?>
