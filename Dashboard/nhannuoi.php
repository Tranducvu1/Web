<?php
session_start();
require_once '../Config/config.php';

// Pagination settings
$pets_per_page = 8;

// Get current page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Get total pets count
$count_sql = "SELECT COUNT(*) as total FROM pet WHERE status = 'available'";
$count_result = $conn->query($count_sql);
$total_pets = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_pets / $pets_per_page);

// Ensure current page is valid
$current_page = max(1, min($current_page, $total_pages));

// Calculate offset for SQL query
$offset = ($current_page - 1) * $pets_per_page;

// Updated query with pagination
$sql = "SELECT id, petname, age, gender, image_path, note FROM pet WHERE status = 'available' LIMIT $offset, $pets_per_page";
$result = $conn->query($sql);
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhận Nuôi Thú Cưng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      function openModal() {
        // Hiển thị modal
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
      }

      function closeModal() {
        // Đóng modal
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
      }
      function thaydoi() {
        if (document.getElementById("doi").innerText == "Liên hệ")
          document.getElementById("doi").innerText = "Đã liên hệ";
      }
    </script>
    
  </head>

  <body>
  <?php include 'Header/header.php'; ?>
    <div class="container">
    <div >
      <h3 style="text-align: center ; margin-top:8%;font-family:Sans serif;" class="m">  <!--class="poetsen-one-regular m" -->
       <i> Trước khi nhận nuôi cần lưu ý những điều này nha!</i>
      </h3>
      <br /><br />
    </div>
    <div>
      <div class="f">
        <i
          class="c fa-solid fa-coins fa-bounce fa-xl"
          style="color: #356515"
        ></i>
        <div style="text-align: left ">
          <b class="sedan-sc-regular">Tài chính </b>
          <p>
            Bạn cần phải có một nguồn tài chính cụ thể để <br>nuôi các bé tránh
            trường hợp đem vứt bỏ vì không chăm lo được
          </p>
        </div>
      </div>
      <div class="ff">
        <i
          class="c fa-solid fa-house-chimney fa-bounce fa-xl"
          style="color: #b197fc"
        ></i>
        <div style="text-align: right">
          <b class="sedan-sc-regular">Chỗ ở</b>
          <p>
            Đây là điều quan trọng. Bạn cần xem xét môi trường xung quanh xem có
            phù hợp để nuôi hay không.
          </p>
        </div>
      </div>
      <div class="fff">
        <i
          class="cc fa-solid fa-heart fa-beat fa-xl"
          style="color: #f55ca6"
        ></i>
        <div style="text-align: left">
          <b class="sedan-sc-regular">Yêu thương</b>
          <p>
            Khi bạn đã đảm nhận nuôi các bé, bạn cần phải có trách nhiệm yêu
            thương và chăm sóc các bé. Không phải vì những phút hứng thú và đẹp.
          </p>
        </div>
      </div>
      <div class="ffff">
        <i
          class="cc fa-solid fa-ban fa-beat-fade fa-xl"
          style="color: #9a1818"
        ></i>
        <div style="text-align: left">
          <b class="sedan-sc-regular">Không được</b>
          <p>
            Không vì các bé đẹp nhận nuôi rồi đem rao bán. Chúng tớ sẽ hỏi thăm
            tình hình các bé hằng tháng đến khi ổn định. Nếu chúng tớ phát hiện
            điều đó thì sẽ thu hồi bé ngay lập tức.
          </p>
        </div>
      </div>
      <img src="../src/images/pet/petmini/luuy-u.gif" class="mx-auto d-block gif" />
    </div>
   
    <div class="row " >
        <?php while ($row = $result->fetch_assoc()) : ?>
        <div class="col-3 mt-3">
        <a href="pet-detail.php?id=<?= $row['id'] ?>" class="text-decoration-none text-dark">
            <div class="card" style="width: 200px;">
            <div class="text-center mt-2">
                <img src="../src/images/pet/petmini/<?= htmlspecialchars($row['image_path']) ?>" style="width:175px;">
                <p><b><?= htmlspecialchars($row['petname']) ?></b></p>
            </div>
            <div class="card-body flex-grow-1">
                <ul>
                <li>Tuổi: <?= htmlspecialchars($row['age']) ?></li>
                <li>Giới tính: <?= htmlspecialchars($row['gender']) ?></li>
                <li>Ghi chú: <?= htmlspecialchars($row['note']) ?: "Không có" ?></li>
                </ul>
                
            </div>
            </div>
        </a>
        </div>
        <?php endwhile; ?>
</div>

<!-- Pagination -->
<div class="w3-center w3-padding-32">
            <div class="w3-bar">
                <?php if ($current_page > 1): ?>
                    <a href="?page=<?= $current_page - 1 ?>" class="w3-bar-item w3-button w3-hover-green">«</a>
                <?php else: ?>
                    <span class="w3-bar-item w3-button w3-disabled">«</span>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i == $current_page): ?>
                        <a href="?page=<?= $i ?>" class="w3-bar-item w3-green w3-button"><?= $i ?></a>
                    <?php else: ?>
                        <a href="?page=<?= $i ?>" class="w3-bar-item w3-button w3-hover-green"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
                
                <?php if ($current_page < $total_pages): ?>
                    <a href="?page=<?= $current_page + 1 ?>" class="w3-bar-item w3-button w3-hover-green">»</a>
                <?php else: ?>
                    <span class="w3-bar-item w3-button w3-disabled">»</span>
                <?php endif; ?>
            </div>
        </div>
    
    </div>
 
    
    </div>
    <script>!function(s,u,b,i,z){var o,t,r,y;s[i]||(s._sbzaccid=z,s[i]=function(){s[i].q.push(arguments)},s[i].q=[],s[i]("setAccount",z),r=["widget.subiz.net","storage.googleapis"+(t=".com"),"app.sbz.workers.dev",i+"a"+(o=function(k,t){var n=t<=6?5:o(k,t-1)+o(k,t-3);return k!==t?n:n.toString(32)})(20,20)+t,i+"b"+o(30,30)+t,i+"c"+o(40,40)+t],(y=function(k){var t,n;s._subiz_init_2094850928430||r[k]&&(t=u.createElement(b),n=u.getElementsByTagName(b)[0],t.async=1,t.src="https://"+r[k]+"/sbz/app.js?accid="+z,n.parentNode.insertBefore(t,n),setTimeout(y,2e3,k+1))})(0))}(window,document,"script","subiz", "acrzlzhzqyoebuvwjyyx")</script>
  </body>
  <script>
    AOS.init();
  </script>
</html>