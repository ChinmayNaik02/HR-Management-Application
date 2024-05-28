<?php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWORD = '@VKcentury100';
$DB_NAME = 'employee';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$eventName = $_GET["eventName"];

$queryEventId = "SELECT event_id FROM training_events WHERE event_name = ?";
$stmt = $conn->prepare($queryEventId);
$stmt->bind_param("s", $eventName);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$eventId = $row["event_id"];
$stmt->close();

$queryEnrolledEmployees = "SELECT e.employee_id, u.FullName FROM employee_enrollment e INNER JOIN employee u ON e.employee_id = u.EmployeeID WHERE e.event_id = ?";
$stmt = $conn->prepare($queryEnrolledEmployees);
$stmt->bind_param("i", $eventId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enrolled Employees</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
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
            margin-top: 20px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Enrolled Employees</h2>
        <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["employee_id"] . "</td>";
                    echo "<td>" . $row["FullName"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>