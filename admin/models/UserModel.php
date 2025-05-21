<?php
require_once __DIR__ . '/../../commons/function.php'; // chứa hàm connectDB()

class UserModel {
    private $db;
    public function __construct() {
        $this->db = connectDB();
    }

    /** Lấy tất cả người dùng */
    public function get_list() {
        $stmt = $this->db->query("SELECT * FROM nguoidung ORDER BY MaNguoiDung DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Lấy 1 user theo ID */
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM nguoidung WHERE MaNguoiDung = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** Tạo mới user */
    public function create($data) {
        $sql = "INSERT INTO nguoidung (TenDangNhap, Email, MatKhau, VaiTro, NgayTao)
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $hash = password_hash($data['MatKhau'], PASSWORD_DEFAULT);
        return $stmt->execute([
            $data['TenDangNhap'],
            $data['Email'],
            $hash,
            $data['VaiTro']
        ]);
    }

    /** Cập nhật user (nếu MatKhau để trống thì giữ nguyên) */
    public function update($id, $data) {
        if (!empty($data['MatKhau'])) {
            $sql = "UPDATE nguoidung
                       SET TenDangNhap=?, Email=?, MatKhau=?, VaiTro=?
                     WHERE MaNguoiDung=?";
            $hash = password_hash($data['MatKhau'], PASSWORD_DEFAULT);
            $params = [
                $data['TenDangNhap'],
                $data['Email'],
                $hash,
                $data['VaiTro'],
                $id
            ];
        } else {
            $sql = "UPDATE nguoidung
                       SET TenDangNhap=?, Email=?, VaiTro=?
                     WHERE MaNguoiDung=?";
            $params = [
                $data['TenDangNhap'],
                $data['Email'],
                $data['VaiTro'],
                $id
            ];
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    /** Xóa user */
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM nguoidung WHERE MaNguoiDung = ?");
        return $stmt->execute([$id]);
    }
    //phần đăng ký đăng nhập
     public function findByLogin($login) {
        $stmt = $this->db->prepare(
          "SELECT * FROM nguoidung WHERE TenDangNhap = ? OR Email = ?"
        );
        $stmt->execute([$login, $login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
