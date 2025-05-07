<?php

include('db_connection.php');

$currentMonth = date('Y-m');

$query = "SELECT s.student_id, s.name, s.department, s.batch, 
                 a.entry_time, a.exit_time, a.duration_minutes
          FROM access_logs a
          JOIN students s ON a.student_id = s.student_id
          WHERE DATE_FORMAT(a.date, '%Y-%m') = '$currentMonth'
          ORDER BY a.entry_time";

$result = mysqli_query($conn, $query);

if ($result) {
    echo "<h3>All Access Logs for the Current Month</h3>";
    echo "<table>
            <tr>
                <th>SL No</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Batch</th>
                <th>Entry Time</th>
                <th>Exit Time</th>
                <th>Duration (Minutes)</th>
            </tr>";

    $sl_no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $sl_no++ . "</td>
                <td>" . htmlspecialchars($row['student_id']) . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['department']) . "</td>
                <td>" . htmlspecialchars($row['batch']) . "</td>
                <td>" . htmlspecialchars($row['entry_time']) . "</td>
                <td>" . htmlspecialchars($row['exit_time']) . "</td>
                <td>" . htmlspecialchars($row['duration_minutes']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Error fetching data: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
