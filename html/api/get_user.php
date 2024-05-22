<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$user_no = $_GET['user_no'];

if ($user_no) {
    $query = "SELECT * FROM USER WHERE user_no = '$user_no'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid user number']);
}

mysqli_close($conn);
?>
