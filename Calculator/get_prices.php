<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_cal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$hotelId = $_GET['hotelId'];

$sql = "SELECT * FROM hotel_prices WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $hotelId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode([]);
}

$stmt->close();
$conn->close();
?>
