<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$response = array('success' => false);

// 쿠키에서 사용자 ID 가져오기
if (!isset($_COOKIE['userid'])) {
    $response['message'] = "User not logged in.";
    echo json_encode($response);
    exit();
}

$user_id = $_COOKIE['userid'];

// 입력된 데이터 받기
$data = json_decode(file_get_contents('php://input'), true);
$userid = $data['userid'];

if ($userid !== $user_id) {
    $response['message'] = "잘못된 요청입니다.";
    echo json_encode($response);
    exit();
}

// 사용자 계정 삭제
$delete_sql = "DELETE FROM USER WHERE user_id = '$userid'";
if ($conn->query($delete_sql) === TRUE) {
    $response['success'] = true;
    $response['message'] = "회원 탈퇴가 완료되었습니다.";
} else {
    $response['message'] = "회원 탈퇴에 실패했습니다.";
}

$conn->close();

echo json_encode($response);
?>
