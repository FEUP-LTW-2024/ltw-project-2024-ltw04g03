<?php
class Device {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getDevices() {
        $stmt = $this->pdo->prepare("SELECT * FROM devices");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getDevicesByModel($model_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM devices WHERE model_id = :model_id");
        $stmt->execute(['model_id' => $model_id]);
        return $stmt->fetchAll();
    }

    public function getDevicesByReleaseDate($date) {
        $stmt = $this->pdo->prepare("SELECT * FROM devices WHERE released_at = :date");
        $stmt->execute(['date' => $date]);
        return $stmt->fetchAll();
    }

    public function getDevicesByStorage($storage) {
        $stmt = $this->pdo->prepare("SELECT * FROM devices WHERE storage = :storage");
        $stmt->execute(['storage' => $storage]);
        return $stmt->fetchAll();
    }

    public function getDevicesByRam($ram) {
        $stmt = $this->pdo->prepare("SELECT * FROM devices WHERE ram = :ram");
        $stmt->execute(['ram' => $ram]);
        return $stmt->fetchAll();
    }

    public function getDevicesByDisplaySize($size) {
        $stmt = $this->pdo->prepare("SELECT * FROM devices WHERE display_size = :size");
        $stmt->execute(['size' => $size]);
        return $stmt->fetchAll();
    }
}
?>