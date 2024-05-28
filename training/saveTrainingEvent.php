<?php
$eventName = $_POST["eventName"];
$eventDate = $_POST["eventDate"];
$eventDescription = $_POST["eventDescription"];

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWORD = '@VKcentury100';
$DB_NAME = 'employee';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO training_events (event_name, event_date, event_description) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $eventName, $eventDate, $eventDescription);

if ($stmt->execute() === TRUE) {
    header("Location: training.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
