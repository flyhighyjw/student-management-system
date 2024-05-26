<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$notice_no = $conn->real_escape_string($_GET['notice_no']);

$sql = "SELECT n.notice_title, n.notice_content, n.notice_file_path, n.notice_date, u.user_name as author
        FROM NOTICE n
        JOIN USER u ON n.user_no = u.user_no
        WHERE n.notice_no = '$notice_no'
        ORDER BY n.notice_date DESC";
$result = $conn->query($sql);

if ($result === false) {
    echo json_encode(["error" => "Query error: " . $conn->error]);
    $conn->close();
    exit();
}

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "Notice not found"]);
}

$conn->close();
?>
