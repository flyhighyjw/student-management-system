<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$data = json_decode(file_get_contents('php://input'), true);

$title = $data['title'];
$content = $data['content'];
$user_id = $data['user_id'];

// 유저 ID로 유저 번호 가져오기
$user_sql = "SELECT user_no FROM USER WHERE user_id = '$user_id'";
$user_result = $conn->query($user_sql);

if ($user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $user_no = $user_row['user_no'];

    // QNA 추가 쿼리
    $qna_sql = "INSERT INTO QNA (qna_title, qna_content, qna_date, user_no) VALUES ('$title', '$content', NOW(), $user_no)";
    
    if ($conn->query($qna_sql) === TRUE) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "error" => $conn->error));
    }
} else {
    echo json_encode(array("success" => false, "error" => "Invalid user ID"));
}

$conn->close();
?>
