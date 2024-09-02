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

// Check if hotelId is provided
if (isset($_GET['id'])) {
    $hotelId = $_GET['id'];

    // Fetch hotel details by ID
    $sql = 'SELECT * FROM hotels WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$hotelId]);
    $hotel = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($hotel);
} else {
    echo json_encode(['error' => 'Hotel ID not provided.']);
}
?>
