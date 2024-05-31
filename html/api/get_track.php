<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

// 쿠키에서 사용자 ID를 가져옵니다.
$user_id = isset($_COOKIE['userid']) ? $_COOKIE['userid'] : null;

if ($user_id) {
    // 사용자 정보와 트랙 정보를 조인하여 가져오는 SQL 쿼리
    $sql = "SELECT u.user_no, u.user_name, u.track_no, t.track_name 
            FROM USER u 
            JOIN TRACK t ON u.track_no = t.track_no 
            WHERE u.user_id = '$user_id'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user_info = $result->fetch_assoc();
        echo json_encode($user_info); // 여기서 JSON 데이터를 반환합니다.
    } else {
        echo json_encode(array("message" => "사용자를 찾을 수 없습니다."));
    }
} else {
    echo json_encode(array("message" => "사용자 ID가 제공되지 않았습니다."));
}

$conn->close();
?>
