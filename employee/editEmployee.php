<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee - HR Management System</title>
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
        
        .form-group {
            margin-bottom: 20px;
        }
        
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        
        .button-container {
            text-align: center;
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
        }
        
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
        // Retrieve employee ID from query parameter
        $id = $_GET["employeeID"];

        // Database connection details
        $host = "localhost";
        $username = "root";
        $password = "@VKcentury100";
        $database = "employee";

        try {
            // Establish database connection
            $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare SQL statement to retrieve employee record by ID
            $stmt = $conn->prepare("SELECT * FROM employee WHERE EmployeeID = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Fetch employee record
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Display the employee details form for editing
            if ($row) {
    ?>
    <div class="container">
        <h1>Edit Employee Details</h1>
        <form action="updateEmployee.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['EmployeeID']; ?>">
            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" value="<?php echo $row['FullName']; ?>">
            </div>
            <div class="form-group">
                <label for="dateOfBirth">Date of Birth:</label>
                <input type="date" id="dateOfBirth" name="dateOfBirth" value="<?php echo $row['DateOfBirth']; ?>">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="Male" <?php if ($row['Gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($row['Gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($row['Gender'] == 'Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $row['Email']; ?>">
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" value="<?php echo $row['Department']; ?>">
            </div>
            <div class="form-group">
                <label for="jobTitle">Job Title:</label>
                <input type="text" id="jobTitle" name="jobTitle" value="<?php echo $row['JobTitle']; ?>">
            </div>
            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="text" id="salary" name="salary" value="<?php echo $row['Salary']; ?>">
            </div>
            <div class="button-container">
                <button type="submit" class="button">Save Changes</button>
            </div>
        </form>
    </div>
    <?php
            } else {
                echo "<p>Employee record not found.</p>";
            }

            // Close the database connection
            $conn = null;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>
</body>
</html>
