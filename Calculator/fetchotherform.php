<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_cal";

header('Content-Type: application/json');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Fetch existing data
$sql = "SELECT visa_price, directTicket_price, connectTicket_price, otherServices_price FROM otherthings LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        'exists' => true,
        'ticketDirect' => $row['directTicket_price'],
        'ticketConnect' => $row['connectTicket_price'],
        'visaPrice' => $row['visa_price'],
        'otherServices' => $row['otherServices_price']
    ]);
} else {
    echo json_encode(['exists' => false]);
}

$conn->close();
?>
