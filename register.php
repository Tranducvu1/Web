<?php
require_once 'Config/config.php';
require_once 'Admin/Function/function.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    // Kiểm tra email hợp lệ
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email không hợp lệ!";
        header("Location: register.php");
        exit();
    }
    
    // Kiểm tra mật khẩu trùng khớp
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Mật khẩu không khớp!";
        header("Location: register.php");
        exit();
    }
    
    // Kiểm tra xem email hoặc username đã tồn tại chưa
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Email hoặc tên người dùng đã tồn tại!";
        header("Location: register.php");
        exit();
    }
    $stmt->close();
    
    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Lưu vào database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Đăng ký thành công! Hãy đăng nhập.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Lỗi: " . $stmt->error;
        header("Location: register.php");
        exit();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>DORA - Đăng ký</title>
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/logo.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/logo.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
</head>
<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.php">
                    <img src="vendors/images/logo.png" alt="" />
                </a>
            </div>
        </div>
    </div>
    <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="vendors/images/register-page-img.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="register-box bg-white box-shadow border-radius-10">
                        <div class="wizard-content">
                            <form class="tab-wizard2 wizard-circle wizard" method="post" action="register.php">
                                <div class="form-wrap max-width-600 mx-auto">
                                    <?php
                                    if (isset($_SESSION['error'])) {
                                        echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
                                        unset($_SESSION['error']);
                                    }
                                    if (isset($_SESSION['success'])) {
                                        echo "<p style='color:green;'>" . $_SESSION['success'] . "</p>";
                                        unset($_SESSION['success']);
                                    }
                                    ?>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Email Address</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" name="email" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Username</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="username" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="password" required />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Confirm Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="confirm_password" required />
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
</body>
</html>
