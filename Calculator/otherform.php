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

$ticketDirect = $_POST['ticketDirect'] ?? null;
$ticketConnect = $_POST['ticketConnect'] ?? null;
$visaPrice = $_POST['visaPrice'] ?? null;
$otherServices = $_POST['otherServices'] ?? null;

if (!$ticketDirect || !$ticketConnect || !$visaPrice || !$otherServices) {
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

// Check if there's already an entry in the table
$sql_check = "SELECT * FROM otherthings LIMIT 1";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    echo json_encode(['error' => 'Values have already been inserted.']);
} else {
    $sql_insert = "INSERT INTO otherthings (visa_price, directTicket_price, connectTicket_price, otherServices_price) 
                   VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param('iiii', $visaPrice, $ticketDirect, $ticketConnect, $otherServices);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'Data saved successfully!']);
    } else {
        echo json_encode(['error' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>
