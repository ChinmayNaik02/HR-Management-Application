<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details - HR Management System</title>
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
        
        .employee-info {
            text-align: left;
            margin-bottom: 20px;
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
            margin-right: 10px;
            display: flex;
            align-items: center;
        }
        
        .button:hover {
            background-color: #45a049;
        }
        .form-buttons{
            display: flex;     
            flex-direction: row;
            align-items: center;
            justify-content:center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Employee Details</h1>
        <?php
        try {
            $url = "mysql:host=localhost;dbname=employee";
            $username = "root";
            $password = "@VKcentury100";

            $fullName = $_GET["fullName"];

            $conn = new PDO($url, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM employee WHERE FullName = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fullName]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo "<div class='employee-info'>";
                echo "<p><strong>Employee ID:</strong> " . $row["EmployeeID"] . "</p>";
                echo "<p><strong>Full Name:</strong> " . $row["FullName"] . "</p>";
                echo "<p><strong>Date of Birth:</strong> " . $row["DateOfBirth"] . "</p>";
                echo "<p><strong>Gender:</strong> " . $row["Gender"] . "</p>";
                echo "<p><strong>Email:</strong> " . $row["Email"] . "</p>";
                echo "<p><strong>Department:</strong> " . $row["Department"] . "</p>";
                echo "<p><strong>Job Title:</strong> " . $row["JobTitle"] . "</p>";
                echo "<p><strong>Salary:</strong> " . $row["Salary"] . "</p>";
                echo "</div>";

                echo "<div class ='form-buttons'>";
                echo "<form action='editEmployee.php' method='GET'>";
                echo "<input type='hidden' name='employeeID' value='" . $row["EmployeeID"] . "'>";
                echo "<button type='submit' class='button'>Edit Employee</button>";
                echo "</form>";
                echo "</div>";
            } else {
                echo "<p>Employee not found.</p>";
            }

            // Close connection
            $conn = null;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
