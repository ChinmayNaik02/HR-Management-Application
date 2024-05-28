<?php
$host = 'localhost';
$db = 'employee';
$username = 'root';
$password = '@VKcentury100';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT e.EmployeeID, l.employeeName, l.leaveType, l.startDate, l.endDate, l.reason 
            FROM leave_request l 
            INNER JOIN employee e ON l.employeeName = e.FullName";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $leaveRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Future Leave Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            max-width: 100%;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Future Leave Records</h1>

    <table>
        <tr>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Leave Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Reason</th>
        </tr>

        <?php if (!empty($leaveRecords)) { ?>
            <?php foreach ($leaveRecords as $record) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($record['EmployeeID']); ?></td>
                    <td><?php echo htmlspecialchars($record['employeeName']); ?></td>
                    <td><?php echo htmlspecialchars($record['leaveType']); ?></td>
                    <td><?php echo htmlspecialchars($record['startDate']); ?></td>
                    <td><?php echo htmlspecialchars($record['endDate']); ?></td>
                    <td><?php echo htmlspecialchars($record['reason']); ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="6">No future leave records found.</td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>