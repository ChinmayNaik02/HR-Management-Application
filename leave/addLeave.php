<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 500px;
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
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .successMessage {
            color: #4CAF50;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        textarea {
            height: 100px;
            resize: vertical;
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
            text-decoration: none;
        }
       
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Leave Request Form</h1>
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true') { ?>
            <p class="successMessage">Employee data added successfully!</p>
        <?php } ?>
        <form action="insertLeave.php" method="post">
            <div class="form-group">
                <label for="employee-name">Employee Name:</label>
                <input type="text" id="employee-name" name="employee-name" required>
            </div>
            
            <div class="form-group">
                <label for="leave-type">Leave Type:</label>
                <select id="leave-type" name="leave-type" required>
                    <option value="">Select Leave Type</option>
                    <option value="Annual Leave">Annual Leave</option>
                    <option value="Sick Leave">Sick Leave</option>
                    <option value="Maternity/Paternity Leave">Maternity/Paternity Leave</option>
                    <option value="Unpaid Leave">Unpaid Leave</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="start-date">Start Date:</label>
                <input type="date" id="start-date" name="start-date" required>
            </div>
            
            <div class="form-group">
                <label for="end-date">End Date:</label>
                <input type="date" id="end-date" name="end-date" required>
            </div>
            
            <div class="form-group">
                <label for="reason">Reason/Comments:</label>
                <textarea id="reason" name="reason" required></textarea>
            </div>
            
            <div class="button-container">
                <button type="submit" class="button">Submit Request</button>
            </div>
        </form>
    </div>
</body>
</html>
