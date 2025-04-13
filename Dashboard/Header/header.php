<!DOCTYPE php>
<php lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dora</title>
  <link href="../src/styles/bootstrap.min.css" rel="stylesheet" />
    <script src="../src/scripts/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma" />
  <link rel="stylesheet" href="../src/styles/nhannuoi.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Karma"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
      integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    function openModal() {
      document.getElementById("myModal").style.display = "block";
    }
    function closeModal() {
      document.getElementById("myModal").style.display = "none";
    }
    function thaydoi() {
      if (document.getElementById("doi").innerText == "Liên hệ")
        document.getElementById("doi").innerText = "Đã liên hệ";
    }
  </script>
</head>
<body>
  <header class="navbar-fixed">
    <nav class="navbar navbar-expand-sm navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="../src/images/pet/logo/dora.png" alt="Logo" class="d-inline-block align-top" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="trangchu.php">Trang chủ</a></li>
            <li class="nav-item"><a class="nav-link" href="nhannuoi.php">Nhận nuôi</a></li>
            <li class="nav-item"><a class="nav-link" href="quyengop.php">Quyên góp</a></li>
            <li class="nav-item"><a class="nav-link" href="blog.php">Bài đăng</a></li>
            <li class="nav-item"><a class="nav-link" href="gopy.php">Góp ý</a></li>
            <li class="nav-item"><a class="nav-link" href="product.php">Sản phẩm</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div>
      <img src="x.jpg" style="width: 100%" class="w3-image"/>
    </div>
  </header>

