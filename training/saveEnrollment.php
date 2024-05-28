<!DOCTYPE html>
<html>
<head>
    <title>Enroll Employee</title>
</head>
<body>
    <?php 
    $employeeName = $_REQUEST["employeeName"];
    $eventId = $_REQUEST["eventId"];

    $DB_HOST = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "@VKcentury100";
    $DB_NAME = "employee";

    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT EmployeeID FROM employee WHERE FullName = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $employeeName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $employeeId = $row["EmployeeID"];

        $query = "INSERT INTO employee_enrollment (employee_id, event_id) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $employeeId, $eventId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: training.html");
            exit();
        } else {
            echo "<h2>Failed to enroll employee.</h2>";
        }
    } else {
        echo "<h2>Employee not found.</h2>";
    }

    $stmt->close();
    $conn->close();
    ?>
</body>
</html>