<?php
class Database extends PDO {
    private static $instance = null;

    public function __construct() {
        try {
            // Kết nối trực tiếp đến database
            parent::__construct(
                "mysql:host=localhost;dbname=du_an_1;charset=utf8mb4",
                "root",  // username mặc định của Laragon
                "",      // password mặc định của Laragon là trống
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            die("Lỗi kết nối database: " . $e->getMessage());
        }
    }

    // Singleton pattern để đảm bảo chỉ có một kết nối database
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
?> 