<?php
    $host = "3.38.107.212";
    $user = "4dmin";
    $pw = "P455w0rd";
    $db = "5T4R";
    
    $conn = new mysqli($host, $user, $pw, $db);

    if ($conn->conn_error) {
    die("연결 실패: " . $conn->conn_error);
    }
?>
