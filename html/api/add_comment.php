<?php
include '../dbconn.php';

$data = json_decode(file_get_contents('php://input'), true);

$qna_no = $data['qna_no'];
$comment_content = $data['comment_content'];
$user_no = 1; // 세션 또는 다른 방법으로 가져온다고 가정합니다.

if ($qna_no && $comment_content) {
    $query = "INSERT INTO COMMENT (comment_content, qna_no, user_no, comment_date) VALUES ('$comment_content', '$qna_no', '$user_no', NOW())";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => '댓글 추가 실패']);
    }
} else {
    echo json_encode(['success' => false, 'message' => '잘못된 데이터']);
}

mysqli_close($conn);
?>
