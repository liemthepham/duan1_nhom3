-- Tạo database
CREATE DATABASE IF NOT EXISTS duan1 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Sử dụng database
USE duan1;

-- Tạo bảng danh mục
CREATE TABLE IF NOT EXISTS danhmuc (
    MaDanhMuc INT AUTO_INCREMENT PRIMARY KEY,
    TenDanhMuc VARCHAR(100) NOT NULL,
    MoTa TEXT,
    NgayTao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tạo bảng sản phẩm
CREATE TABLE IF NOT EXISTS sanpham (
    MaSanPham INT AUTO_INCREMENT PRIMARY KEY,
    TenSanPham VARCHAR(200) NOT NULL,
    MoTa TEXT,
    Gia DECIMAL(12,2) NOT NULL,
    AnhDaiDien VARCHAR(255),
    MaDanhMuc INT,
    SoLuong INT DEFAULT 0,
    NgayTao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (MaDanhMuc) REFERENCES danhmuc(MaDanhMuc)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Thêm dữ liệu mẫu cho danh mục
INSERT INTO danhmuc (TenDanhMuc, MoTa) VALUES
('Điện thoại', 'Các loại điện thoại di động'),
('Laptop', 'Máy tính xách tay'),
('Máy tính bảng', 'Các loại máy tính bảng'),
('Phụ kiện', 'Phụ kiện điện thoại và máy tính'),
('Đồng hồ thông minh', 'Smartwatch và đồng hồ thông minh'),
('Máy ảnh', 'Máy ảnh và thiết bị quay phim'),
('Loa', 'Loa và thiết bị âm thanh'),
('Tai nghe', 'Tai nghe và headphone');

-- Thêm dữ liệu mẫu cho sản phẩm
INSERT INTO sanpham (TenSanPham, MoTa, Gia, AnhDaiDien, MaDanhMuc, SoLuong) VALUES
('iPhone 14 Pro Max', 'iPhone 14 Pro Max 256GB', 29990000, 'iphone14.jpg', 1, 10),
('Samsung Galaxy S23 Ultra', 'Samsung Galaxy S23 Ultra 512GB', 27990000, 's23ultra.jpg', 1, 15),
('MacBook Pro M2', 'MacBook Pro 14 inch M2 2023', 39990000, 'macbook.jpg', 2, 8),
('iPad Pro 12.9', 'iPad Pro 12.9 inch 2023', 29990000, 'ipad.jpg', 3, 12),
('AirPods Pro 2', 'Tai nghe không dây Apple AirPods Pro 2', 5990000, 'airpods.jpg', 4, 20),
('Apple Watch Series 8', 'Đồng hồ thông minh Apple Watch Series 8', 9990000, 'watch.jpg', 5, 15),
('Sony A7IV', 'Máy ảnh Sony Alpha A7IV', 45990000, 'sony.jpg', 6, 5),
('JBL Charge 5', 'Loa Bluetooth JBL Charge 5', 3990000, 'jbl.jpg', 7, 25),
('Sony WH-1000XM5', 'Tai nghe chống ồn Sony WH-1000XM5', 7990000, 'sony-headphone.jpg', 8, 18); 