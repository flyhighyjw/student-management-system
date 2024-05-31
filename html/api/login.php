<?php
include '../dbconn.php';
header('Content-Type: application/json');

$id = $_POST["username"];
$pw = md5($_POST["password"]); // MD5 암호화

$sql = "SELECT * FROM USER WHERE user_id = '$id' AND user_pw = '$pw'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

$response = array();

if ($result->num_rows > 0) {
    setcookie('userid', $id, time() + 86400, "/");
    $response['success'] = true;
    $response['message'] = '로그인 성공';
} else {
    $response['success'] = false;
    $response['message'] = '아이디 또는 비밀번호가 잘못되었습니다.';
}

echo json_encode($response);
$conn->close();
?>
