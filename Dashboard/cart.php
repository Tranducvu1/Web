<?php
require_once '../Config/config.php';
function getCartItems($user_name, $conn) {
    $sql = "SELECT c.id, p.name, p.image_url, c.quantity
            FROM cart_item c
            JOIN products p ON c.product_id = p.id
            WHERE c.user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    return $stmt->get_result();
}
$user_name = $_GET['user_name'] ?? '';
$items = [];
if (!empty($user_name)) {
    $items = getCartItems($user_name, $conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng</title>
    <link href="bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<?php include 'Header/header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center">Giỏ hàng của bạn</h2>

    <?php if (!empty($user_name) && $items->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $items->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><img src="../src/images/pet/petmini/<?= htmlspecialchars($row['image_url']) ?>" class="img-fluid" width="80" height="80" alt="Ảnh SP"></td>
                            <td><?= $row['quantity'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php elseif (!empty($user_name)): ?>
        <p class="alert alert-warning">Giỏ hàng của bạn đang trống.</p>
    <?php else: ?>
        <p class="alert alert-danger">Không tìm thấy thông tin người dùng.</p>
    <?php endif; ?>
</div>

<?php include 'Footer/footer.php'; ?>
</body>

<script>
// Lấy user_name từ localStorage và gửi tham số vào URL
document.addEventListener('DOMContentLoaded', () => {
    const user = localStorage.getItem('user_name');  // Lấy tên người dùng từ localStorage
    const urlParams = new URLSearchParams(window.location.search);

    // Nếu có user_name trong localStorage và chưa có trong URL, tự động redirect với tham số user_name
    if (user && !urlParams.has('user_name')) {
        window.location.href = `cart.php?user_name=${user}`;
    } else if (user) {
        // Nếu user_name đã có trong URL, gọi hàm PHP để xử lý giỏ hàng
        // (Không cần thêm gì ở đây nữa vì PHP sẽ xử lý nếu `user_name` có trong URL)
    }
});
</script>
</html>
