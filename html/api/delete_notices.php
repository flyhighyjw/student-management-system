<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);
$ids = $data['ids'];

if (empty($ids) || !is_array($ids)) {
    echo json_encode(["success" => false, "error" => "Invalid notice IDs"]);
    exit;
}

// ID들을 쉼표로 구분된 문자열로 변환
$ids_str = implode(',', array_map('intval', $ids));

// Delete notices
$sql = "DELETE FROM NOTICE WHERE notice_no IN ($ids_str)";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
