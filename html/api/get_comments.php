<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$qna_no = intval($_GET['qna_no']);

// 댓글을 가져오는 쿼리
$comment_sql = "SELECT C.comment_no, C.comment_content, C.comment_date, U.user_name, (U.user_no = C.user_no) AS is_comment_author
                FROM COMMENT C
                JOIN USER U ON C.user_no = U.user_no
                WHERE C.qna_no = $qna_no
                ORDER BY C.comment_date ASC";

$comment_result = $conn->query($comment_sql);

$comments = array();
if ($comment_result->num_rows > 0) {
    while($row = $comment_result->fetch_assoc()) {
        $comments[] = $row;
    }
}

echo json_encode($comments);

$conn->close();
?>