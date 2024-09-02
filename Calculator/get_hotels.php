<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_cal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, hotel_name,distance FROM hotel_prices";
$result = $conn->query($sql);

$hotels = array();
while ($row = $result->fetch_assoc()) {
    $hotels[] = $row;
}

echo json_encode($hotels);

$conn->close();
?>
