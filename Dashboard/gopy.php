<?php 
require_once '../Config/config.php'; // Đảm bảo file config này khai báo biến $conn kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hovaten = $_POST['hovaten'] ?? '';
    $email = $_POST['email'] ?? '';
    $tieude = $_POST['tieude'] ?? '';
    $noidung = $_POST['noidung'] ?? '';

    if (!empty($hovaten) && !empty($email) && !empty($tieude) && !empty($noidung)) {
        $sql = "INSERT INTO gopy (hovaten, email, tieude, noidung, created_at) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $hovaten, $email, $tieude, $noidung);

        if ($stmt->execute()) {
            echo "<script>alert('Góp ý của bạn đã được gửi thành công!');</script>";
        } else {
            echo "<script>alert('Đã xảy ra lỗi. Vui lòng thử lại sau.');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Góp ý</title>
    <link href="../src/styles/bootstrap.min.css" rel="stylesheet" />
    <script src="bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <?php include 'Header/header.php'; ?>

    <div class="content" style="padding-top: 40px;">
        <h3 style="text-align: center; font-family: 'Montserrat', sans-serif; color: rgba(16, 172, 94, 0.707);">
            <b>Gửi góp ý</b>
        </h3>
        <form method="post" style="width: 100%; margin: 0 auto;">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="hovaten" name="hovaten" placeholder="Họ và tên">
                <label for="hovaten">Họ và tên</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="tieude" name="tieude" placeholder="Tiêu đề">
                <label for="tieude">Tiêu đề</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" id="noidung" name="noidung" style="height: 200px; resize: none;" placeholder="Nội dung"></textarea>
                <label for="noidung">Nội dung</label>
            </div>
            <div class="row mt-2">
                <button type="submit" id="btnContact" class="m-auto btn">Gửi Tin Nhắn</button>
            </div>
        </form>
    </div>

    <?php include 'Footer/footer.php'; ?>
</body>

</html>
