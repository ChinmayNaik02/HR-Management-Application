<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee - HR Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .container {
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        h1 {
            margin-bottom: 20px;
        }
        
        .message {
            margin-bottom: 20px;
            color: #008000;
        }
        
        .button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;     
        }
        
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Employee</h1>
        <?php
            $host = "localhost";
            $username = "root";
            $password = "@VKcentury100";
            $database = "employee";

            try {
                $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $fullName = $_POST["fullName"];
                $dateOfBirth = $_POST["dateOfBirth"];
                $gender = $_POST["gender"];
                $email = $_POST["email"];
                $department = $_POST["department"];
                $jobTitle = $_POST["jobTitle"];
                $salary = $_POST["salary"];
                $employeeID = $_POST["id"];

                $sql = "UPDATE employee SET FullName=?, DateOfBirth=?, Gender=?, Email=?, Department=?, JobTitle=?, Salary=? WHERE EmployeeID=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$fullName, $dateOfBirth, $gender, $email, $department, $jobTitle, $salary, $employeeID]);

                $rowsUpdated = $stmt->rowCount();

                if ($rowsUpdated > 0) {
                    echo "<p class='message'>Employee details updated successfully!</p>";
                } else {
                    echo "<p class='message'>Failed to update employee details.</p>";
                }

                $conn = null;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
        <a href="employee.html" class="button">Back to Employee Management</a>
        <a href="../login/dashboard.html" class="button">Go to Dashboard</a>
    </div>
</body>
</html>
