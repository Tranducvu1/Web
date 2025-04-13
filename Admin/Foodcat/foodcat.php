<?php
require_once __DIR__ . '/../Function/function.php';
require_once __DIR__ . '/../Sidebar/sidebar.php';
require_once __DIR__ . '/../Header/header.php';
require_once __DIR__ . '/../Footer/footer.php';
require_once __DIR__ . '/../Config/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Dora - Thức ăn cho mèo</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="./../vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./../vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="./../vendors/images/favicon-16x16.png" />
    
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./../vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="./../vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="./../vendors/styles/style.css" />
    <link rel="stylesheet" type="text/css" href="./../src/styles/menu.css" />
    <link rel="stylesheet" type="text/css" href="./../vendors/styles/foodcat.css" />

</head>
<body>
   <!-- <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="./../vendors/images/logo.png" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>
-->
  

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Form Section -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <?php if(isset($success_message)) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $success_message; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <?php if(isset($error_message)) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error_message; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="modal fade " id="add-petfood-modal" tabindex="-1" role="dialog" aria-labelledby="add-petfood-modal-label" aria-hidden="true">

                        <form method="POST" action="" enctype="multipart/form-data" >
                            <div class="row bg">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên thức ăn <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="catfoodnames" value="<?php echo $catfoodnames; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá tiền (VNĐ) <span class="text-danger">*</span></label>
                                        <input class="form-control" type="number" name="money" value="<?php echo $money; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Đánh giá (1-5 sao)</label>
                                        <select class="form-control" name="star">
                                            <?php for($i = 1; $i <= 5; $i++) { ?>
                                                <option value="<?php echo $i; ?>" <?php echo ($star == $i) ? 'selected' : ''; ?>><?php echo $i; ?> sao</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label> 
                                        <select class="form-control" name="status">
                                            <option value="Available" <?php echo ($status == 'Available') ? 'selected' : ''; ?>>Available</option>
                                            <option value="Out of Stock" <?php echo ($status == 'Out of Stock') ? 'selected' : ''; ?>>Out of Stock</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" name="description" rows="4"><?php echo $description; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh <?php echo ($form_mode == 'add') ? '<span class="text-danger">*</span>' : ''; ?></label>
                                        <input type="file" class="form-control-file" name="image_path" <?php echo ($form_mode == 'add') ? 'required' : ''; ?>>
                                        <?php if($current_image != '') { ?>
                                            <div class="mt-2">
                                                <p>Hình ảnh hiện tại:</p>
                                                <img src="<?php echo $current_image; ?>" alt="Current Image" style="max-width: 150px;">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group row">
								<div class="col-sm-12 text-right">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
									<button type="submit" name="add_foodcat" class="btn btn-primary">Thêm</button>
								</div>
                                
							</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Data Table Section -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Quản lý thức ăn cho mèo</h4>
                        <?php if(isset($delete_message)) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $delete_message; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="pb-20">
                        <div class="row pd-20">
                            <div class="col-md-6">
                                <form action="" method="GET" class="d-flex">
                                    <input class="form-control me-2" type="search" name="search" placeholder="Tìm kiếm..." value="<?php echo $search_query; ?>">
                                    <button class="btn btn-primary" type="submit">Tìm</button>
                                </form>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-petfood-modal">Thêm thức ăn</button>

                            </div>
                        </div>
                        <table class="table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Số tiền</th>
                                    <th>Hình ảnh</th>
                                    <th>Mô tả</th>
                                    <th>Sao</th>
                                    <th>Status</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    $counter = 1;
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td><?php echo $row["catfoodnames"]; ?></td>
                                    <td><?php echo number_format($row["money"]); ?> VNĐ</td>
                                    <td>
                                    <?php
                                        $imagePath = "./../src/images/pet/petmini/" . $row["image_path"];
                                        if (file_exists($imagePath)) {
                                            echo '<img src="'.$imagePath.'" alt="'.$row["catfoodnames"].'" style="max-width: 100px;">';
                                        } else {
                                            echo '<p style="color:red;">Ảnh không tồn tại!</p>';
                                        }
                                        ?>

                                    </td>
                                    <td><?php echo $row["description"]; ?></td>
                                    <td>
                                        <?php
                                        for($i = 1; $i <= 5; $i++) {
                                            if($i <= $row["star"]) {
                                                echo '<i class="icon-copy fa fa-star" style="color:gold;"></i>';
                                            } else {
                                                echo '<i class="icon-copy fa fa-star-o"></i>';
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <span class="badge <?php echo ($row["status"] == 'Available') ? 'badge-success' : 'badge-danger'; ?>">
                                            <?php echo $row["status"]; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item" href="foodcat_view.php?id=<?php echo $row['id']; ?>">
                                                    <i class="dw dw-eye"></i> Xem
                                                </a>
                                                <a class="dropdown-item" href="?edit_id=<?php echo $row['id']; ?>">
                                                    <i class="dw dw-edit2"></i> Sửa
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['id']; ?>)">
                                                    <i class="dw dw-delete-3"></i> Xóa
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="8" class="text-center">Không có dữ liệu</td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="./../vendors/scripts/core.js"></script>
    <script src="./../vendors/scripts/script.min.js"></script>
    <script src="./../vendors/scripts/process.js"></script>
    <script src="./../vendors/scripts/layout-settings.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function confirmDelete(id) {
        if (confirm("Bạn có chắc chắn muốn xóa mục này?")) {
            window.location.href = "foodcat.php?delete_id=" + id;
        }
    }
    </script>
</body>
</html>
<?php
$conn->close();
?>