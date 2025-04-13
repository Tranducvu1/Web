<?php
session_start();
require_once '../Config/config.php';

$sql = "SELECT id, petname, age, gender, image_path, note FROM pet WHERE status = 'available'";
$result = $conn->query($sql);
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="../src/styles/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> 
    <script src="../src/scripts/bootstrap.bundle.min.js"></script>
    <script src="../src/scripts/boxicons.js"></script>
    <link href="../src/styles/css1.css" rel="stylesheet">
</head>
<body>
<?php include 'Header/header.php'; ?>

  
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
                aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner" id="home">
            <div class="carousel-item">
                <img src="../anh2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-md-block">
                    <h1>HÃY NHẬN NUÔI, ĐỪNG XUA ĐUỔI!
                    </h1>
                    <p> Loài vật cũng có tri giác và cảm xúc, chúng cũng biết đau, biết sợ hãi, biết yêu thương và muốn
                        được yêu thương.
                    </p>
                    <a href="nhannuoi.php" class="btn btn-primary">ĐỌC THÊM</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="anh3.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-md-block">
                    <h1>NHỮNG BÉ MÈO ĐANG CHỜ ĐƯỢC NHẬN NUÔI...
                    </h1>
                    <p> Mong các bạn hãy cho các bé một cơ hội! Trở thành thành viên trong gia đình của mình!.</p>
                    <a href="nhannuoi.php" class="btn btn-primary">ĐỌC THÊM</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="slider3.jpg" class=" w-100" alt="...">
                <div class="carousel-caption  d-md-block">
                    <h1>NHỮNG CHÚ CHÓ ĐANG CHỜ ĐƯỢC NHẬN NUÔI...

                    </h1>
                    <p> Mong các bạn hãy cho các bé một cơ hội! Trở thành thành viên trong gia đình của mình!.</p>
                    <a href="nhannuoi.php" class="btn btn-primary">ĐỌC THÊM</a>
                </div>
            </div>
            <div class="carousel-item active">
                <img src="../anh4.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-md-block">
                    <h1>CÁCH ỦNG HỘ GIÚP ĐỠ NHÓM</h1>
                    <p>Cùng tìm hiểu các hình thức để ủng hộ cho hoạt động của Dora</p>
                    <a href="chon.html" class="btn btn-primary">ĐỌC THÊM</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Khởi tạo carousel và thiết lập tự động lướt sau mỗi  giây
        var myCarousel = new bootstrap.Carousel(document.getElementById('carouselExampleIndicators'), {
            interval: 7000,
            ride: 'carousel'
        });
    </script>

    <div class="container-fluid">
        <div data-aos="fade-down-right" data-aos-duration="1200">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-4 mt-md-4">
                <img src="anh4.png" class="img-fluid float-left">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-8 text-left mt-md-4">
                <h3>Cứu Hộ Thú Cưng - DORA</h3>
                <p class="mt-3 text-justify">
                    Chúng tôi là một nhóm tình nguyện viên đam mê yêu thương chó mèo. Chúng tôi tin rằng tất cả các con
                    vật đều xứng đáng được yêu thương và có quyền sống một cuộc sống hạnh phúc. Ước mơ của chúng tôi là
                    không từ bỏ bất kỳ con vật nào, dù trước đây chúng ở trong hoàn cảnh khó khăn như thế nào.
                    <br><br>
                    Chúng tôi không chỉ tập trung vào việc cứu giúp các chó mèo bị bỏ rơi, bị bạo hành hoặc bị tàn tật,
                    mà còn muốn đảm bảo rằng chúng nhận được sự chăm sóc và yêu thương tận tâm. Chúng tôi cung cấp nơi
                    trú ẩn an toàn cho các bé thú cưng, đảm bảo chăm sóc y tế đầy đủ và tìm kiếm những ngôi nhà yêu
                    thương vĩnh viễn cho các bé.
                </p>
            </div>
        </div>
    </div></div>
    <br>
    <div class="donate-bg">
        <div class="container mt-5" id="donate">

            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-12 mt-4">
                    <div class="card h-100 mx-auto">
                        <div class="card-body d-flex flex-column justify-content-between">
                            
                            <img class="card-img-top product-img img-fuild" src="../src/images/pet/petmini/anh5.png" alt="Product Image">
                            <div>
                                <h5 class="card-title">Quyên góp</h5>
                                <p class="card-text">Hãy đóng góp để chúng tôi có thể cứu sống nhiều thú cưng hơn.</p>
                            </div>
                            <a href="quyengop.html" class="btn">Quyên góp ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mt-4" data-aos="fade-up">
                    <div class="card h-100 mx-auto">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <img class="card-img-top product-img img-fuild" src="../src/images/pet/petmini/anh6.png" alt="Product Image">
                            <div>
                                <h5 class="card-title">Nhận nuôi</h5>
                                <p class="card-text">Hãy tìm một người bạn mới trong các bé thú cưng của chúng tôi.</p>
                            </div>
                            <a href="nhannuoi.php" class="btn" >Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mt-4" data-aos="fade-up">
                    <div class="card h-100 mx-auto">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <img class="card-img-top product-img img-fuild" src="../src/images/pet/petmini/anh7.png" alt="Product Image">
                            <div>
                                <h5 class="card-title">Góp ý</h5>
                                <p class="card-text">Hãy cho chúng tôi biết ý kiến của bạn để chúng tôi cải thiện hơn.</p>
                            </div>
                            <a href="gopy.html" class="btn ">Góp ý ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br id="nhannuoi">
        <div data-aos="fade-up" data-aos-duration="600">
            <section id="pets" class="mt-5">
                <div class="">
                    <h2 class="text-center text-light mb-4">Các Bé Thú Cưng Cần Nhận Nuôi</h2>
                    <div class="pet-scroll-wrapper row-sm-12">
                        <button class="pet-scroll-button pet-scroll-button-prev" id="prev-button">&#8249;</button>
                        <div class="pet-scroll-container d-flex justify-content-between" id="scroll-container">
                            <?php
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo '<div class="pet-scroll-item col-sm-12">';
                                    echo '<div class="pet-card">';
                                    echo '<img class="pet-card-img-top" src="' . htmlspecialchars($row['image_path']) . '" alt="' . htmlspecialchars($row['petname']) . '">';
                                    echo '<div class="pet-card-body">';
                                    echo '<h5 class="card-title">' . htmlspecialchars($row['petname']) . '</h5>';
                                    echo '<p class="card-text">Tuổi: ' . htmlspecialchars($row['age']) . ' tháng</p>';
                                    echo '<p>Giới tính: ' . htmlspecialchars($row['gender']) . '</p>';
                                    if (!empty($row['note'])) {
                                        echo '<p class="card-text">' . htmlspecialchars($row['note']) . '</p>';
                                    }
                                    echo '<a href="nhannuoi.php?pet_id=' . htmlspecialchars($row['id']) . '" class="btn">Nhận nuôi</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<div class="col-12 text-center text-light">Hiện tại chưa có thú cưng nào để nhận nuôi.</div>';
                            }
                            ?>
                        </div>
                        <a href="nhannuoi.php" class="btn btn-secondary mt-2" id="donate-section">Xem thêm</a>
                        <button class="pet-scroll-button pet-scroll-button-next" id="next-button">&#8250;</button>
                    </div>
                </div>
            </section>
    </div>
    </div>
    <br id="quyengop">
    <div data-aos="fade-up" data-aos-duration="700">
    <div style="background-color: #f1f1f1; border-radius: 20px; padding: 20px; text-align: center;">
        <h2>Hãy click để quyên góp thức ăn cho các bé nhé!</h2>
        <img src="../src/images/pet/petmini/thucan.png" alt="Thức ăn">
        <a href="thank.html">
            <div class="click" id="gopy">
                <button type="button"
                    style="background-color: #059862; color: white; padding: 10px 20px; font-size: 16px; border: none; border-radius: 10px; cursor: pointer;">Click
                    Me!</button>
            </div>
        </a>
    </div>
    </div>
    <div data-aos="fade-up"data-aos-duration="700">
    <div class="container mt-5">
        <h3 style="text-align: center; font-family: 'Montserrat', sans-serif; color: rgba(16, 172, 94, 0.707);">Gửi góp ý</h3>
        <form action="#" method="post" style="width: 100%; margin: 0 auto;">
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
                <textarea class="form-control" id="nd" name="nd" style="height: 200px; resize: none;"
                    placeholder="Nội dung"></textarea>
                <label for="nd">Nội dung</label>
            </div>
            <button type="submit" class="btn ">Gửi</button>
        </form>
    </div>
</div>
</div>
<?php include 'Footer/footer.php'; ?>
    <script>
        const scrollContainer = document.getElementById('scroll-container');
        const prevButton = document.getElementById('prev-button');
        const nextButton = document.getElementById('next-button');
        const xemThemButton = document.getElementById('xem-them-button');

        let scrollAmount = 0;
        const scrollStep = 320;

        prevButton.addEventListener('click', () => {
            scrollAmount = Math.max(scrollAmount - scrollStep, 0);
            scrollContainer.scrollTo({
                top: 0,
                left: scrollAmount,
                behavior: 'smooth'
            });
        });

        nextButton.addEventListener('click', () => {
            scrollAmount = Math.min(scrollAmount + scrollStep, scrollContainer.scrollWidth - scrollContainer.clientWidth);
            scrollContainer.scrollTo({
                top: 0,
                left: scrollAmount,
                behavior: 'smooth'
            });
        });

        xemThemButton.addEventListener('click', () => {
            window.location.href = 'nhannuoi.php';
        });
    </script>
<script>
   AOS.init();
  </script>

</body>

</html>