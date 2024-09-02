<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_cal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the hotel ID
$hotelIdMadina = $_POST['hotelIdMadina']; 

if (!empty($hotelIdMadina)) {
    // Update existing record
    $hotelName22 = $_POST['hotelName'];
    $janPrice22 = $_POST['janPrice'];
    $febPrice22 = $_POST['febPrice'];
    $marPrice22 = $_POST['marPrice'];
    $aprPrice22 = $_POST['aprPrice'];
    $mayPrice22 = $_POST['mayPrice'];
    $junPrice22 = $_POST['junPrice'];
    $julPrice22 = $_POST['julPrice'];
    $augPrice22 = $_POST['augPrice'];
    $sepPrice22 = $_POST['sepPrice'];
    $octPrice22 = $_POST['octPrice'];
    $novPrice22 = $_POST['novPrice'];
    $decPrice22 = $_POST['decPrice'];
    $distance22 = $_POST['distance'];

    $sql = "UPDATE hotelmadina SET hotel_name = ?, jan_price = ?, feb_price = ?, mar_price = ?, apr_price = ?, may_price = ?, jun_price = ?, jul_price = ?, aug_price = ?, sep_price = ?, oct_price = ?, nov_price = ?, dec_price = ?, distance = ? WHERE id = ?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param('sssssssssssssdi', $hotelName22, $janPrice22, $febPrice22, $marPrice22, $aprPrice22, $mayPrice22, $junPrice22, $julPrice22, $augPrice22, $sepPrice22, $octPrice22, $novPrice22, $decPrice22, $distance22, $hotelIdMadina);
} else {
    // Insert new record
    $hotelName22 = $_POST['hotelName2'];
    $janPrice22 = $_POST['janPrice2'];
    $febPrice22 = $_POST['febPrice2'];
    $marPrice22 = $_POST['marPrice2'];
    $aprPrice22 = $_POST['aprPrice2'];
    $mayPrice22 = $_POST['mayPrice2'];
    $junPrice22 = $_POST['junPrice2'];
    $julPrice22 = $_POST['julPrice2'];
    $augPrice22 = $_POST['augPrice2'];
    $sepPrice22 = $_POST['sepPrice2'];
    $octPrice22 = $_POST['octPrice2'];
    $novPrice22 = $_POST['novPrice2'];
    $decPrice22 = $_POST['decPrice2'];
    $distance22 = $_POST['distance2'];

    $sql = "INSERT INTO hotelmadina (hotel_name, jan_price, feb_price, mar_price, apr_price, may_price, jun_price, jul_price, aug_price, sep_price, oct_price, nov_price, dec_price, distance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param('ssssssssssssss', $hotelName22, $janPrice22, $febPrice22, $marPrice22, $aprPrice22, $mayPrice22, $junPrice22, $julPrice22, $augPrice22, $sepPrice22, $octPrice22, $novPrice22, $decPrice22, $distance22);
}

if ($stmt2->execute()) {
    // For inserting, get the last inserted ID and return it
    if (empty($hotelIdMadina)) {
        $hotelIdMadina = $conn->insert_id;
    }
    echo json_encode(['success' => 'Prices and distance saved successfully!', 'hotelIdMadina' => $hotelIdMadina]);
} else {
    echo json_encode(['error' => 'Error: ' . $stmt2->error]);
}

$stmt2->close();
$conn->close();
?>
 