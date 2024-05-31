<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

// Request data 읽기
$data = json_decode(file_get_contents("php://input"), true);

// QNA IDs 검증
if (!isset($data['ids']) || !is_array($data['ids']) || empty($data['ids'])) {
    echo json_encode(["success" => false, "error" => "Invalid QNA IDs"]);
    exit;
}

$ids = $data['ids'];

// ID들을 쉼표로 구분된 문자열로 변환
$ids_str = implode(',', array_map('intval', $ids));

// QNA 삭제 쿼리
$sql = "DELETE FROM QNA WHERE qna_no IN ($ids_str)";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
