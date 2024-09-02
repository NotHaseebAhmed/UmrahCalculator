<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_cal";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$hotelId = $_POST['hotelId'];
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

if ($hotelId) {
    // Update existing record
    $sql = "UPDATE hotel_prices SET hotel_name = ?, jan_price = ?, feb_price = ?, mar_price = ?, apr_price = ?, may_price = ?, jun_price = ?, jul_price = ?, aug_price = ?, sep_price = ?, oct_price = ?, nov_price = ?, dec_price = ?, distance = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssssssdi', $hotelName, $janPrice, $febPrice, $marPrice, $aprPrice, $mayPrice, $junPrice, $julPrice, $augPrice, $sepPrice, $octPrice, $novPrice, $decPrice, $distance, $hotelId);
} else {
    // Insert new record
    $sql = "INSERT INTO hotel_prices (hotel_name, jan_price, feb_price, mar_price, apr_price, may_price, jun_price, jul_price, aug_price, sep_price, oct_price, nov_price, dec_price, distance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssssssd', $hotelName, $janPrice, $febPrice, $marPrice, $aprPrice, $mayPrice, $junPrice, $julPrice, $augPrice, $sepPrice, $octPrice, $novPrice, $decPrice, $distance);
}

if ($stmt->execute()) {
    if (!$hotelId) {
        $hotelId = $conn->insert_id;
    }
    echo json_encode(['success' => 'Prices and distance saved successfully!', 'hotelId' => $hotelId]);
} else {
    error_log('MySQL Error: ' . $stmt->error); // Log error for debugging
    echo json_encode(['error' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
