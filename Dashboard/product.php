<?php 
require_once '../Config/config.php';

function getProducts($category, $conn) {
    $sql = "SELECT * FROM products";
    return $conn->query($sql);
}

function addToCart($user_name, $product_id, $quantity, $conn) {
    if (isset($user_name) && isset($product_id) && isset($quantity)) {
        $sql = "INSERT INTO cart_item (user_name, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $user_name, $product_id, $quantity);
        if ($stmt->execute()) {
            return json_encode(["success" => true]);
        } else {
            return json_encode(["success" => false, "message" => "Error: " . $conn->error]);
        }
    } else {
        return json_encode(["success" => false, "message" => "Missing data"]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data) {
        $user_name = $data['user_name'];
        $product_id = $data['product_id'];
        $quantity = $data['quantity'];
        echo addToCart($user_name, $product_id, $quantity, $conn);
        exit;
    }
}

$category = 'new';
$products = getProducts($category, $conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm</title>
    <link href="bootstrap.min.css" rel="stylesheet" />
    <script src="bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
    <script src="boxicons.js"></script>
    <link href="../src/styles/sp.css" rel="stylesheet">
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
        </div>
        <div class="carousel-inner" id="home">
            <div class="carousel-item active">
                <img src="pk.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="qao.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="tan.png" class="d-block w-100" alt="...">
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
    


</div>
   
<script>
    AOS.init();
   </script>
    <div class="A" data-aos="fade-up"data-aos-duration="900">
        <div class="Main">
            <div class="left">
                <button type="button">
                    <img src="cho.png" alt="">
                </button>
                <br>
                <div class="Nut">
                    <a href="shopdog1.html">Shop Dog</a>
                </div>
            </div>
            <div class="right">
                <button type="button">
                    <img src="meo.png" alt="">
                </button><br>
                <div class="Nut">
                    <a href="shopcat.html">Shop Cat</a>
                </div>
            </div>
            <div class="cs">
                <button type="button">
                    <img src="csoc.png" alt="">
                </button><br>
                <div class="Nut">
                    <a href="kienthuc.html">Kiến Thức Chăm Sóc</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('backButton').addEventListener('click', function () {
            window.history.back();
        });
    </script>
    <header class="header">
        <div class="banner-container">
            <div class="banner-card"
                style="background-image: url('gif3.png'); background-size: cover; background-position: center; width: 470px; height: 274px;">
                <h3>Coupon Savings</h3>
                <p>Save big with everyday discounts</p>
                <button>View Coupons</button>
            </div>
            <div class="banner-card"
                style="background-image: url('gif2.png'); background-size: cover; background-position: center; width: 470px; height: 274px;">
                <h3>Free Delivery</h3>
                <p>Free shipping on orders above 200.000</p>
                <button>Shop Now</button>
            </div>
            <div class="banner-card"
                style="background-image: url('gif.png'); background-size: cover; background-position: center; width: 470px; height: 274px;">
                <h3>Gift Voucher</h3>
                <p>With special offers and deals</p>
                <button>Shop Coupons</button>
            </div>
        </div>
    </header>

   <!-- Product Section -->
   <section class="product-section">
    <h2>Popular <span>Collections</span></h2>
    <div class="product-grid">
        <?php
        // Loop through each product and display it
        if ($products->num_rows > 0) {
            while ($product = $products->fetch_assoc()) {
                echo '
                <div class="pet-scroll-item col-sm-4" data-category="' . $product['category'] . '" data-product-id="' . $product['id'] . '">
                    <div class="pet-card">
                        <img class="pet-card-img-top" src="../src/images/' . $product['image_url'] . '" alt="Pet Image">
                        <div class="pet-card-body">
                            <h5 class="card-title">' . $product['name'] . '</h5>
                            <div class="mb-2">
                                <i class="fa fa-star" style="color: gold;"></i>
                            </div>
                            <div class="price">' . number_format($product['price'], 0, ',', '.') . ' VND</div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <button type="button" class="btn btn-success add-to-cart-btn">
                                    <i class="fas fa-shopping-cart"></i> Thêm giỏ hàng
                                </button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<p>No products available in this category.</p>';
        }
        ?>
    </div>
</section>
   
    <?php include 'Footer/footer.php'; ?>
    <script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', () => {
            const card = button.closest('.pet-scroll-item');
            const productId = card.getAttribute('data-product-id');
            const userName = localStorage.getItem('username');

            if (!userName) {
                alert("Vui lòng đăng nhập để thêm vào giỏ hàng.");
                return;
            }

            fetch(window.location.href, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    user_name: userName,
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert("Đã thêm vào giỏ hàng!");
                } else {
                    alert("Lỗi: " + result.message);
                }
            })
            .catch(error => {
                console.error("Lỗi khi gửi dữ liệu:", error);
                alert("Đã xảy ra lỗi, vui lòng thử lại.");
            });
        });
    });
});
</script>
</body>

</html>