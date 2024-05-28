<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Performance</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .edit-btn {
            background-color: #007700;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .edit-btn:hover {
            background-color: #005500;
        }
    </style>
</head>
<body>
    <h1>Employee Performance Records</h1>
    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Quality of Work</th>
                <th>Punctuality</th>
                <th>Reliability</th>
                <th>Communication</th>
                <th>Performance</th>
                <th>Edit Performance</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $DB_HOST = "localhost";
                $DB_USER = "root";
                $DB_PASSWORD = "@VKcentury100";
                $DB_NAME = "employee";

                try {
                    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASSWORD);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $pdo->query("SELECT * FROM employee_performance");

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['employee_id'] . "</td>";
                        echo "<td>" . $row['quality_of_work'] . "</td>";
                        echo "<td>" . $row['punctuality'] . "</td>";
                        echo "<td>" . $row['reliability'] . "</td>";
                        echo "<td>" . $row['comunication'] . "</td>";
                        echo "<td>" . $row['performance'] . "</td>";
                        echo "<td>";
                        echo "<form action=\"editPerformance.php\" method=\"post\">";
                        echo "<input type=\"hidden\" name=\"employeeId\" value=\"" . $row['employee_id'] . "\">";
                        echo "<input type=\"submit\" value=\"Edit\" class=\"edit-btn\">";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }

                    $stmt = null;
                    $pdo = null;
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            ?>
        </tbody>
    </table>
</body>
</html>
