<!DOCTYPE html>
<html>
<head>
    <title>View/Edit Training Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007700;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
            text-align: left;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>View/Edit Training Events</h2>
        <table>
            <thead>
                <tr>
                    <th>Event Id</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Event Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $DB_HOST = 'localhost';
                $DB_USER = 'root';
                $DB_PASSWORD = '@VKcentury100';
                $DB_NAME = 'employee';

                $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM training_events";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $eventId = $row["event_id"];
                        $eventName = $row["event_name"];
                        $eventDate = $row["event_date"];
                        $eventDescription = $row["event_description"];
                ?>
                <tr>
                    <td><?php echo $eventId; ?></td>
                    <td><?php echo $eventName; ?></td>
                    <td><?php echo $eventDate; ?></td>
                    <td><?php echo $eventDescription; ?></td>
                    <td>
                        <a href="displayEnrolled.php?eventName=<?php echo $eventName; ?>" class="button">View Enrolled</a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>