<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payroll Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
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

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Payroll Information</h2>
        <?php
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

            $employeeId = -1;
            $salary = 0;

            try {
                $pdo = new PDO($dsn, $user, $pass, $options);

                $query = "SELECT EmployeeID, Salary FROM employee WHERE FullName = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$_POST["employeeName"]]);
                $result = $stmt->fetch();

                if ($result) {
                    $employeeId = $result["EmployeeID"];
                    $salary = $result["Salary"];
                }

                $stmt = null;
                $pdo = null;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
        <form action="savePayroll.php" method="post">
            <input type="hidden" name="employeeId" value="<?php echo $employeeId; ?>">
            <div class="form-group">
                <label for="baseSalary">Base Salary:</label>
                <input type="number" id="baseSalary" name="baseSalary" required value="<?php echo $salary; ?>">
            </div>
            <div class="form-group">
                <label for="overtimePay">Overtime Pay:</label>
                <input type="number" id="overtimePay" name="overtimePay" required>
            </div>
            <div class="form-group">
                <label for="bonus">Bonus:</label>
                <input type="number" id="bonus" name="bonus" required>
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
