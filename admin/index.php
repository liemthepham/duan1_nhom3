<?php 

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/ProductController.php';

// Require toàn bộ file Models
require_once 'models/ProductModel.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
require_once 'views/layouts/layouts_top.php';

match ($act) {
    // Dashboards
    '/'                 => (new DashboardController())->index(),
    'product-list' =>(new ProductController()) -> getAllProduct(),
    // 'product-add' =>(new ProductController()) -> addProduct(),
    
};


require_once 'views/layouts/layout_bottom.php';
