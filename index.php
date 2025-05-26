<?php
session_start();
require_once './commons/env.php';
require_once './commons/function.php';
require_once './controllers/HomeController.php';

if (!empty($_SESSION['success_msg'])): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert" style="position:fixed;top:70px;right:20px;z-index:1000;">
    <?= htmlspecialchars($_SESSION['success_msg']) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php 
  unset($_SESSION['success_msg']); 
endif;

$act = $_GET['act'] ?? '/';

match ($act) {
    '/' => (new HomeController())->index(),
      default             => (new HomeController())->index(),
};
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Điện Thoại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/cusstom.css">



    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>

<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand brand-logo" href="#">
                <i class="fas fa-mobile-alt"></i>
                <span>TechStore</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Khuyến mãi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>
                </ul>
                <div class="d-flex">
                    <a href="cart.php" class="btn btn-outline-light me-2"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Modal Đăng nhập/Đăng ký -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content auth-form">
                <div class="modal-header">
                    <ul class="nav nav-tabs auth-tabs w-100" id="authTabs" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link active w-100" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">Đăng nhập</button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link w-100" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">Đăng ký</button>
                        </li>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="authTabContent">
                        <!-- Form Đăng nhập -->
                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            <form>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Mật khẩu">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                            </form>
                            <div class="social-login">
                                <p class="text-muted">Hoặc đăng nhập với</p>
                                <button class="btn btn-facebook mb-2">
                                    <i class="fab fa-facebook-f me-2"></i> Facebook
                                </button>
                                <button class="btn btn-google">
                                    <i class="fab fa-google me-2"></i> Google
                                </button>
                            </div>
                        </div>
                        <!-- Form Đăng ký -->
                        <div class="tab-pane fade" id="register" role="tabpanel">
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Họ và tên">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Mật khẩu">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Xác nhận mật khẩu">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="agreeTerms">
                                    <label class="form-check-label" for="agreeTerms">Tôi đồng ý với điều khoản sử dụng</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Đăng ký</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BANNER / CAROUSEL -->
    <section class="mb-5 ">
        <div class="container">
            <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">

                <!-- Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2"></button>
                </div>

                <!-- Slides -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="public/images/banner1.png" class="d-block w-100" alt="Slide 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="display-4">Khuyến mãi khủng</h1>
                            <p>Giảm đến 50% điện thoại cao cấp</p>
                            <a href="/?act=product-list" class="btn btn-primary btn-lg">Mua ngay</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="public/images/banner2'.jpg" class="d-block w-100" alt="Slide 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="display-4">Flash Sale</h1>
                            <p>Giảm giá sốc trong 24h</p>
                            <a href="/?act=product-list" class="btn btn-primary btn-lg">Xem ngay</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="public/images/banner3.jpg" class="d-block w-100" alt="Slide 3">
                        <div class="carousel-caption d-none d-md-block">
                            <h1 class="display-4">Hotsale Mùa Hè</h1>
                            <p>Ưu đãi lớn, quà tặng hấp dẫn</p>
                            <a href="/?act=product-list" class="btn btn-primary btn-lg">Khám phá</a>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
    </div>



    <!-- DANH MỤC -->
    <div class="container py-5">
        <h2 class="text-center mb-4">Danh mục sản phẩm</h2>
        <div class="row g-4">
            <?php
            $categories = [
                ['icon' => 'mobile-alt', 'label' => 'Điện thoại'],
                ['icon' => 'tablet-alt', 'label' => 'Máy tính bảng'],
                ['icon' => 'headphones', 'label' => 'Phụ kiện'],
                ['icon' => 'laptop', 'label' => 'Laptop'],
            ];
            foreach ($categories as $cat): ?>
                <div class="col-md-3">
                    <div class="category-item text-center">
                        <i class="fas fa-<?= $cat['icon'] ?> fa-2x mb-2"></i>
                        <h5><?= $cat['label'] ?></h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- SẢN PHẨM BÁN CHẠY -->
    <div class="container mb-5">
        <h2 class="text-center mb-4">Sản phẩm bán chạy</h2>
        <div class="row g-4">
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="col-md-3">
                    <div class="card h-100 product-card border-0 shadow-sm">
                        <img src="data:image/jpeg;base64,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" class="card-img-top" alt="Sản phẩm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">iPhone 14 Pro Max</h5>
                            <p class="text-danger fw-bold">29.990.000đ</p>
                            <a href="#" class="btn btn-outline-primary mt-auto">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- SẢN PHẨM GỢI Ý -->
    <div class="container mb-5">
        <h2 class="text-center mb-4">Sản phẩm gợi ý</h2>
        <div class="row g-4">
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="col-md-3">
                    <div class="card h-100 product-card border-0 shadow-sm">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWZ5IzzJCuIb0UjqEcCBcQZoivGa4zAy6A-g&s" class="card-img-top" alt="Sản phẩm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Samsung Galaxy S23 Ultra</h5>
                            <p class="text-danger fw-bold">24.990.000đ</p>
                            <a href="#" class="btn btn-outline-primary mt-auto">Mua ngay</a>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="pt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Về chúng tôi</h5>
                    <p>Shop điện thoại uy tín, chất lượng hàng đầu Việt Nam</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <p>Email: contact@shopdienthoai.com</p>
                    <p>Hotline: 1900 1234</p>
                </div>
                <div class="col-md-4">
                    <h5>Theo dõi chúng tôi</h5>
                    <div class="d-flex">
                        <a href="#" class="me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', () => {
            document.querySelector('.navbar')
                .classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
    <script>
        window.addEventListener('scroll', () => {
            document.querySelector('.navbar')
                .classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>


</body>



</html>

