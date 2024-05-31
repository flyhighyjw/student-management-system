<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$qna_no = $_GET['qna_no'];

if ($qna_no) {
    // 댓글 삭제 쿼리
    $delete_comments_query = "DELETE FROM COMMENT WHERE qna_no = '$qna_no'";
    if (mysqli_query($conn, $delete_comments_query)) {
        // QNA 삭제 쿼리
        $delete_qna_query = "DELETE FROM QNA WHERE qna_no = '$qna_no'";
        if (mysqli_query($conn, $delete_qna_query)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Q&A 삭제 실패']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => '댓글 삭제 실패']);
    }
} else {
    echo json_encode(['success' => false, 'message' => '잘못된 Q&A 번호']);
}

mysqli_close($conn);
?>
