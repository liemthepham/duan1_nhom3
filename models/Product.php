<?php
class Product {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getProductsByCategory($categoryId, $offset, $limit, $orderBy, $priceCondition = '') {
        $sql = "SELECT p.*, d.TenDanhMuc 
                FROM sanpham p 
                JOIN danhmuc d ON p.MaDanhMuc = d.MaDanhMuc 
                WHERE p.MaDanhMuc = ? $priceCondition 
                ORDER BY $orderBy 
                LIMIT ? OFFSET ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId, $limit, $offset]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countProductsByCategory($categoryId, $priceCondition = '') {
        $sql = "SELECT COUNT(*) as total 
                FROM sanpham 
                WHERE MaDanhMuc = ? $priceCondition";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getProductById($productId) {
        $sql = "SELECT p.*, d.TenDanhMuc 
                FROM sanpham p 
                JOIN danhmuc d ON p.MaDanhMuc = d.MaDanhMuc 
                WHERE p.MaSanPham = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?> 