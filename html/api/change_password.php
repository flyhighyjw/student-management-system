<?php
include '../dbconn.php';

// 쿠키에서 사용자 ID 가져오기
if (!isset($_COOKIE['userid'])) {
    echo "<script>alert('User not logged in.'); window.location.href = 'login.html';</script>";
    exit();
}

$user_id = $_COOKIE['userid'];

// 입력된 데이터 받기
$new_password = $_POST['new-password'];
$confirm_password = $_POST['confirm-password'];

if ($new_password !== $confirm_password) {
    echo "<script>alert('비밀번호가 일치하지 않습니다.'); window.history.back();</script>";
    exit();
}

// 비밀번호 업데이트
$update_sql = "UPDATE USER SET user_pw = '$new_password' WHERE user_id = '$user_id'";
if ($conn->query($update_sql) === TRUE) {
    echo "<script>alert('비밀번호 변경 완료'); window.location.href = '../mypage.html';</script>";
} else {
    echo "<script>alert('비밀번호 변경 실패'); window.history.back();</script>";
}

$conn->close();
?>
