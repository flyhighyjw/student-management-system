<?php
include '../dbconn.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

// 사용자가 입력한 값
$userid = $data['userid'];
$password = $data['password'];
$username = $data['username'];
$phone = $data['phone'];
$track_no = $data['track']; // 트랙 번호를 직접 받음

// 사용자 등록
$query = "INSERT INTO USER (user_id, user_pw, user_name, user_phone, track_no) VALUES ('$userid', '$password', '$username', '$phone', $track_no)";
if ($conn->query($query) === TRUE) {
    $response = [
        "message" => "회원가입이 완료되었습니다.",
    ];
    echo json_encode($response);
} else {
    echo json_encode(["message" => "Database Error", "error" => $conn->error]);
}

$conn->close();
?>
