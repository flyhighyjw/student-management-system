<?php
header('Content-Type: application/json');

// 쿠키 삭제
setcookie('userid', '', time() - 3600, "/");

echo json_encode(["message" => "로그아웃 성공"]);
?>
