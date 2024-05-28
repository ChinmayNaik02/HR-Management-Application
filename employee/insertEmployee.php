<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $jobTitle = $_POST['jobTitle'];
    $salary = $_POST['salary'];

    $DB_HOST = "localhost";
    $DB_USER = "root";
    $DB_PASSWORD = "@VKcentury100";
    $DB_NAME = "employee";

    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO employee (FullName, DateOfBirth, Gender, Email, Department, JobTitle, Salary) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssss", $fullName, $dateOfBirth, $gender, $email, $department, $jobTitle, $salary);

        if ($stmt->execute()) {
            header("Location: addEmployee.php?success=true");
        } else {
            header("Location: addEmployee.php?error=true");
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: add_employee.php");
    exit();
}
?>
