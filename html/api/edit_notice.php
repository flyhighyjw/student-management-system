<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

if (empty($_POST['notice_no']) || empty($_POST['title']) || empty($_POST['content']) || empty($_POST['type'])) {
    echo json_encode(["success" => false, "error" => "Required fields are missing"]);
    exit;
}

$notice_no = $conn->real_escape_string($_POST['notice_no']);
$title = $conn->real_escape_string($_POST['title']);
$content = $conn->real_escape_string($_POST['content']);
$type_no = $conn->real_escape_string($_POST['type']);

$target_dir = "/var/www/html/uploads/";  // 절대 경로
$file_url = "";

if (!empty($_FILES["file"]["name"])) {
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $file_url = "uploads/" . basename($_FILES["file"]["name"]);  // 상대 경로
    } else {
        echo json_encode(["success" => false, "error" => "File upload failed"]);
        exit;
    }
}

$sql = "UPDATE NOTICE SET 
            notice_title = '$title', 
            notice_content = '$content', 
            notice_date = NOW()";
if (!empty($file_url)) {
    $sql .= ", notice_file_path = '$file_url'";
}
$sql .= " WHERE notice_no = $notice_no AND type_no = $type_no";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$conn->close();
?>
