<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$sql = "SELECT n.notice_no, n.notice_title, u.user_name as author, n.notice_date, n.notice_content
        FROM NOTICE n 
        JOIN USER u ON n.user_no = u.user_no 
        ORDER BY n.notice_date DESC";
$result = $conn->query($sql);

$notices = array();
while($row = $result->fetch_assoc()) {
    $notices[] = $row;
}

echo json_encode($notices);

$conn->close();
?>
