<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$sql = "SELECT q.qna_no, q.qna_title, u.user_name as author, q.qna_date, q.qna_content
        FROM QNA q 
        JOIN USER u ON q.user_no = u.user_no 
        ORDER BY q.qna_date DESC";
$result = $conn->query($sql);

$qnas = array();
while($row = $result->fetch_assoc()) {
    $qnas[] = $row;
}

echo json_encode($qnas);

$conn->close();
?>
