<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "dorashop"; 

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra lỗi
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thiết lập charset UTF-8 để tránh lỗi font tiếng Việt
$conn->set_charset("utf8");

// Hàm kết nối để tái sử dụng
function connect() {
    global $servername, $username, $password, $database;
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Lỗi kết nối DB: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
    return $conn;
}
?>
