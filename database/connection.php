<?php
function connect_to_db() {
    $database_path = __DIR__ . '/database/database.db';

    try {
        $db = new PDO('sqlite:' . $database_path);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    }

    return $db;
}
?>