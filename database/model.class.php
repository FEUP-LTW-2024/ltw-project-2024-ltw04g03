<?php
class Model {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getModels() {
        $stmt = $this->pdo->prepare("SELECT * FROM models");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getModelsByBrand($brand_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM models WHERE brand_id = :brand_id");
        $stmt->execute(['brand_id' => $brand_id]);
        return $stmt->fetchAll();
    }
}
?>