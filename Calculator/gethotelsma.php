<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_cal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, hotel_name,distance FROM hotelmadina";
$result = $conn->query($sql);

$hotelsmadina = array();
while ($row = $result->fetch_assoc()) {
    $hotelsmadina[] = $row;
}

echo json_encode($hotelsmadina);

$conn->close();
?>
