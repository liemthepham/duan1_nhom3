<?php
require_once 'models/Database.php';
require_once 'models/Product.php';
require_once 'models/Category.php';

class CategoryController {
    private $db;
    private $productModel;
    private $categoryModel;
    private $itemsPerPage = 8; // Số sản phẩm hiển thị trên mỗi trang

    public function __construct() {
        $this->db = Database::getInstance();
        $this->productModel = new Product($this->db);
        $this->categoryModel = new Category($this->db);
    }

    public function showCategory() {
        // Lấy category_id từ URL
        $categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
        
        // Lấy thông tin danh mục
        $category = $this->categoryModel->getCategoryById($categoryId);
        if (!$category) {
            header('Location: index.php');
            exit;
        }

        // Xử lý phân trang
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $currentPage = max(1, $currentPage); // Đảm bảo trang không nhỏ hơn 1

        // Xử lý bộ lọc
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
        $priceRange = isset($_GET['price_range']) ? $_GET['price_range'] : '';

        // Xây dựng điều kiện sắp xếp
        $orderBy = 'MaSanPham DESC'; // Mặc định sắp xếp theo mới nhất
        switch ($sort) {
            case 'price_asc':
                $orderBy = 'Gia ASC';
                break;
            case 'price_desc':
                $orderBy = 'Gia DESC';
                break;
            case 'name_asc':
                $orderBy = 'TenSanPham ASC';
                break;
        }

        // Xây dựng điều kiện khoảng giá
        $priceCondition = '';
        if ($priceRange) {
            list($minPrice, $maxPrice) = explode('-', $priceRange);
            $priceCondition = " AND Gia BETWEEN $minPrice AND $maxPrice";
        }

        // Lấy tổng số sản phẩm
        $totalProducts = $this->productModel->countProductsByCategory($categoryId, $priceCondition);
        $totalPages = ceil($totalProducts / $this->itemsPerPage);

        // Đảm bảo trang hiện tại không vượt quá tổng số trang
        $currentPage = min($currentPage, $totalPages);

        // Tính offset cho phân trang
        $offset = ($currentPage - 1) * $this->itemsPerPage;

        // Lấy danh sách sản phẩm
        $products = $this->productModel->getProductsByCategory(
            $categoryId,
            $offset,
            $this->itemsPerPage,
            $orderBy,
            $priceCondition
        );

        // Truyền dữ liệu sang view
        $viewData = [
            'category' => $category,
            'products' => $products,
            'current_page' => $currentPage,
            'total_pages' => $totalPages,
            'sort' => $sort,
            'price_range' => $priceRange
        ];

        // Load view
        include 'views/category.php';
    }
}
?> 