<?php
class Database {
    private static $instance = null;
    private $db;

    private function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=connectbd', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->db;
    }
}
?>