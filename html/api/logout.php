<?php
header('Content-Type: application/json');

// 쿠키 삭제
setcookie('userid', '', time() - 3600, '/');
header("Location: /index.html");
?>
