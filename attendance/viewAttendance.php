<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Attendance Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
            border-radius: 8px; /* Add border radius */
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #4CAF50;
        }
        
        tr:hover {
            background-color: #f2f2f2;
        }
        
        td:first-child {
            font-weight: bold;
        }
        
        td:nth-child(odd) {
            background-color: #fff;
        }
        
        td:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .container {
            max-width: 1200px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 0 auto; 
            background-color: #f0f0f0;
            padding: 20px;
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
            margin-right : 10px;     
        }
        
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>All Attendance Records</h1>
    <div class="container">
        <table>
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Date</th>
                <th>Clock In Time</th>
                <th>Clock Out Time</th>
            </tr>
            
            <?php
            $host = "localhost";
            $username = "root";
            $password = "@VKcentury100";
            $database = "employee";

            try {
                $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT e.EmployeeID, a.employeeName, a.clockInTime, a.clockOutTime, a.date FROM attendance a INNER JOIN employee e ON a.employeeName = e.FullName";
                $stmt = $conn->query($sql);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['EmployeeID'] . "</td>";
                    echo "<td>" . $row['employeeName'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['clockInTime'] . "</td>";
                    echo "<td>" . $row['clockOutTime'] . "</td>";
                    echo "</tr>";
                }

                $conn = null;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </table>
        <a href="attendance.html" class="button">Back to Attendance Management</a>
        <a href="../login/dashboard.html" class="button">Go to Dashboard</a>
    </div>
</body>
</html>
