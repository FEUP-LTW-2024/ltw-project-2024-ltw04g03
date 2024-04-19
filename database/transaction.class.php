<?php
class Transaction {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createTransaction($deviceId, $buyerId, $sellerId, $price) {
        $stmt = $this->pdo->prepare("INSERT INTO Transaction (device_id, buyer_id, seller_id, transaction_date, price) VALUES (:deviceId, :buyerId, :sellerId, NOW(), :price)");
        $stmt->execute(['deviceId' => $deviceId, 'buyerId' => $buyerId, 'sellerId' => $sellerId, 'price' => $price]);
    }

    public function getTransactionsByBuyerId($buyerId) {
        $stmt = $this->pdo->prepare("SELECT * FROM Transaction WHERE buyer_id = :buyerId");
        $stmt->execute(['buyerId' => $buyerId]);
        return $stmt->fetchAll();
    }

    public function getTransactionsBySellerId($sellerId) {
        $stmt = $this->pdo->prepare("SELECT * FROM Transaction WHERE seller_id = :sellerId");
        $stmt->execute(['sellerId' => $sellerId]);
        return $stmt->fetchAll();
    }

    public function getTransactionsByDeviceId($deviceId) {
        $stmt = $this->pdo->prepare("SELECT * FROM Transaction WHERE device_id = :deviceId");
        $stmt->execute(['deviceId' => $deviceId]);
        return $stmt->fetchAll();
    }

    public function getAllTransactions() {
        $stmt = $this->pdo->prepare("SELECT * FROM Transaction");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>