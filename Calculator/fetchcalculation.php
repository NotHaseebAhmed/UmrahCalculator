<?php

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_cal";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve UUID from GET request and escape it
$uuid = isset($_GET['uuid']) ? $conn->real_escape_string($_GET['uuid']) : '';

if ($uuid) {
    // SQL query to fetch record using UUID
    $sql = "SELECT p.totalPerPerson, p.totalPrice, i.persons, i.date, i.hotel_makkah1stay, i.hotel_maddinah2stay, i.hotel_makkah3stay, i.flight_type
            FROM price_table p 
            JOIN users i ON p.id = i.id
            WHERE i.uuid = ?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $uuid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Decode JSON data
        $hotelMakkah1Stay = json_decode($row['hotel_makkah1stay'], true);
        $hotelMaddinah2Stay = json_decode($row['hotel_maddinah2stay'], true);
        $hotelMakkah3Stay = json_decode($row['hotel_makkah3stay'], true);

        $response = [
            'totalPerPerson' => $row['totalPerPerson'],
            'totalPrice' => $row['totalPrice'],
            'persons' => $row['persons'],
            'date' => $row['date'],
            'hotelMakkah1Stay' => $hotelMakkah1Stay,
            'hotelMaddinah2Stay' => $hotelMaddinah2Stay,
            'hotelMakkah3Stay' => $hotelMakkah3Stay,
            'flightType' => $row['flight_type']
        ];

        echo json_encode(['success' => true, 'data' => $response]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No data found.']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'UUID not provided.']);
}

$conn->close();

?>
