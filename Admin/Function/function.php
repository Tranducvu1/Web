<?php
require_once 'Config/config.php';
session_start();
// 🟢 Hàm đăng nhập
function loginUser($username, $password) {
    $conn = connect();
    $username = trim($username);
    $password = trim($password);
    if (empty($username) || empty($password)) {
        return "Vui lòng nhập tài khoản và mật khẩu!";
    }
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    if (!$data || !password_verify($password, $data['password'])) {
        return "Sai tài khoản hoặc mật khẩu!";
    }
    $_SESSION['admin'] = $data['username'];
    $_SESSION['admin_id'] = $data['id'];
    $_SESSION['admin_role'] = $data['role'];
    return true;
}
?>