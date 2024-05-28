<?php
    $employeeId = $_POST["employeeId"];
    $baseSalary = $_POST["baseSalary"];
    $overtimePay = $_POST["overtimePay"];
    $bonus = $_POST["bonus"];
    
    $totalSalary = $baseSalary + $overtimePay + $bonus;

    $host = 'localhost';
    $db = 'employee';
    $user = 'root';
    $pass = '@VKcentury100';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO payroll (employee_id, base_salary, overtime_pay, bonus, total_salary) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$employeeId, $baseSalary, $overtimePay, $bonus, $totalSalary]);

        $stmt = null;
        $pdo = null;

        header("Location: payroll.html");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>