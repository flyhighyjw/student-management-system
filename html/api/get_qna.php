<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$qna_no = intval($_GET['qna_no']);

// QNA 세부 정보를 가져오는 쿼리
$qna_sql = "SELECT Q.qna_no, Q.qna_title, Q.qna_content, Q.qna_date, U.user_name, U.user_id
            FROM QNA Q
            JOIN USER U ON Q.user_no = U.user_no
            WHERE Q.qna_no = $qna_no";

$qna_result = $conn->query($qna_sql);

if ($qna_result->num_rows > 0) {
    $qna_data = $qna_result->fetch_assoc();
    echo json_encode($qna_data);
} else {
    echo json_encode(array("error" => "QNA not found"));
}

$conn->close();
?>
