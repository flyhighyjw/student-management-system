<?php
include '../dbconn.php';

$data = json_decode(file_get_contents('php://input'), true);

$comment_no = $data['comment_no'];
$comment_content = $data['comment_content'];

if ($comment_no && $comment_content) {
    $query = "UPDATE COMMENT SET comment_content = '$comment_content', comment_date = NOW() WHERE comment_no = '$comment_no'";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => '댓글 수정 실패']);
    }
} else {
    echo json_encode(['success' => false, 'message' => '잘못된 데이터']);
}

mysqli_close($conn);
?>
