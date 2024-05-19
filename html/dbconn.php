<?php
    $host = "3.38.92.245";
    $user = "4dmin";
    $pw = "P455w0rd";
    $db = "5T4R";
    
    $connect = new mysqli($host, $user, $pw, $db);

    if ($connect->connect_error) {
    die("연결 실패: " . $connect->connect_error);
    }
    echo "연결 성공";
?>
