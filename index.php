<?php
session_start();


require_once 'config/database.php';
// require_once 'controllers/HomeController.php'; // Sẽ tạo lại sau
require_once 'controllers/FrontProductController.php';

require_once 'controllers/CartController.php';
require_once 'controllers/CheckoutController.php';

$productController = new FrontProductController($pdo);
$cartController = new CartController();
$checkoutController = new CheckoutController($pdo);
$categoryController = new CategoryController();
// $homeController = new HomeController($pdo); // Sẽ tạo lại sau

$act = $_GET['act'] ?? 'home';

switch ($act) {
    case 'home':
        // Hiển thị trang chủ

        // Pagination settings
        $items_per_page = 8; // Số sản phẩm trên mỗi trang
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($current_page - 1) * $items_per_page;

        // Lấy category_id từ URL nếu có
        $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

        // Chuẩn bị câu query cơ bản
        $baseQuery = "FROM sanpham s JOIN danhmuc d ON s.MaDanhMuc = d.MaDanhMuc";
        $whereClause = "";
        $params = array();
        
        // Thêm điều kiện lọc theo danh mục nếu có
        if ($category_id) {
            $whereClause .= ($whereClause ? " AND" : " WHERE") . " s.MaDanhMuc = :category_id";
            $params[':category_id'] = $category_id;
        }

        // Thêm điều kiện tìm kiếm theo tên sản phẩm
        if (!empty($_GET['search'])) {
            $search = '%' . $_GET['search'] . '%';
            $whereClause .= ($whereClause ? " AND" : " WHERE") . " s.TenSanPham LIKE :search";
            $params[':search'] = $search;
        }

        // Thêm điều kiện lọc theo giá
        if (!empty($_GET['min_price'])) {
            $whereClause .= ($whereClause ? " AND" : " WHERE") . " s.GiaBan >= :min_price";
            $params[':min_price'] = $_GET['min_price'];
        }
        if (!empty($_GET['max_price'])) {
            $whereClause .= ($whereClause ? " AND" : " WHERE") . " s.GiaBan <= :max_price";
            $params[':max_price'] = $_GET['max_price'];
        }

        // Đếm tổng số sản phẩm cho phân trang
        $countQuery = "SELECT COUNT(*) " . $baseQuery . $whereClause;
        $countStmt = $pdo->prepare($countQuery);
        foreach ($params as $key => $value) {
            $countStmt->bindValue($key, $value);
        }
        $countStmt->execute();
        $total_items = $countStmt->fetchColumn();
        $total_pages = ceil($total_items / $items_per_page);

        // Query lấy sản phẩm với phân trang
        $productQuery = "SELECT s.*, d.TenDanhMuc, COALESCE(SUM(ct.SoLuong), 0) as SoLuongBan 
                       FROM sanpham s 
                       JOIN danhmuc d ON s.MaDanhMuc = d.MaDanhMuc
                       LEFT JOIN chitietdonhang ct ON s.MaSanPham = ct.MaSanPham
                       " . $whereClause . "
                       GROUP BY s.MaSanPham
                       ORDER BY s.NgayTao DESC 
                       LIMIT :limit OFFSET :offset";
        
        $stmt = $pdo->prepare($productQuery);
        
        // Bind các tham số lọc
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $items_per_page, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Lấy danh sách danh mục
        $categoryStmt = $pdo->query("SELECT * FROM danhmuc");
        $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

        // Lấy sản phẩm gợi ý (4 sản phẩm ngẫu nhiên khác với sản phẩm đang xem)
        $suggestQuery = "SELECT s.*, d.TenDanhMuc 
                        FROM sanpham s 
                        JOIN danhmuc d ON s.MaDanhMuc = d.MaDanhMuc 
                        ORDER BY RAND() 
                        LIMIT 4";
        $suggestStmt = $pdo->query($suggestQuery);
        $suggestedProducts = $suggestStmt->fetchAll(PDO::FETCH_ASSOC);

        // Lấy tên danh mục đang được chọn (nếu có)
        $selected_category_name = '';
        if ($category_id) {
            foreach ($categories as $cat) {
                if ($cat['MaDanhMuc'] == $category_id) {
                    $selected_category_name = $cat['TenDanhMuc'];
                    break;
                }
            }
        }

        require_once 'views/index.php';
        break;



    case 'products':
        require_once __DIR__ . '/controllers/FrontProductController.php';
        (new FrontProductController())->index();
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
