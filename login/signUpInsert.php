<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "@VKcentury100";
$dbName = "user";

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    header("Location: signUp.php?success=Registration Successful");
} else {
    header("Location: signUp.php?success=Registration Failed");
}

$stmt->close();
$conn->close();
?>
