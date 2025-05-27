<?php
class ProductController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function show($id) {
        // Lấy thông tin chi tiết sản phẩm
        $stmt = $this->pdo->prepare("
            SELECT s.*, d.TenDanhMuc 
            FROM sanpham s 
            JOIN danhmuc d ON s.MaDanhMuc = d.MaDanhMuc 
            WHERE s.MaSanPham = ?
        ");
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            header('Location: index.php');
            exit;
        }

        // Lấy các sản phẩm liên quan (cùng danh mục)
        $stmt = $this->pdo->prepare("
            SELECT * FROM sanpham 
            WHERE MaDanhMuc = ? AND MaSanPham != ? 
            LIMIT 4
        ");
        $stmt->execute([$product['MaDanhMuc'], $id]);
        $relatedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Lấy bình luận của sản phẩm
        $stmt = $this->pdo->prepare("
            SELECT b.*, n.TenDangNhap 
            FROM binhluan b
            JOIN nguoidung n ON b.MaNguoiDung = n.MaNguoiDung
            WHERE b.MaSanPham = ?
            ORDER BY b.NgayBinhLuan DESC
        ");
        $stmt->execute([$id]);
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once 'views/product-detail.php';
    }

    public function addComment() {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để bình luận!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? 0;
            $content = $_POST['content'] ?? '';
            $userId = $_SESSION['user']['MaNguoiDung'];

            if (empty($content)) {
                $_SESSION['error'] = "Nội dung bình luận không được để trống!";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $stmt = $this->pdo->prepare("
                INSERT INTO binhluan (MaSanPham, MaNguoiDung, NoiDung, NgayBinhLuan)
                VALUES (?, ?, ?, NOW())
            ");
            
            if ($stmt->execute([$productId, $userId, $content])) {
                $_SESSION['success'] = "Bình luận đã được thêm thành công!";
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi thêm bình luận!";
            }
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
} 