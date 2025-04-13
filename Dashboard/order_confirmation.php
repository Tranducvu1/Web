<?php
require_once 'config.php';

// Start session
session_start();

// Check if order_id is provided
if (!isset($_GET['order_id'])) {
    header('Location: sanpham.php');
    exit;
}

$order_id = $_GET['order_id'];

// Get order details
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->execute([$order_id]);
$order = $stmt->fetch();

if (!$order) {
    header('Location: sanpham.php');
    exit;
}

// Get order items
$stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt->execute([$order_id]);
$orderItems = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <link href="bootstrap.min.css" rel="stylesheet" />
    <script src="bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="sp.css" rel="stylesheet">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Đặt hàng thành công!</h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>
                    
                    <h4 class="mb-3">Thông tin đơn hàng #<?php echo $order_id; ?></h4>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Họ và tên:</strong> <?php echo htmlspecialchars($order['customer_name']); ?></p>
                            <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($order['customer_phone']); ?></p>
                            <p><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($order['customer_address']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Phương thức thanh toán:</strong> 
                                <?php 
                                    switch($order['payment_method']) {
                                        case 'cash':
                                            echo 'Thanh toán khi nhận hàng (COD)';
                                            break;
                                        case 'bank':
                                            echo 'Chuyển khoản ngân hàng';
                                            break;
                                        case 'momo':
                                            echo 'Ví MoMo';
                                            break;
                                        default:
                                            echo htmlspecialchars($order['payment_method']);
                                    }
                                ?>
                            </p>
                            <p><strong>Ngày đặt hàng:</strong> <?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></p>
                            <p><strong>Trạng thái:</strong> <span class="badge bg-warning">Đang xử lý</span></p>
                        </div>
                    </div>
                    
                    <h5 class="mb-3">Chi tiết đơn hàng</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Đơn giá</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderItems as $item): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                        <td class="text-center"><?php echo $item['quantity']; ?></td>
                                        <td class="text-end">$<?php echo number_format($item['product_price'], 2); ?></td>
                                        <td class="text-end">$<?php echo number_format($item['product_price'] * $item['quantity'], 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Tổng cộng:</th>
                                    <th class="text-end">$<?php echo number_format($order['total_amount'], 2); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <?php if ($order['payment_method'] == 'bank'): ?>
                        <div class="alert alert-info mt-3">
                            <h5>Thông tin chuyển khoản:</h5>
                            <p>Vui lòng chuyển khoản theo thông tin sau:</p>
                            <ul>
                                <li>Số tài khoản: <strong>123456789</strong></li>
                                <li>Ngân hàng: <strong>VietcomBank</strong></li>
                                <li>Chủ tài khoản: <strong>DORA PET SHOP</strong></li>
                                <li>Nội dung chuyển khoản: <strong>DH<?php echo $order_id; ?></strong></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <div class="text-center mt-4">
                        <a href="sanpham.php" class="btn btn-primary">
                            <i class="fas fa-shopping-cart"></i> Tiếp tục mua sắm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>