<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$data = json_decode(file_get_contents('php://input'), true);

$user_no = $data['user_no'];
$user_name = $data['user_name'];
$user_id = $data['user_id'];
$user_phone = $data['user_phone'];
$is_admin = $data['is_admin'];
$track_no = $data['track_no'];

if ($user_no && $user_name && $user_id && $user_phone && isset($is_admin) && $track_no) {
    $query = "UPDATE USER SET 
                user_name = '$user_name', 
                user_id = '$user_id', 
                user_phone = '$user_phone', 
                is_admin = '$is_admin', 
                track_no = '$track_no' 
              WHERE user_no = '$user_no'";

    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Update failed']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
}

mysqli_close($conn);
?>
