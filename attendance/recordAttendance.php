<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Record Attendance</title>
</head>
<body>
    <?php
        $employeeName = $_POST["employeeName"];
        $date = $_POST["date"];
        $clockInTime = $_POST["clockInTime"];
        $clockOutTime = $_POST["clockOutTime"];

        $host = "localhost";
        $username = "root";
        $password = "@VKcentury100";
        $database = "employee";

        try {
            $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO attendance (employeeName, date, clockInTime, clockOutTime) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$employeeName, $date, $clockInTime, $clockOutTime]);
            
            $rowsAffected = $stmt->rowCount();

            if ($rowsAffected > 0) {
                echo "<p>Attendance recorded successfully.</p>";
            } else {
                echo "<p>Failed to record attendance.</p>";
            }
            
            $conn = null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>
</body>
</html>
