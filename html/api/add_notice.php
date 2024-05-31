<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$title = $conn->real_escape_string($_POST['title']);
$content = $conn->real_escape_string($_POST['content']);
$user_no = $conn->real_escape_string($_POST['user_no']);
$type_no = $conn->real_escape_string($_POST['type']);

$target_dir = "/var/www/html/uploads/";  // 절대 경로
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$file_uploaded = false;
$file_url = "";

if (!empty($_FILES["file"]["name"])) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $file_uploaded = true;
        $file_url = "uploads/" . basename($_FILES["file"]["name"]);  // 상대 경로
    } else {
        error_log("File upload failed: " . $_FILES["file"]["error"]);
        echo json_encode(["success" => false, "error" => "File upload failed"]);
        exit;
    }
}

$sql = "INSERT INTO NOTICE (notice_title, notice_content, notice_date, user_no, type_no, notice_file_path) 
        VALUES ('$title', '$content', NOW(), '$user_no', '$type_no', '$file_url')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
