<?php
/**
 * DATABASE CONFIGURATION
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'chatbot_konsultasi');

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    error_log("✅ Database connected");
} catch (PDOException $e) {
    error_log("❌ Database connection failed: " . $e->getMessage());
    die(json_encode(['error' => 'Database connection failed']));
}
?>
