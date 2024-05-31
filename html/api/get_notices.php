<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

// 검색어 가져오기
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// SQL 쿼리 작성 - notice_title에서 검색어를 기준으로 검색
$sql = "SELECT n.notice_no, n.notice_title, u.user_name as author, n.notice_date, n.notice_content
        FROM NOTICE n 
        JOIN USER u ON n.user_no = u.user_no";

if (!empty($searchTerm)) {
    $sql .= " WHERE n.notice_title LIKE '%$searchTerm%'";
}

$sql .= " ORDER BY n.notice_date DESC";
$result = $conn->query($sql);

$notices = array();
while($row = $result->fetch_assoc()) {
    $notices[] = $row;
}

echo json_encode($notices);

$conn->close();
?>
