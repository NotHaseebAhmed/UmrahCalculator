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

// Retrieve the POST data and sanitize it
$persons = $_POST['persons'] ?? 0;
$date = $_POST['date'] ?? '';
$hotelMakkah1 = $conn->real_escape_string($_POST['hotelMakkah1'] ?? '');
$nightMakkah1 = $_POST['nightMakkah1'] ?? 0;
$roomMakkah1 = $_POST['roomMakkah1'] ?? 0;
$hotelMaddinah2 = $conn->real_escape_string($_POST['hotelMaddinah2'] ?? '');
$nightMaddinah2 = $_POST['nightMaddinah2'] ?? 0;
$roomMaddinah2 = $_POST['roomMaddinah2'] ?? 0;
$hotelMakkah3 = $conn->real_escape_string($_POST['hotelMakkah3'] ?? '');
$nightMakkah3 = $_POST['nightMakkah3'] ?? 0;
$roomMakkah3 = $_POST['roomMakkah3'] ?? 0;
$flightType = $conn->real_escape_string($_POST['flightType'] ?? '');

// Determine the month from the provided date
$month = date('M', strtotime($date));

// Prepare SQL queries to fetch data based on user inputs
$hotelQueries = [
    'makkah1' => "SELECT * FROM hotel_prices WHERE hotel_name = '$hotelMakkah1'",
    'maddinah2' => "SELECT * FROM hotelmadina WHERE hotel_name = '$hotelMaddinah2'",
    'makkah3' => "SELECT * FROM hotel_prices WHERE hotel_name = '$hotelMakkah3'"
];

$response = [];

// Fetch hotel data
foreach ($hotelQueries as $key => $query) {
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $priceField = strtolower($month) . '_price';
        $response[$key] = [
            'hotel_name' => $data['hotel_name'],
            'distance' => $data['distance'],
            'totalRooms' => ${"room" . ucfirst($key)},
            'totalNights' => ${"night" . ucfirst($key)},
            'prPnPrice' => $data[$priceField] * ${"night" . ucfirst($key)} * ${"room" . ucfirst($key)}
        ];
    } else {
        $response[$key] = [
            'hotel_name' => 'Not Found',
            'distance' => 'N/A',
            'totalRooms' => 0,
            'totalNights' => 0,
            'prPnPrice' => 0
        ];
    }
}

// Fetch visa and ticket prices
$otherThingsQuery = "SELECT visa_price, directTicket_price, connectTicket_price, otherServices_price FROM otherthings";
$otherThingsResult = $conn->query($otherThingsQuery);
$otherThings = $otherThingsResult->fetch_assoc();

$response['visaPrice'] = $otherThings['visa_price'];
$response['ticketPrice'] = $flightType == 'Direct Flight' ? $otherThings['directTicket_price'] : $otherThings['connectTicket_price'];
$visaTicket = ($otherThings['visa_price'] + $response['ticketPrice'] + $otherThings['otherServices_price']) * $persons;
$response['totalPrice'] = ($response['makkah1']['prPnPrice'] + $response['maddinah2']['prPnPrice'] + $response['makkah3']['prPnPrice'] + $visaTicket);
$perPersonPrice = $response['totalPrice'] / $persons;

// SQL query to insert the calculated prices into the database
$sql = "INSERT INTO `price_table` (`totalPerPerson`, `totalPrice`) VALUES (?, ?)";

// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->bind_param("dd", $perPersonPrice, $response['totalPrice']);

if ($stmt->execute()) {
    $response['database_insertion'] = 'success';
} else {
    $response['database_insertion'] = 'failed';
    $response['error'] = $stmt->error;
}

// Return the response as JSON
echo json_encode(['success' => true] + $response);

$conn->close();

?>
