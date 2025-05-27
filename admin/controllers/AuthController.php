<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
    private $userModel;
    private string $viewRoot;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->viewRoot   = dirname(__DIR__) . '/views';
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userModel->findByLogin($_POST['login']);
            if ($user && password_verify($_POST['password'], $user['MatKhau'])) {
                // Lưu session
                $_SESSION['user'] = [
                    'id'        => $user['MaNguoiDung'],
                    'name'      => $user['TenDangNhap'],
                    'role'      => $user['VaiTro']
                ];
                // Redirect: nếu admin thì vào admin, else front
                if ($user['VaiTro'] === 'admin') {

                    header('Location: index.php?act=dashboard');
                } else {
                     $_SESSION['success_msg'] = '🎉 Đăng nhập thành công, chào mừng '.htmlspecialchars($user['TenDangNhap']).'!';
                    header('Location: /duan1/');
                }
                exit;
            }
            $error = "Đăng nhập không thành công.";
        }
        // include phần đầu
        require_once $this->viewRoot . '/layouts/authtop.php';
        // form login
        require_once $this->viewRoot . '/auth/login.php';
        // phần cuối
        require_once $this->viewRoot . '/layouts/authbottom.php';
    }
    /** Hiển thị form đăng ký & xử lý đăng ký */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['TenDangNhap']);
            $email    = trim($_POST['Email']);

            // 1. Check user or email exists

            $existsByUsername = $this->userModel->findByLogin($username);
            $existsByEmail    = $email ? $this->userModel->findByEmail($email) : false;

            if ($existsByUsername) {
                $error = "Tên đăng nhập đã tồn tại.";
            } elseif ($email && $existsByEmail) {
                $error = "Email này đã được đăng ký.";
            } else {
                // 2. Thử tạo user, bắt exception nếu có lỗi
                try {
                    $this->userModel->create($_POST);
                    header('Location: auth.php?act=auth-login');
                    exit;
                } catch (\PDOException $e) {
                    // Nếu duplicate key
                    if (strpos($e->getMessage(), '1062 Duplicate entry') !== false) {
                        $error = 'Username hoặc Email đã tồn tại.';
                    } else {
                        // Log $e->getMessage() nếu cần
                        $error = 'Có lỗi xảy ra, vui lòng thử lại sau.';
                    }
                }
            }
        }
        require_once $this->viewRoot . '/layouts/authtop.php';
        // form login
        require_once $this->viewRoot . '/auth/register.php';
        // phần cuối
        require_once $this->viewRoot . '/layouts/authbottom.php';
    }



    /** Đăng xuất */
    public function logout()
    {
        session_destroy();
        header('Location: index.php?act=auth-login');
        exit;
    }
}
