<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$query = "SELECT * FROM USER";
$result = mysqli_query($conn, $query);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

echo json_encode($users);

mysqli_close($conn);
?>
