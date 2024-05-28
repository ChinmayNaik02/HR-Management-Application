<!DOCTYPE html>
<html>
<head>
    <title>HR Enrollment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #4CAF50;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
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
        <h2>Training Enrollment</h2>
        <form action="saveEnrollment.php" method="post">
            <label for="employeeName">Select Employee:</label>
            <select id="employeeName" name="employeeName" required>
                <option value="">Select an Employee</option>
                <?php
                $DB_HOST = "localhost";
                $DB_USER = "root";
                $DB_PASSWORD = "@VKcentury100";
                $DB_NAME = "employee";

                $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT FullName FROM employee";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["FullName"] . "'>" . $row["FullName"] . "</option>";
                    }
                }
                $conn->close();
                ?>
            </select>
            
            <label for="eventId">Select Event:</label>
            <select id="eventId" name="eventId" required>
                <option value="">Select an Event</option>
                <?php
                $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT event_id, event_name FROM training_events WHERE event_date >= CURDATE()";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["event_id"] . "'>" . $row["event_name"] . "</option>";
                    }
                }
                $conn->close();
                ?>
            </select>
            
            <input type="submit" value="Enroll Employee">
        </form>
    </div>
</body>
</html>