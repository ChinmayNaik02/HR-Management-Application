<?php
    $employeeId = $_POST["employeeId"];
    $baseSalary = $_POST["baseSalary"];
    $overtimePay = $_POST["overtimePay"];
    $bonus = $_POST["bonus"];
    
    $totalSalary = $baseSalary + $overtimePay + $bonus;

    $DB_HOST = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "@VKcentury100";
    $DB_NAME = "employee";

    try {
        $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("UPDATE payroll SET base_salary = ?, overtime_pay = ?, bonus = ?, total_salary = ? WHERE employee_id = ?");
        $stmt->execute([$baseSalary, $overtimePay, $bonus, $totalSalary, $employeeId]);
        
        $stmt2 = $pdo->prepare("UPDATE employee SET Salary = ? WHERE EmployeeID = ?");
        $stmt2->execute([$baseSalary, $employeeId]);

        header("Location: payroll.html");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>