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
        .category-item {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
        }
        .category-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .category-item i {
            color: #007bff;
            margin-bottom: 15px;
            display: block;
        }
        .category-item h5 {
            margin: 0;
            color: #333;
            font-weight: 600;
        }
        .category-item a {
            display: block;
            text-decoration: none;
        }
        .category-item a:hover {
            text-decoration: none;
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

</body>
</html> 