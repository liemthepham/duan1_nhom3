<?php
class Category {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getCategoryById($categoryId) {
        $sql = "SELECT * FROM danhmuc WHERE MaDanhMuc = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCategories() {
        $sql = "SELECT * FROM danhmuc ORDER BY TenDanhMuc ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?> 