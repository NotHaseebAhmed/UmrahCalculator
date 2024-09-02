<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_cal";

header('Content-Type: application/json');

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Retrieve the POST data
$ticketDirect = $_POST['ticketDirect'] ?? null;
$ticketConnect = $_POST['ticketConnect'] ?? null;
$visaPrice = $_POST['visaPrice'] ?? null;
$otherServices = $_POST['otherServices'] ?? null;

// Check if any required fields are missing
if (!$ticketDirect || !$ticketConnect || !$visaPrice || !$otherServices) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

// Prepare the SQL statement for updating the data
$sql_update = "UPDATE otherthings SET visa_price = ?, directTicket_price = ?, connectTicket_price = ?, otherServices_price = ? LIMIT 1";
$stmt = $conn->prepare($sql_update);

// Bind the parameters to the SQL query
$stmt->bind_param('iiii', $visaPrice, $ticketDirect, $ticketConnect, $otherServices);

// Execute the query and check if it was successful
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Data updated successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>
