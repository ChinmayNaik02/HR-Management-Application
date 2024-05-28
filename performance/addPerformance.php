<?php
    // Retrieve employee name from the form
    $employeeName = $_POST["employeeName"];

    // Database connection parameters
    $DB_HOST = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "@VKcentury100";
    $DB_NAME = "employee";

    $employeeId = -1;

    try {
        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Search for employee ID using employee name
        $stmt = $pdo->prepare("SELECT EmployeeID FROM employee WHERE FullName = ?");
        $stmt->execute([$employeeName]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Employee found, get the employee ID
            $employeeId = $result["EmployeeID"];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Performance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #000; /* Black text */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #000; /* Black text */
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #000; /* Black text */
        }

        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Performance</h1>
        <form action="savePerformance.php" method="post">
            <input type="hidden" name="employeeId" value="<?php echo $employeeId; ?>">
            <label for="qualityOfWork">Quality of Work:</label>
            <input type="number" id="qualityOfWork" name="qualityOfWork" min="1" max="10" required><br>
            <label for="punctuality">Punctuality:</label>
            <input type="number" id="punctuality" name="punctuality" min="1" max="10" required><br>
            <label for="reliability">Reliability:</label>
            <input type="number" id="reliability" name="reliability" min="1" max="10" required><br>
            <label for="communication">Communication:</label>
            <input type="number" id="communication" name="communication" min="1" max="10" required><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>