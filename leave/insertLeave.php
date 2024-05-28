<?php
$employeeName = $_POST['employee-name'];
$leaveType = $_POST['leave-type'];
$startDate = $_POST['start-date'];
$endDate = $_POST['end-date'];
$reason = $_POST['reason'];

$host = 'localhost';
$db = 'employee';
$username = 'root';
$password = '@VKcentury100';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO leave_request (employeeName, leaveType, startDate, endDate, reason) VALUES (:employeeName, :leaveType, :startDate, :endDate, :reason)");

    $stmt->bindParam(':employeeName', $employeeName);
    $stmt->bindParam(':leaveType', $leaveType);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->bindParam(':reason', $reason);

    $stmt->execute();

    header("Location: addLeave.php?success=true");
    exit;
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
