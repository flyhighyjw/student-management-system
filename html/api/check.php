<?php
include '../dbconn.php';

header('Content-Type: application/json');

$type = $_GET['type'];
$value = $_GET['value'];

// type 값에 따라 SQL 쿼리 생성
switch ($type) {
    case 'userid':
        $query = "SELECT COUNT(*) AS count FROM USER WHERE user_id = '$value'";
        break;
    default:
        echo json_encode(["available" => false, "message" => "Invalid type"]);
        $conn->close();
        exit;
}

$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    echo json_encode(["available" => false]);
} else {
    echo json_encode(["available" => true]);
}

$conn->close();
?>
