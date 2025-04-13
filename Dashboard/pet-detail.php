<?php 
session_start();
require_once '../Config/config.php';

// Kiểm tra xem có tham số id không
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: trangchu.php');
    exit;
}

$pet_id = (int)$_GET['id'];

// Truy vấn thông tin chi tiết của thú cưng theo ID
$sql = "SELECT * FROM pet WHERE id = ? AND status = 'available'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $pet_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: trangchu.php');
    exit;
}

$pet = $result->fetch_assoc();

// Truy vấn thêm các thú cưng tương tự
$similar_sql = "SELECT id, petname, image_path 
               FROM pet 
               WHERE id != ? 
               AND (breed_name = ? OR gender = ?) 
               AND status = 'available' 
               LIMIT 4";
$similar_stmt = $conn->prepare($similar_sql);
$similar_stmt->bind_param("iss", $pet_id, $pet['breed_name'], $pet['gender']);
$similar_stmt->execute();
$similar_result = $similar_stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pet['petname']) ?> - Chi tiết thú cưng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
    <?php include 'Header/header.php'; ?>
    
    <div class="container pet-detail-container">
        <a href="trangchju.php" class="back-button">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách
        </a>
        
        <div class="row" data-aos="fade-up" data-aos-duration="1000">
            <!-- Hình ảnh thú cưng -->
            <div class="col-md-6 mb-4">
                <img src="../src/images/pet/petmini/<?= htmlspecialchars($pet['image_path']) ?>" 
                     alt="<?= htmlspecialchars($pet['petname']) ?>" 
                     class="pet-image-large">
            </div>
            
            <!-- Thông tin chi tiết -->
            <div class="col-md-6">
                <div class="pet-details">
                    <h1 class="pet-name"><?= htmlspecialchars($pet['petname']) ?></h1>
                    
                    <div class="detail-info">
                        <span class="detail-label">Giống:</span>
                        <?= htmlspecialchars($pet['breed_name'] ?? 'Không xác định') ?>
                    </div>
                    
                    <div class="detail-info">
                        <span class="detail-label">Tuổi:</span>
                        <?= htmlspecialchars($pet['age']) ?>
                    </div>
                    
                    <div class="detail-info">
                        <span class="detail-label">Giới tính:</span>
                        <?= $pet['gender'] == 'Male' ? 'Đực' : 'Cái' ?>
                    </div>
                    
                    <div class="detail-info">
                        <span class="detail-label">Cân nặng:</span>
                        <?= htmlspecialchars($pet['weight'] ?? 'Chưa cập nhật') ?> kg
                    </div>
                    
                    <div class="detail-info">
                        <span class="detail-label">Màu sắc:</span>
                        <?= htmlspecialchars($pet['color'] ?? 'Chưa cập nhật') ?>
                    </div>
                    
                    <div class="detail-info">
                        <span class="detail-label">Tình trạng:</span>
                        <span class="badge badge-success">Sẵn sàng nhận nuôi</span>
                    </div>
                    
                    <div class="pet-description">
                        <h5>Về <?= htmlspecialchars($pet['petname']) ?></h5>
                        <p><?= nl2br(htmlspecialchars($pet['note'] ?: 'Thú cưng đáng yêu đang tìm kiếm một gia đình mới. Hãy liên hệ với chúng tôi để biết thêm chi tiết!')) ?></p>
                    </div>
                    
                    <div class="pet-features">
                        <h5 class="mt-4">Đặc điểm</h5>
                        <div class="row">
                            <div class="col-6">
                                <p><i class="fas fa-check feature-icon"></i>Đã tiêm phòng</p>
                            </div>
                            <div class="col-6">
                                <p><i class="fas fa-check feature-icon"></i>Đã được tẩy giun</p>
                            </div>
                            <div class="col-6">
                                <p><i class="fas fa-check feature-icon"></i>Thân thiện</p>
                            </div>
                            <div class="col-6">
                                <p><i class="fas fa-check feature-icon"></i>Khỏe mạnh</p>
                            </div>
                        </div>
                    </div>
                    
                    <a href="https://www.facebook.com/profile.php?id=61559304898620&is_tour_dismissed" 
                       class="btn adoption-button" 
                       target="_blank">
                        <i class="fas fa-paw mr-2"></i>Liên hệ nhận nuôi
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Thú cưng tương tự -->
        <?php if ($similar_result->num_rows > 0) : ?>
        <div class="similar-pets" data-aos="fade-up" data-aos-duration="1000">
            <h3 class="mb-4">Thú cưng tương tự</h3>
            <div class="row">
                <?php while ($similar = $similar_result->fetch_assoc()) : ?>
                <div class="col-md-3 col-sm-6">
                    <a href="pet-detail.php?id=<?= $similar['id'] ?>" class="text-decoration-none">
                        <div class="similar-pet-card">
                            <img src="../src/images/pet/petmini/<?= htmlspecialchars($similar['image_path']) ?>" 
                                 alt="<?= htmlspecialchars($similar['petname']) ?>" 
                                 class="similar-pet-image">
                            <div class="similar-pet-name">
                                <?= htmlspecialchars($similar['petname']) ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Phần quy trình nhận nuôi -->
        <div class="adoption-process mt-5" data-aos="fade-up" data-aos-duration="1000">
            <h3 class="mb-4">Quy trình nhận nuôi</h3>
            <div class="row">
                <div class="col-md-3 text-center mb-4">
                    <i class="fas fa-search fa-3x mb-3" style="color: #356515;"></i>
                    <h5>1. Tìm hiểu</h5>
                    <p>Tìm hiểu kỹ về thú cưng và nhu cầu của chúng</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <i class="fas fa-comments fa-3x mb-3" style="color: #356515;"></i>
                    <h5>2. Liên hệ</h5>
                    <p>Liên hệ với chúng tôi để biết thêm thông tin</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <i class="fas fa-clipboard-check fa-3x mb-3" style="color: #356515;"></i>
                    <h5>3. Phỏng vấn</h5>
                    <p>Hoàn tất đơn đăng ký và phỏng vấn ngắn</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <i class="fas fa-home fa-3x mb-3" style="color: #356515;"></i>
                    <h5>4. Đón thú cưng</h5>
                    <p>Chào đón thành viên mới vào gia đình bạn</p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        AOS.init();
    </script>
</body>
</html>