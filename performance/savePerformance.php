<?php
    $employeeId = $_POST["employeeId"];
    $qualityOfWork = $_POST["qualityOfWork"];
    $punctuality = $_POST["punctuality"];
    $reliability = $_POST["reliability"];
    $communication = $_POST["communication"];
    $performance = ($qualityOfWork + $punctuality + $reliability + $communication) / 4.0;

    $DB_HOST = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "@VKcentury100";
    $DB_NAME = "employee";

    try {
        $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO employee_performance (employee_id, quality_of_work, punctuality, reliability, comunication, performance) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$employeeId, $qualityOfWork, $punctuality, $reliability, $communication, $performance]);

        header("Location: performance.html");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
?>
