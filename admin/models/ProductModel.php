<?php

class ProductModel{
  private $conn;

  public function __construct() {
    $this->conn = connectDB();
  }

  public function get_list(){
      $sql = "SELECT 
                  MaSanPham,
                  MaDanhMuc, 
                  TenSanPham, 
                  Mota, 
                  Gia,
                  SoLuongTon,
                  AnhDaiDien,
                  NgayTao
              FROM sanpham";
      $data = $this->conn->prepare($sql);
      $data->execute();
      return $data->fetchAll(PDO::FETCH_ASSOC);
  }
}