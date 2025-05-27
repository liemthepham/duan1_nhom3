<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa hàng điện tử</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .product-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-image {
            height: 200px;
            object-fit: cover;
        }
        .price {
            color: #e44d26;
            font-weight: bold;
        }
        /* Custom CSS for banner image */
        .banner-img {
            width: 85%; /* Ensure it takes full width of its container */
            max-height: 400px; /* Set a maximum height */
            object-fit: cover; /* Crop the image to cover the area without distortion */
        }
        /* Custom CSS for banner section spacing */
        .banner-section {
            margin-top: 10px; /* Adjust this value for desired spacing from the top */
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand brand-logo" href="index.php">
                <i class="fas fa-mobile-alt"></i>
                <span>TechStore</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Khuyến mãi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>
                </ul>
                <div class="d-flex">
                    <a href="index.php?act=cart" class="btn btn-outline-light me-2"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
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

    <!-- BANNER -->
    <section class="banner-section ">
        <div class="container position-relative text-center text-white">
            <img src="public/images/banner3.jpg" class="img-fluid rounded banner-img" alt="Hotsale Mùa Hè">
            <div class="position-absolute top-50 start-50 translate-middle w-100">
                <h1 class="display-4">Hotsale Mùa Hè</h1>
                <p class="lead">Ưu đãi lớn, quà tặng hấp dẫn</p>
                <a href="index.php?act=product-list" class="btn btn-primary btn-lg">Khám phá</a>
            </div>
        </div>
    </section>

    <!-- DANH MỤC -->
    <div class="container py-5">
        <h2 class="text-center mb-4">Danh mục sản phẩm</h2>
        <div class="row g-4">
            <?php
            foreach ($categories as $cat): ?>
                <div class="col-md-3">
                    <div class="category-item text-center">
                        <a href="index.php?act=home&category_id=<?php echo $cat['MaDanhMuc']; ?>" class="text-decoration-none text-dark">
                             <i class="fas fa-<?php /* Cần thêm cột icon vào bảng danhmuc hoặc mapping */ echo 'mobile-alt'; ?> fa-2x mb-2"></i>
                             <h5><?php echo htmlspecialchars($cat['TenDanhMuc']); ?></h5>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- SẢN PHẨM BÁN CHẠY -->
    <div class="container mb-5">
        <h2 class="text-center mb-4">Sản phẩm bán chạy</h2>
        <div class="row g-4">
            <?php foreach ($products as $product): // Sử dụng biến $products từ index.php ?>
                <div class="col-md-3">
                    <div class="card h-100 product-card border-0 shadow-sm">
                        <img src="images/<?php echo htmlspecialchars($product['AnhDaiDien']); ?>" 
                             class="card-img-top product-image" alt="<?php echo htmlspecialchars($product['TenSanPham']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['TenSanPham']); ?></h5>
                            <p class="card-text">
                                <small class="text-muted"><?php echo htmlspecialchars($product['TenDanhMuc']); ?></small>
                            </p>
                             <?php // Giới hạn mô tả sản phẩm chỉ hiển thị 100 ký tự
                                $description = htmlspecialchars($product['MoTa']);
                                if (strlen($description) > 100) {
                                    $description = substr($description, 0, 100) . '...';
                                }
                            ?>
                            <p class="card-text"><?php echo $description; ?></p>
                            <p class="price"><?php echo number_format($product['Gia'], 0, ',', '.'); ?> VNĐ</p>
                            <div class="d-flex justify-content-between">
                                <a href="index.php?act=product-detail&id=<?php echo $product['MaSanPham']; ?>" class="btn btn-primary">Chi tiết</a>
                                <form action="index.php?act=add-to-cart" method="POST" style="display: inline;">
                                    <input type="hidden" name="product_id" value="<?php echo $product['MaSanPham']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($current_page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?act=home&page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                    <a class="page-link" href="index.php?act=home&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?act=home&page=<?php echo $current_page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- SẢN PHẨM GỢI Ý -->
    <div class="container mb-5">
        <h2 class="text-center mb-4">Sản phẩm gợi ý</h2>
        <div class="row g-4">
            <?php /* Cần lấy dữ liệu sản phẩm gợi ý từ database */ ?>
            <?php for ($i = 1; $i <= 4; $i++): // Tạm thời hiển thị dữ liệu mẫu ?>
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
                    <p>Cửa hàng điện tử uy tín, chất lượng</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <p>Email: contact@example.com</p>
                    <p>Điện thoại: 0123 456 789</p>
                </div>
                <div class="col-md-4">
                    <h5>Theo dõi chúng tôi</h5>
                    <div class="d-flex">
                        <a href="#" class="text-light me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-light me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
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
</body>

</html> 