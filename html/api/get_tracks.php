<?php
header("Content-Type: application/json; charset=UTF-8");
include '../dbconn.php';

$query = "SELECT * FROM TRACK";
$result = mysqli_query($conn, $query);

$tracks = [];
while ($row = mysqli_fetch_assoc($result)) {
    $tracks[] = $row;
}

echo json_encode($tracks);

mysqli_close($conn);
?>
