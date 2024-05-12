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

    public function getModelsByBrand($name) {
        $stmt = $this->pdo->prepare("SELECT * FROM models WHERE name = :name");
        $stmt->execute(['name' => $name]);
        return $stmt->fetchAll();
    }
}
?>