<?php
require_once __DIR__ . '/../models/CategoryModel.php';

class CategoryController {
    private $model;
    public function __construct() {
        $this->model = new CategoryModel();
    }

    // Hiện form và xử lý POST
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
           header('Location: index.php?act=category-list');
            exit;
        }
        // Lấy danh mục để chọn cha
        $parents = $this->model->getAll();
        require __DIR__ . '/../views/Product/danhmuc/add.php';
    }

    // Sửa
    public function edit() {
        $id = $_GET['id'] ?? null;
        $item = $this->model->find($id);
        if (!$item) {
            die("Danh mục #{$id} không tồn tại");
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header('Location: index.php?act=category-list');
            exit;
        }
        $parents = $this->model->getAll();
        require __DIR__ . '/../views/Product/danhmuc/edit.php';
    }

    // Xóa
    public function delete() {
        $id = $_GET['id'] ?? null;
        $this->model->delete($id);
        header('Location: index.php?act=category-list');
        exit;
    }

    // Danh sách
    public function index() {
        $list = $this->model->getAll();
        require __DIR__ . '/../views/Product/danhmuc/list.php';
    }
}
