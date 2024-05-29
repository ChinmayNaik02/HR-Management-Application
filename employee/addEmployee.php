<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee - HR Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .successMessage {
            color: #4CAF50;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        
        .button-container {
            text-align: center;
            margin-top: 20px;
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
            text-decoration: none;
        }
       
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Employee</h1>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true') { ?>
            <p class="successMessage">Employee data added successfully!</p>
        <?php } ?>
        <form action="insertEmployee.php" method="POST">
            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" required>
            </div>
            <div class="form-group">
                <label for="dateOfBirth">Date of Birth:</label>
                <input type="date" id="dateOfBirth" name="dateOfBirth">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" id="department" name="department">
            </div>
            <div class="form-group">
                <label for="jobTitle">Job Title:</label>
                <input type="text" id="jobTitle" name="jobTitle">
            </div>
            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="text" id="salary" name="salary">
            </div>
            <div class="button-container">
                <button type="submit" class="button">Submit</button>
                <a href="../login/dashboard.html" class="button">Dashboard</a>
                <a href="employee.html" class="button">Employee Management</a>
            </div>
        </form>
    </div>
</body>
</html>
