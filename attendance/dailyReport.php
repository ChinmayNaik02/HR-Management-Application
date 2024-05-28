<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .attendance-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 15px;
            background-color: #f2f2f2;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .attribute {
            color: #555;
            font-weight: bold;
        }
        .value {
            color: #333;
        }
        .total-hours {
            background-color: #ffe8e8;
        }
        .late-arrivals, .early-arrivals {
            background-color: #fff8e8;
        }
        .overtime-hours {
            background-color: #e8f8ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daily Attendance Report</h1>

        <?php
            $dateParam = isset($_POST['date']) ? $_POST['date'] : null;
            $employeeNameParam = isset($_POST['employeeName']) ? $_POST['employeeName'] : null;

            $host = 'localhost';
            $db = 'employee';
            $user = 'root';
            $pass = '@VKcentury100';
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $lateArrivals = 0;
            $earlyDepartures = 0;
            $totalWorkingHours = 0;

            try {
                $pdo = new PDO($dsn, $user, $pass, $options);

                $sql = "SELECT clockInTime, clockOutTime FROM attendance WHERE date = ?";
                if ($employeeNameParam) {
                    $sql .= " AND employeeName = ?";
                }

                $stmt = $pdo->prepare($sql);
                if ($employeeNameParam) {
                    $stmt->execute([$dateParam, $employeeNameParam]);
                } else {
                    $stmt->execute([$dateParam]);
                }

                while ($row = $stmt->fetch()) {
                    $clockInTime = new DateTime($row['clockInTime']);
                    $clockOutTime = new DateTime($row['clockOutTime']);

                    $interval = $clockInTime->diff($clockOutTime);
                    $durationHours = $interval->h + $interval->i / 60;
                    $totalWorkingHours += $durationHours;

                    // Check for late arrival (clock in after 9:00 AM)
                    if ($clockInTime->format('H') > 9) {
                        $lateArrivals++;
                    }

                    // Check for early departure (clock out before 5:00 PM)
                    if ($clockOutTime->format('H') < 17) {
                        $earlyDepartures++;
                    }
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // Calculate overtime hours
            $overtimeHours = $totalWorkingHours - 8;
            if ($overtimeHours < 0) {
                $overtimeHours = 0;
            }
        ?>

        <?php if ($employeeNameParam): ?>
            <div class="attendance-item">
                <div class="attribute">Employee Name:</div>
                <div class="value"><?php echo htmlspecialchars($employeeNameParam); ?></div>
            </div>
        <?php endif; ?>
        <div class="attendance-item">
            <div class="attribute">Date:</div>
            <div class="value"><?php echo htmlspecialchars($dateParam); ?></div>
        </div>
        <div class="attendance-item total-hours">
            <div class="attribute">Total Working Hours:</div>
            <div class="value"><?php echo htmlspecialchars($totalWorkingHours); ?> hours</div>
        </div>
        <div class="attendance-item late-arrivals">
            <div class="attribute">Late Arrivals:</div>
            <div class="value"><?php echo htmlspecialchars($lateArrivals); ?></div>
        </div>
        <div class="attendance-item early-arrivals">
            <div class="attribute">Early Departures:</div>
            <div class="value"><?php echo htmlspecialchars($earlyDepartures); ?></div>
        </div>
        <div class="attendance-item overtime-hours">
            <div class="attribute">Overtime Hours:</div>
            <div class="value"><?php echo htmlspecialchars($overtimeHours); ?> hours</div>
        </div>
    </div>
</body>
</html>
