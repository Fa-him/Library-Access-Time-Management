<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_id'])) {
    $student_id = intval($_POST['student_id']);
    $current_time = date("Y-m-d H:i:s");
    $current_date = date("Y-m-d");

   
    $check_sql = "SELECT log_id, entry_time FROM access_logs WHERE student_id = ? AND date = ? AND exit_time IS NULL ORDER BY entry_time DESC LIMIT 1";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("is", $student_id, $current_date);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        
        $stmt->bind_result($log_id, $entry_time);
        $stmt->fetch();
        $duration_seconds = strtotime($current_time) - strtotime($entry_time);
        $duration = gmdate("H:i:s", $duration_seconds);

        $update_sql = "UPDATE access_logs SET exit_time = ?, duration = ? WHERE log_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssi", $current_time, $duration, $log_id);

        if ($update_stmt->execute()) {
            echo "<div class='exit-success'>Exit time recorded. Duration: $duration</div>";
        } else {
            echo "<div class='error'>Error recording exit time.</div>";
        }
        $update_stmt->close();
    } else {
        // FS
        $insert_sql = "INSERT INTO access_logs (student_id, entry_time, date) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iss", $student_id, $current_time, $current_date);

        if ($insert_stmt->execute()) {
            echo "<div class='success'>Entry time recorded successfully.</div>";
        } else {
            echo "<div class='error'>Error recording entry time.</div>";
        }
        $insert_stmt->close();
    }

    $stmt->close();
}

$conn->close();
?>
