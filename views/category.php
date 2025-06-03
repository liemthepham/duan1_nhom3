<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm theo danh mục - TechStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .product-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .product-image {
            height: 200px;
            object-fit: cover;
        }
        .price {
            color: #e44d26;
            font-weight: bold;
            font-size: 1.2em;
        }
        .category-title {
            background: #f8f9fa;
            padding: 20px 0;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
        }
        .filter-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <?php include 'views/header.php'; ?>

    <!-- Tiêu đề danh mục -->
    <div class="category-title">
        <div class="container">
            <h1 class="text-center mb-0">
                <?php echo htmlspecialchars($category['TenDanhMuc']); ?>
            </h1>
        </div>
    </div>

    <div class="container py-4">
        <!-- Bộ lọc sản phẩm -->
        <div class="filter-section">
            <form action="" method="GET" class="row g-3">
                <input type="hidden" name="act" value="category">
                <input type="hidden" name="category_id" value="<?php echo $category['MaDanhMuc']; ?>">
                
                <div class="col-md-3">
                    <label class="form-label">Sắp xếp theo:</label>
                    <select name="sort" class="form-select">
                        <option value="newest">Mới nhất</option>
                        <option value="price_asc">Giá tăng dần</option>
                        <option value="price_desc">Giá giảm dần</option>
                        <option value="name_asc">Tên A-Z</option>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Khoảng giá:</label>
                    <select name="price_range" class="form-select">
                        <option value="">Tất cả</option>
                        <option value="0-5000000">Dưới 5 triệu</option>
                        <option value="5000000-10000000">5 - 10 triệu</option>
                        <option value="10000000-20000000">10 - 20 triệu</option>
                        <option value="20000000-999999999">Trên 20 triệu</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">Lọc sản phẩm</button>
                </div>
            </form>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="row g-4">
            <?php if (empty($products)): ?>
                <div class="col-12 text-center">
                    <p class="lead">Không có sản phẩm nào trong danh mục này.</p>
                </div>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="card h-100 product-card">
                            <img src="images/<?php echo htmlspecialchars($product['AnhDaiDien']); ?>" 
                                 class="card-img-top product-image" 
                                 alt="<?php echo htmlspecialchars($product['TenSanPham']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['TenSanPham']); ?></h5>
                                <p class="card-text">
                                    <small class="text-muted"><?php echo htmlspecialchars($product['TenDanhMuc']); ?></small>
                                </p>
                                <?php 
                                    $description = htmlspecialchars($product['MoTa']);
                                    if (strlen($description) > 100) {
                                        $description = substr($description, 0, 100) . '...';
                                    }
                                ?>
                                <p class="card-text"><?php echo $description; ?></p>
                                <p class="price"><?php echo number_format($product['Gia'], 0, ',', '.'); ?> VNĐ</p>
                                <div class="d-flex justify-content-between">
                                    <a href="index.php?act=product-detail&id=<?php echo $product['MaSanPham']; ?>" 
                                       class="btn btn-primary">Chi tiết</a>
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
            <?php endif; ?>
        </div>

        <!-- Phân trang -->
        <?php if ($total_pages > 1): ?>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php if ($current_page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?act=category&category_id=<?php echo $category['MaDanhMuc']; ?>&page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                        <a class="page-link" href="index.php?act=category&category_id=<?php echo $category['MaDanhMuc']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?act=category&category_id=<?php echo $category['MaDanhMuc']; ?>&page=<?php echo $current_page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>
    </div>

    <!-- FOOTER -->
    <?php include 'views/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 