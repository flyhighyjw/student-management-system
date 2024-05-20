<?php
include '../dbconn.php';
header('Content-Type: application/json');

$id = $_POST["username"];
$pw = $_POST["password"];

$sql = "SELECT * FROM USER WHERE user_id = '$id' AND user_pw = '$pw'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

if ($result->num_rows > 0) {
    setcookie('userid', $id, time() + 86400, "/");
    header("location: ../user_index.html");
} else {
    echo "<script>
            alert('아이디 또는 비밀번호가 잘못되었습니다.');
            window.location.href = '../login.html';
          </script>";
}
?>