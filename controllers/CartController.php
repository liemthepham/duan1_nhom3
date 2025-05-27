<?php
class CartController
{
    public function viewCart() {
        global $pdo;
        
        $cartItems = [];
        $total = 0;

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $productIds = array_keys($_SESSION['cart']);
            // Tạo chuỗi placeholders cho câu truy vấn IN
            $placeholders = str_repeat('?, ', count($productIds) - 1) . '?';
            
            $stmt = $pdo->prepare("SELECT * FROM sanpham WHERE MaSanPham IN ($placeholders)");
            $stmt->execute($productIds);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as $product) {
                $quantity = $_SESSION['cart'][$product['MaSanPham']];
                $subtotal = $product['Gia'] * $quantity;
                $total += $subtotal;

                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ];
            }
        }

        require_once 'views/cart.php';
    }

    public function addToCart() {
        // Bắt đầu session nếu chưa có
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Khởi tạo giỏ hàng nếu chưa có trong session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $productId = $_POST['product_id'] ?? 0;
        $quantity = $_POST['quantity'] ?? 1;
        
        if ($productId > 0 && $quantity > 0) {
             // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            if (isset($_SESSION['cart'][$productId])) {
                // Nếu có rồi thì cập nhật số lượng
                $_SESSION['cart'][$productId] += $quantity;
            } else {
                // Nếu chưa có thì thêm mới
                $_SESSION['cart'][$productId] = $quantity;
            }
            $_SESSION['success_msg'] = "Đã thêm sản phẩm vào giỏ hàng!";
        } else {
             $_SESSION['error_msg'] = "Sản phẩm hoặc số lượng không hợp lệ!";
        }

        // Chuyển hướng về trang trước hoặc trang chủ
        header('Location: index.php?act=cart');
        exit;
    }

    public function removeFromCart() {
        // Bắt đầu session nếu chưa có
         if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $productId = $_GET['id'] ?? 0;
        
        if ($productId > 0) {
            if (isset($_SESSION['cart'][$productId])) {
                unset($_SESSION['cart'][$productId]);
                 $_SESSION['success_msg'] = "Đã xóa sản phẩm khỏi giỏ hàng!";
            }
        } else {
             $_SESSION['error_msg'] = "ID sản phẩm không hợp lệ!";
        }

        // Chuyển hướng về trang trước hoặc trang giỏ hàng
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? 'index.php?act=cart'));
         exit;
    }

    public function updateCart() {
         // Bắt đầu session nếu chưa có
         if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
            foreach ($_POST['quantity'] as $productId => $quantity) {
                // Đảm bảo productId và quantity là số nguyên dương
                $productId = (int) $productId;
                $quantity = (int) $quantity;

                if ($productId > 0) {
                    if ($quantity > 0) {
                         $_SESSION['cart'][$productId] = $quantity;
                    } else {
                         // Nếu số lượng <= 0, xóa sản phẩm khỏi giỏ
                        unset($_SESSION['cart'][$productId]);
                    }
                }
            }
             $_SESSION['success_msg'] = "Đã cập nhật giỏ hàng!";
        } else {
             $_SESSION['error_msg'] = "Dữ liệu cập nhật giỏ hàng không hợp lệ!";
        }

        // Chuyển hướng về trang giỏ hàng
        header('Location: index.php?act=cart');
         exit;
    }
} 