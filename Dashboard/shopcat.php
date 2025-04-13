<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Cat</title>
    <link href="../src/styles/bootstrap.min.css" rel="stylesheet" />
    <script src="../src/styles/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="../src/styles/bootstrap.bundle.min.js"></script>
    <script src="../src/styles/boxicons.js"></script>
    <link href="../src/styles/shopcat.css" rel="stylesheet">
    
</head>

<body>

    <?php include 'Header/header.php'; ?>
    <script>
        AOS.init();
       </script>
    <div data-aos="fade-down-right" data-aos-duration="1200">
        <section id="pets" class="mt-5">
            <div class="">
                <h2 class="text-center mb-4">
                    <i class="fas fa-bowl-food"></i> CAT FOOD
                </h2>
                <div class="pet-scroll-wrapper row-sm-12">
                    <button class="pet-scroll-button pet-scroll-button-prev" id="prev-button">&#8249;</button>
                    <div class="pet-scroll-container d-flex justify-content-between" id="scroll-container">
                        <div class="pet-scroll-item col-sm-12">
                            <div class="pet-card">
                                <img class="pet-card-img-top" src="nutri.jpg" alt="Pet Image">
                                <div class="pet-card-body">
                                    <h5 class="card-title"> </h5>
                                    <div class="mb-2">
                                        <i class="fa fa-star" style="color: yellow"></i>
                                        <i class="fa fa-star" style="color: yellow"></i>
                                        <i class="fa fa-star" style="color: yellow"></i>
                                        <i class="fa fa-star" style="color: yellow"></i>
                                        <i class="fa fa-star" style="color: yellow"></i>
                                    </div>
                                    <div class="price">
                                       <span class="currency"> </span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <button type="button" class="btn add-to-cart ">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <button class="btn btn-success">Đặt hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        <br>


                    </div>
                    <button class="pet-scroll-button pet-scroll-button-next" id="next-button">&#8250;</button>
                </div>

            </div>
        </section>
    </div>



    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Giỏ hàng của bạn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="cart-items" class="list-group">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#checkoutModal">Đặt hàng</button>
                </div>
            </div>
        </div>
    </div>
   
    <div data-aos="fade-up"data-aos-duration="700">
        <section id="pets" class="mt-5">
            <div class="">
                <h2 class="text-center mb-4">CAT Hygiene</h2>
                <div class="pet-scroll-wrapper row-sm-12">
                    <button class="pet-scroll-button pet-scroll-button-prev" id="prev-button-2">&#8249;</button>
                    <div class="pet-scroll-container d-flex justify-content-between" id="scroll-container-2">
                        <div class="pet-scroll-item col-sm-12">
                            <div class="pet-card">
                                <img class="pet-card-img-top" src="catsan.jpg" alt="Pet Image">
                                <div class="pet-card-body">
                                    <h5 class="card-title"></h5>
                                    <div class="mb-2">
                                        <i class="fa fa-star" style="color: yellow"></i>
                                        <i class="fa fa-star" style="color: yellow"></i>
                                        <i class="fa fa-star" style="color: yellow"></i>
                                        <i class="fa fa-star" style="color: yellow"></i>
                                        <i class="fa fa-star" style="color: yellow"></i>
                                    </div>
                                    <div class="price">
                                        <span class="currency"> </span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <button type="button" class="btn add-to-cart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <button class="btn btn-success">Đặt Hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <button class="pet-scroll-button pet-scroll-button-next" id="next-button-2">&#8250;</button>
                </div>

            </div>
        </section>
    </div>

    <div data-aos="fade-up"data-aos-duration="800">
        <section id="pets" class="mt-5">
            <div class="">
                <h2 class="text-center mb-4">Cat Clothes</h2>
                <div class="pet-scroll-wrapper row-sm-12">
                    <button class="pet-scroll-button pet-scroll-button-prev" id="prev-button-3">&#8249;</button>
                    <div class="pet-scroll-container d-flex justify-content-between" id="scroll-container-3">
                        <div class="pet-scroll-item col-sm-12">
                            <div class="pet-card">
                                <img class="pet-card-img-top" src="aolenmeo.jpg" alt="Pet Image">
                                <div class="pet-card-body">
                                    <h5 class="card-title"></h5>
                                    <div class="mb-2">
                                        <i class="fa fa-star" style="color: yellow"></i>
                                        <i class="fa fa-star" style="color: yellow"></i>
                                        <i class="fa fa-star" style="color: yellow"></i>
                                        <i class="fa fa-star" style="color: yellow"></i>

                                    </div>
                                    <div class="price">
                                        <span class="currency"> </span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <button type="button" class="btn add-to-cart">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <button href="" class="btn btn-success">Đặt Hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
          
                    <button class="pet-scroll-button pet-scroll-button-next" id="next-button-3">&#8250;</button>
                </div>

            </div>
        </section>
    </div>

  
    
    <?php include 'Footer/footer.php'; ?>
</body>

</html>