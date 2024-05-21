<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$data = json_decode(file_get_contents("php://input"), true);
$notice_no = $conn->real_escape_string($data['notice_no']);

$sql = "DELETE FROM NOTICE WHERE notice_no = '$notice_no'";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
