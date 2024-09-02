<?php
// Database connection
$dsn = 'mysql:host=localhost;dbname=php_cal';
$username = 'root';
$password = '';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Fetch hotel names and distances
$sql = 'SELECT id, hotel_name, distance FROM hotels';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($hotels);
?>
