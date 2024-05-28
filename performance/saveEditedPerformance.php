<?php
    $employeeId = $_POST["employeeId"];
    $qualityOfWork = $_POST["qualityOfWork"];
    $punctuality = $_POST["punctuality"];
    $reliability = $_POST["reliability"];
    $communication = $_POST["communication"];

    $DB_HOST = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "@VKcentury100";
    $DB_NAME = "employee";

    try {
        $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "UPDATE employee_performance SET quality_of_work=?, punctuality=?, reliability=?, comunication=? WHERE employee_id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$qualityOfWork, $punctuality, $reliability, $communication, $employeeId]);
        $rowsAffected = $stmt->rowCount();

        $stmt = null;
        $pdo = null;

        header("Location: performance.html");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>