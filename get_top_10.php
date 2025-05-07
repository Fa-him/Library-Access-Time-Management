<?php
// Include the database connection
include('db_connection.php');

// Query to get top 10 students by total duration_minutes with name, id, department, batch
$query = "SELECT s.student_id, s.name, s.department, s.batch, SUM(a.duration_minutes) AS total_duration
          FROM students s
          JOIN access_logs a ON s.student_id = a.student_id
          GROUP BY s.student_id, s.name, s.department, s.batch
          ORDER BY total_duration DESC
          LIMIT 10";

$result = mysqli_query($conn, $query);

if ($result) {
    echo "<h3>Top 10 Students by Duration</h3>";
    echo "<table>
            <tr>
                <th>SL No</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Batch</th>
                <th>Total Duration (Minutes)</th>
            </tr>";

    $sl = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $sl++ . "</td>
                <td>" . htmlspecialchars($row['student_id']) . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['department']) . "</td>
                <td>" . htmlspecialchars($row['batch']) . "</td>
                <td>" . htmlspecialchars($row['total_duration']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Error fetching data: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
