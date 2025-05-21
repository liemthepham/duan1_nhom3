<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    /** Hiển thị form đăng ký & xử lý đăng ký */
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Kiểm tra trùng username/email
            $exists = $this->userModel->findByLogin($_POST['TenDangNhap']);
            if ($exists) {
                $error = "Tên đăng nhập hoặc email đã tồn tại.";
            } else {
                // 2. Tạo mới
                $this->userModel->create($_POST);
                header('Location: index.php?act=auth-login');
                exit;
            }
        }
        require __DIR__.'/../views/layouts/layouts_top.php';
        require __DIR__.'/../views/Auth/register.php';
        require __DIR__.'/../views/layouts/layout_bottom.php';
    }

    /** Hiển thị form login & xử lý login */
    public function login() {
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
                  header('Location: ../index.php'); 
                }
                exit;
            }
            $error = "Đăng nhập không thành công.";
        }
        require __DIR__.'/../views/layouts/layouts_top.php';
        require __DIR__.'/../views/Auth/login.php';
        require __DIR__.'/../views/layouts/layout_bottom.php';
    }

    /** Đăng xuất */
    public function logout() {
        session_destroy();
        header('Location: index.php?act=auth-login');
        exit;
    }
}
