<?php 

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/CategoryController.php';
// Require toàn bộ file Models
require_once 'models/ProductModel.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Dashboards
    '/'                 => (new DashboardController())->index(),
    //sanpham
    'product-list' =>(new ProductController()) -> index(),
    'product-add' => (new ProductController())->add(),
    'product-edit' => (new ProductController())->edit(),
    'product-delete' => (new ProductController())->delete(),    


    //danhmucc
    'category-list'   => (new CategoryController())->index(),
    'category-add'    => (new CategoryController())->add(),
     //(URL: ?act=category-edit&id=3)
    'category-edit'   => (new CategoryController())->edit(),
     //(URL: ?act=category-delete&id=3)
    'category-delete' => (new CategoryController())->delete(),
    
};

require_once 'views/layouts/layouts_top.php';
require_once 'views/layouts/layout_bottom.php';
