<?php
include '../dbconn.php';

$comment_no = $_GET['comment_no'];

if ($comment_no) {
    $query = "DELETE FROM COMMENT WHERE comment_no = '$comment_no'";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => '댓글 삭제 실패']);
    }
} else {
    echo json_encode(['success' => false, 'message' => '잘못된 댓글 번호']);
}

mysqli_close($conn);
?>
