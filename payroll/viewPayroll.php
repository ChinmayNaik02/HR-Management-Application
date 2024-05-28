<?php
    $host = 'localhost';
    $db = 'employee';
    $user = 'root';
    $pass = '@VKcentury100';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM payroll";
        $stmt = $pdo->query($query);

        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>View/Edit Payroll</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    min-height: 100vh;
                }

                .container {
                    width: 80%;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }

                h2 {
                    text-align: center;
                    margin-bottom: 20px;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                th, td {
                    padding: 10px;
                    border-bottom: 1px solid #ddd;
                    text-align: left;
                }

                th {
                    background-color: #f2f2f2;
                }

                td {
                    background-color: #fff;
                }

                .button {
                    display: inline-block;
                    padding: 8px 16px;
                    background-color: #4CAF50;
                    color: #fff;
                    border: none;
                    border-radius: 4px;
                    text-decoration: none;
                    font-size: 14px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }

                .button:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Payroll Details</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Base Salary</th>
                            <th>Overtime Pay</th>
                            <th>Bonus</th>
                            <th>Total Salary</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['employee_id'] . '</td>';
            echo '<td>' . $row['base_salary'] . '</td>';
            echo '<td>' . $row['overtime_pay'] . '</td>';
            echo '<td>' . $row['bonus'] . '</td>';
            echo '<td>' . $row['total_salary'] . '</td>';
            echo '<td><a href="editPayroll.php?employeeId=' . $row['employee_id'] . '" class="button">Edit</a></td>';
            echo '</tr>';
        }

        echo '</tbody>
            </table>
        </div>
        </body>
        </html>';

        $stmt = null;
        $pdo = null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>
