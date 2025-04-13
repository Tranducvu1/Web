<?php
require "Header/header.php"; 
require "Sidebar/sidebar.php"; 
require 'Function/function.php';   

// Kết nối database
$sql = "SELECT * FROM pet";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Dora</title>

		<!-- Site favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
		<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
		<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />
		<!-- Mobile Specific Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css" />
		<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="src/styles/menu.css" />
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
		<script
			async
			src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
			crossorigin="anonymous"
		></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "G-GBZ3SGGX85");
		</script>
		<!-- Google Tag Manager -->
		<script>
			(function (w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != "dataLayer" ? "&l=" + l : "";
				j.async = true;
				j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
		</script>
		<!-- End Google Tag Manager -->

		<style type="text/css">
			/* Style the tab */
			.menu-block {
                background-color: #f8f9fa;
                padding: 15px;
            }

            .sidebar-menu ul {
                list-style-type: none;
                padding: 0;
                margin: 0;
            }

            .sidebar-menu li {
                margin-bottom: 10px;
            }

            .sidebar-menu .dropdown-toggle {
                display: flex;
                align-items: center;
                text-decoration: none;
                color: #333;
                font-size: 16px;
            }

            .sidebar-menu .dropdown-toggle:hover {
                color: #007bff;
            }

            .sidebar-menu ul.collapse li {
                padding-left: 20px;
            }
            
            .action-buttons a {
                margin-right: 5px;
            }
		</style>
	</head>

	<!-- basic table  Start -->
	<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="pd-20 card-box mb-30">
						<div class="clearfix mb-20">
							<div class="pull-left">
								<h4 class="text-blue h4">Danh sách thú cưng</h4>
							</div>
							<div class="pull-right">
								<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-pet-modal">Thêm thú</button>
							</div>
						</div>
						<table class="table">
							<thead>
								<tr>
									<th scope="col">STT</th>
									<th scope="col">Tên</th>
									<th scope="col">Tuổi</th>		
									<th scope="col">Giới tính</th>					
									<th scope="col">Hình ảnh</th>
									<th scope="col">Status</th>
									<th scope="col">Mô tả</th>	
									<th scope="col">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($result->num_rows > 0) {
									$count = 1;
									while($row = $result->fetch_assoc()) {
										echo "<tr>";
										echo "<th scope='row'>" . $count . "</th>";
										echo "<td>" . $row['petname'] . "</td>";
										echo "<td>" . $row['age'] . "</td>";
										echo "<td>" . $row['gender'] . "</td>";
										echo "<td><img src='src/images/pet/petmini/" . $row['image_path'] . "' alt='" . $row['petname'] . "' width='80' /></td>";
										
										// Status badge
										$statusClass = ($row['status'] == 'Đã nhận' || $row['status'] == 'Đã có') ? 'badge-success' : 'badge-secondary';
										echo "<td><span class='badge " . $statusClass . "'>" . $row['status'] . "</span></td>";
										
										echo "<td>" . $row['description'] . "</td>";
										// Action buttons
										echo "<td class='action-buttons'>";
										echo "<a href='#' class='btn btn-primary btn-sm edit-btn' data-pet='" . json_encode($row) . "'><i class='dw dw-edit2'></i> Sửa</a>";
										// Xóa thú cưng
										echo "<a href='?delete=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'><i class='dw dw-delete-3'></i> Xóa</a>";
										echo "</td>";
										echo "</tr>";
										$count++;
									}
								} else {
									echo "<tr><td colspan='7' class='text-center'>Không có dữ liệu</td></tr>";
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="add-pet-modal" tabindex="-1" role="dialog" aria-labelledby="add-pet-modal-label" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="add-pet-modal-label">Thêm thú cưng mới</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="form-group row">
								<label class="col-sm-12 col-md-3 col-form-label">Tên thú cưng</label>
								<div class="col-sm-12 col-md-9">
									<input class="form-control" type="text" name="petname" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-12 col-md-3 col-form-label">Tuổi</label>
								<div class="col-sm-12 col-md-9">
									<input class="form-control" type="number" name="age" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-12 col-md-3 col-form-label">Giới tính</label>
								<div class="col-sm-12 col-md-9">
									<select class="form-control" name="gender" required>
										<option value="Đực">Đực</option>
										<option value="Cái">Cái</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-12 col-md-3 col-form-label">Trạng thái</label>
								<div class="col-sm-12 col-md-9">
									<select class="form-control" name="status" required>
										<option value="Chưa nhận">Chưa nhận</option>
										<option value="Đã nhận">Đã nhận</option>
										<option value="Đã có">Đã có</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-12 col-md-3 col-form-label">Mô tả</label>
								<div class="col-sm-12 col-md-9">
									<textarea class="form-control" name="description" rows="4"></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-12 col-md-3 col-form-label">Hình ảnh</label>
								<div class="col-sm-12 col-md-9">
									<input type="file" class="form-control-file" name="image" accept="image/*">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12 text-right">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
									<button type="submit" name="add_petfood" class="btn btn-primary">Thêm</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="pet-modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm/Sửa thú cưng</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="pet_id" id="pet_id">
                    <div class="form-group row">
                        <label class="col-md-3">Tên thú cưng</label>
                        <div class="col-md-9"><input class="form-control" type="text" name="petname" id="petname" required></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Tuổi</label>
                        <div class="col-md-9"><input class="form-control" type="number" name="age" id="age" required></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Giới tính</label>
                        <div class="col-md-9">
                            <select class="form-control" name="gender" id="gender" required>
                                <option value="Đực">Đực</option>
                                <option value="Cái">Cái</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Trạng thái</label>
                        <div class="col-md-9">
                            <select class="form-control" name="status" id="status" required>
                                <option value="Chưa nhận">Chưa nhận</option>
                                <option value="Đã nhận">Đã nhận</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Mô tả</label>
                        <div class="col-md-9"><textarea class="form-control" name="description" id="description"></textarea></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Hình ảnh</label>
                        <div class="col-md-9"><input type="file" class="form-control-file" name="image"></div>
                    </div>
                    <div class="form-group row text-right">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" name="save_pet" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
	<!-- basic table  End -->

	<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function () {
                let pet = JSON.parse(this.getAttribute("data-pet"));
                document.getElementById("pet_id").value = pet.id;
                document.getElementById("petname").value = pet.petname;
                document.getElementById("age").value = pet.age;
                document.getElementById("gender").value = pet.gender;
                document.getElementById("status").value = pet.status;
                document.getElementById("description").value = pet.description;

                // Hiển thị modal
                $("#pet-modal").modal("show");
            });
        });
    });
</script>

</html>
<?php require "Footer/footer.php"; ?>
