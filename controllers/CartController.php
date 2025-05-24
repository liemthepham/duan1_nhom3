<?php
class CartController
{
    public function index()
    {
        // Lấy danh sách sản phẩm trong giỏ hàng từ session
        $cart = $_SESSION['cart'] ?? [];

        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Render view
        require_once './views/cart/index.php';
    }

    public function add()
    {
        // 1. Đảm bảo session đã start
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 2. Nếu chưa login, redirect về trang login
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=auth-login');
            exit;
        }

        // 3. Nếu đã POST thì xử lý thêm giỏ
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? 0;
            $quantity  = $_POST['quantity']   ?? 1;

            // Lấy data product từ model
            $product = $this->getProduct($productId);
            if ($product) {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                session_start();
                if (!isset($_SESSION['customer'])) {
                    // chuyển về lại index và bật modal
                    header('Location: index.php?act=need_login');
                    exit;
                }

                // Tìm xem đã có trong giỏ chưa
                $found = false;
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['id'] == $productId) {
                        $item['quantity'] += $quantity;
                        $found = true;
                        break;
                    }
                }
                unset($item);

                // Nếu chưa có thì thêm mới
                if (!$found) {
                    $_SESSION['cart'][] = [
                        'id'       => $productId,
                        'name'     => $product['name'],
                        'price'    => $product['price'],
                        'image'    => $product['image'],
                        'quantity' => $quantity,
                    ];
                }

                // Chuyển về trang giỏ hàng
                header('Location: index.php?act=cart-index');
                exit;
            }
        }

        // Nếu không phải POST hoặc có lỗi => quay về home
        header('Location: index.php');
        exit;
    }



    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? 0;
            $quantity = $_POST['quantity'] ?? 1;

            // Cập nhật số lượng trong giỏ hàng
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['id'] === $productId) {
                        $item['quantity'] = $quantity;
                        break;
                    }
                }
            }

            // Redirect về trang giỏ hàng
            header('Location: cart.php');
            exit;
        }

        // Nếu có lỗi thì redirect về trang chủ
        header('Location: index.php');
        exit;
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? 0;

            // Xóa sản phẩm khỏi giỏ hàng
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => $item) {
                    if ($item['id'] === $productId) {
                        unset($_SESSION['cart'][$key]);
                        break;
                    }
                }
                // Reindex array
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }

            // Redirect về trang giỏ hàng
            header('Location: cart.php');
            exit;
        }

        // Nếu có lỗi thì redirect về trang chủ
        header('Location: index.php');
        exit;
    }

    private function getProduct($id)
    {
        // TODO: Lấy thông tin sản phẩm từ database
        // Tạm thời return dữ liệu mẫu
        return [
            'id' => $id,
            'name' => 'Sản phẩm ' . $id,
            'price' => 1000000,
            'image' => 'https://via.placeholder.com/100'
        ];
    }
}
