<?php
    $host = 'localhost';
    $db = 'employee';
    $user = 'root';
    $pass = '@VKcentury100';
    
    $baseSalary = 0;
    $overtimePay = 0;
    $bonus = 0;
    
    $employeeId = $_GET['employeeId'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM payroll WHERE employee_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$employeeId]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $baseSalary = $row['base_salary'];
            $overtimePay = $row['overtime_pay'];
            $bonus = $row['bonus'];
        }

        $stmt = null;
        $pdo = null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payroll</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 50%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #005500;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Payroll</h2>
        <form action="saveEditPayroll.php" method="post">
            <div class="form-group">
                <label for="baseSalary">Base Salary:</label>
                <input type="number" id="baseSalary" name="baseSalary" value="<?php echo $baseSalary; ?>" required>
            </div>
            <div class="form-group">
                <label for="overtimePay">Overtime Pay:</label>
                <input type="number" id="overtimePay" name="overtimePay" value="<?php echo $overtimePay; ?>" required>
            </div>
            <div class="form-group">
                <label for="bonus">Bonus:</label>
                <input type="number" id="bonus" name="bonus" value="<?php echo $bonus; ?>" required>
            </div>
            <input type="hidden" name="employeeId" value="<?php echo $employeeId; ?>">
            <input type="submit" value="Save Changes" class="button">
        </form>
    </div>
</body>
</html>
