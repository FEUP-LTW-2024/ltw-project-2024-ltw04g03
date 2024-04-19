<?php
class Brand {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getBrands() {
        $stmt = $this->pdo->prepare("SELECT * FROM brands");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
}
?>