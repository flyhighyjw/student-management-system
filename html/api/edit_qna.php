<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);
$qna_no = $data['qna_no']; 
$title = $data['title']; 
$content = $data['content']; 

if ($qna_no && $title && $content) {
    $sql = "UPDATE QNA SET qna_title = '$title', qna_content = '$content' WHERE qna_no = '$qna_no'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Q&A 수정 실패: " . $conn->error]);
    }
} else {
    echo json_encode(["success" => false, "message" => "잘못된 입력 데이터"]);
}

$conn->close();
?>
