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

// Check if form data is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action']; // Action to determine if it's an edit or add

    if ($action === 'edit') {
        $id = $_POST['hotelId'];
        $hotelName = $_POST['hotelName'];
        $janPrice = $_POST['janPrice'];
        $febPrice = $_POST['febPrice'];
        $marPrice = $_POST['marPrice'];
        $aprPrice = $_POST['aprPrice'];
        $mayPrice = $_POST['mayPrice'];
        $junPrice = $_POST['junPrice'];
        $julPrice = $_POST['julPrice'];
        $augPrice = $_POST['augPrice'];
        $sepPrice = $_POST['sepPrice'];
        $octPrice = $_POST['octPrice'];
        $novPrice = $_POST['novPrice'];
        $decPrice = $_POST['decPrice'];
        $distance = $_POST['distance'];

        // Update hotel data
        $sql = 'UPDATE hotels SET hotel_name = ?, jan_price = ?, feb_price = ?, mar_price = ?, apr_price = ?, may_price = ?, jun_price = ?, jul_price = ?, aug_price = ?, sep_price = ?, oct_price = ?, nov_price = ?, dec_price = ?, distance = ? WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$hotelName, $janPrice, $febPrice, $marPrice, $aprPrice, $mayPrice, $junPrice, $julPrice, $augPrice, $sepPrice, $octPrice, $novPrice, $decPrice, $distance, $id]);

        if ($result) {
            echo json_encode(['success' => 'Hotel updated successfully.']);
        } else {
            echo json_encode(['error' => 'Failed to update hotel.']);
        }
    } elseif ($action === 'add') {
        $hotelName = $_POST['hotelName'];
        $janPrice = $_POST['janPrice'];
        $febPrice = $_POST['febPrice'];
        $marPrice = $_POST['marPrice'];
        $aprPrice = $_POST['aprPrice'];
        $mayPrice = $_POST['mayPrice'];
        $junPrice = $_POST['junPrice'];
        $julPrice = $_POST['julPrice'];
        $augPrice = $_POST['augPrice'];
        $sepPrice = $_POST['sepPrice'];
        $octPrice = $_POST['octPrice'];
        $novPrice = $_POST['novPrice'];
        $decPrice = $_POST['decPrice'];
        $distance = $_POST['distance'];

        // Insert new hotel data
        $sql = 'INSERT INTO hotels (hotel_name, jan_price, feb_price, mar_price, apr_price, may_price, jun_price, jul_price, aug_price, sep_price, oct_price, nov_price, dec_price, distance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$hotelName, $janPrice, $febPrice, $marPrice, $aprPrice, $mayPrice, $junPrice, $julPrice, $augPrice, $sepPrice, $octPrice, $novPrice, $decPrice, $distance]);

        if ($result) {
            echo json_encode(['success' => 'New hotel added successfully.']);
        } else {
            echo json_encode(['error' => 'Failed to add new hotel.']);
        }
    } else {
        echo json_encode(['error' => 'Invalid action.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
