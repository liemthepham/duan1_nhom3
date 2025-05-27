<?php
session_start();

require_once 'config/database.php';
// require_once 'controllers/HomeController.php'; // Sẽ tạo lại sau
require_once 'controllers/ProductController.php';
require_once 'controllers/CartController.php';
require_once 'controllers/CheckoutController.php';

$productController = new ProductController($pdo);
$cartController = new CartController();
$checkoutController = new CheckoutController($pdo);
// $homeController = new HomeController($pdo); // Sẽ tạo lại sau

$act = $_GET['act'] ?? 'home';

switch ($act) {
    case 'home':
        // Hiển thị trang chủ

        // Pagination settings
        $items_per_page = 8; // Số sản phẩm trên mỗi trang
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($current_page - 1) * $items_per_page;

        // Get total number of products for pagination
        $countStmt = $pdo->query("SELECT COUNT(*) FROM sanpham");
        $total_items = $countStmt->fetchColumn();
        $total_pages = ceil($total_items / $items_per_page);

        // Fetch products with pagination
        $stmt = $pdo->prepare("SELECT s.*, d.TenDanhMuc
                            FROM sanpham s
                            JOIN danhmuc d ON s.MaDanhMuc = d.MaDanhMuc
                            ORDER BY s.NgayTao DESC
                            LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $items_per_page, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch categories to display in the filter section
        $categoryStmt = $pdo->query("SELECT * FROM danhmuc");
        $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

        require_once 'views/index.php';
        break;

    case 'product-detail':
        // Hiển thị chi tiết sản phẩm
        $id = $_GET['id'] ?? 0;
        $productController->show($id);
        break;

    case 'add-comment':
        // Thêm bình luận
        $productController->addComment();
        break;

    case 'add-to-cart':
        // Thêm vào giỏ hàng
        $cartController->addToCart();
        break;

    case 'remove-from-cart':
        // Xóa khỏi giỏ hàng
        $cartController->removeFromCart();
        break;

    case 'update-cart':
        // Cập nhật giỏ hàng
        $cartController->updateCart();
        break;

    case 'cart':
        // Xem giỏ hàng
        $cartController->viewCart();
        break;

    case 'checkout':
        // Hiển thị trang thanh toán
        $checkoutController->index();
        break;

    case 'process-checkout':
        // Xử lý đặt hàng
        $checkoutController->process($pdo);
        break;

    case 'order-success':
        $checkoutController->orderSuccess();
        break;

    // Thêm các case cho đăng nhập/đăng ký/thanh toán sau

    default:
        // Trang 404
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
        break;
}
