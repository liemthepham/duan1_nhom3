<?php
session_set_cookie_params(['path' => '/', 'httponly' => true]);
session_start();

$act = $_GET['act'] ?? 'dashboard';
$publicRoutes = ['auth-login', 'auth-register'];

if (!in_array($act, $publicRoutes) && $_SESSION['user']['VaiTro'] !="admin") {
  // chưa login admin
  header('Location: /duan1_nhom3/admin/index.php?act=auth-login');
  exit;
}

// var_dump($_SESSION);
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/CategoryController.php';
require_once __DIR__ . '/controllers/OrderController.php';

// Require toàn bộ file Models
require_once 'models/ProductModel.php';
//quản lí user
require_once __DIR__ . '/controllers/UserController.php';
//login
require_once __DIR__ . '/controllers/AuthController.php';




// Route
$act = $_GET['act'] ?? '/';

// require_once 'views/layouts/layouts_top.php';
// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {

  //sanpham
  'product-list' => (new ProductController())->index(),
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
  //quan li user
  'user-list'   => (new UserController())->index(),
  'user-add'    => (new UserController())->add(),
  'user-edit'   => (new UserController())->edit(),
  'user-delete' => (new UserController())->delete(),
  //login
  'auth-register' => (new AuthController())->register(),
  'auth-login'    => (new AuthController())->login(),
  'auth-logout'   => (new AuthController())->logout(),
  'dashboard'      => (new DashboardController())->index(),

  //oder
  'order-list'     => (new OrderController())->index(),
  default => (new DashboardController())->index(),
};
// require_once 'views/layouts/layout_bottom.php';
