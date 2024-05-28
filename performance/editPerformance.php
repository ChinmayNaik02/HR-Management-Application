<?php
    // Retrieve employee ID from the request parameter
    $employeeId = $_POST["employeeId"];

    // Initialize variables to store existing performance data
    $qualityOfWork = -1;
    $punctuality = -1;
    $reliability = -1;
    $communication = -1;
    
    $DB_HOST = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "@VKcentury100";
    $DB_NAME = "employee";

    try {
        $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM employee_performance WHERE employee_id = ?");
        $stmt->execute([$employeeId]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $qualityOfWork = $row["quality_of_work"];
            $punctuality = $row["punctuality"];
            $reliability = $row["reliability"];
            $communication = $row["comunication"];
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
    <title>Edit Performance</title>
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
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            color: #007700;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007700;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #005500;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Performance</h1>
        <form action="saveEditedPerformance.php" method="post">
            <input type="hidden" name="employeeId" value="<?php echo $employeeId; ?>">
            <label for="qualityOfWork">Quality of Work:</label>
            <input type="number" id="qualityOfWork" name="qualityOfWork" min="1" max="10" value="<?php echo $qualityOfWork; ?>" required><br>
            <label for="punctuality">Punctuality:</label>
            <input type="number" id="punctuality" name="punctuality" min="1" max="10" value="<?php echo $punctuality; ?>" required><br>
            <label for="reliability">Reliability:</label>
            <input type="number" id="reliability" name="reliability" min="1" max="10" value="<?php echo $reliability; ?>" required><br>
            <label for="communication">Communication:</label>
            <input type="number" id="communication" name="communication" min="1" max="10" value="<?php echo $communication; ?>" required><br>
            <input type="submit" value="Save Changes">
        </form>
    </div>
</body>
</html>