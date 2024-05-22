<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$user_no = $_GET['user_no'];

if ($user_no) {
    $query = "DELETE FROM USER WHERE user_no = '$user_no'";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => '회원 삭제 실패']);
    }
} else {
    echo json_encode(['success' => false, 'message' => '잘못된 회원 번호']);
}

mysqli_close($conn);
?>
