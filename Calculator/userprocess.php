<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_cal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate a unique ID (UUID)
function generateUUID() {
    return bin2hex(random_bytes(16));
}

// Handle insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the data
    $uuid = generateUUID();
    $persons = isset($_POST['persons']) ? $conn->real_escape_string($_POST['persons']) : null;
    $date = isset($_POST['date']) ? $conn->real_escape_string($_POST['date']) : null;
    $hotelMakkah1 = isset($_POST['hotelMakkah1']) ? $conn->real_escape_string($_POST['hotelMakkah1']) : null;
    $nightMakkah1 = isset($_POST['nightMakkah1']) ? $conn->real_escape_string($_POST['nightMakkah1']) : null;
    $roomMakkah1 = isset($_POST['roomMakkah1']) ? $conn->real_escape_string($_POST['roomMakkah1']) : null;
    $hotelMaddinah2 = isset($_POST['hotelMaddinah2']) ? $conn->real_escape_string($_POST['hotelMaddinah2']) : null;
    $nightMaddinah2 = isset($_POST['nightMaddinah2']) ? $conn->real_escape_string($_POST['nightMaddinah2']) : null;
    $roomMaddinah2 = isset($_POST['roomMaddinah2']) ? $conn->real_escape_string($_POST['roomMaddinah2']) : null;
    $hotelMakkah3 = isset($_POST['hotelMakkah3']) ? $conn->real_escape_string($_POST['hotelMakkah3']) : null;
    $nightMakkah3 = isset($_POST['nightMakkah3']) ? $conn->real_escape_string($_POST['nightMakkah3']) : null;
    $roomMakkah3 = isset($_POST['roomMakkah3']) ? $conn->real_escape_string($_POST['roomMakkah3']) : null;
    $flightType = isset($_POST['flightType']) ? $conn->real_escape_string($_POST['flightType']) : null;

    // Check required fields
    if ($persons && $date && $hotelMakkah1 && $nightMakkah1 && $roomMakkah1 && $flightType) {
        // Encode stay data
        $makkah1Stay = json_encode(['hotel' => $hotelMakkah1, 'nights' => $nightMakkah1, 'rooms' => $roomMakkah1]);
        $maddinah2Stay = json_encode(['hotel' => $hotelMaddinah2, 'nights' => $nightMaddinah2, 'rooms' => $roomMaddinah2]);
        $makkah3Stay = json_encode(['hotel' => $hotelMakkah3, 'nights' => $nightMakkah3, 'rooms' => $roomMakkah3]);

        // Prepare SQL query with UUID
        $sql = "INSERT INTO users (uuid, persons, date, hotel_makkah1stay, hotel_maddinah2stay, hotel_makkah3stay, flight_type) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('sisssss', $uuid, $persons, $date, $makkah1Stay, $maddinah2Stay, $makkah3Stay, $flightType);

            if ($stmt->execute()) {
                echo json_encode(['success' => 'Data saved successfully!', 'uuid' => $uuid]);
            } else {
                echo json_encode(['error' => 'Error: ' . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(['error' => 'Error preparing statement: ' . $conn->error]);
        }
    } else {
        echo json_encode(['error' => 'Error: Missing required fields.']);
    }
}


// Handle fetching
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['location'])) {
    $location = $conn->real_escape_string($_GET['location']);

    if ($location === 'makkah') {
        $query = "SELECT hotel_name, distance FROM hotel_prices";
    } else if ($location === 'madinah') {
        $query = "SELECT hotel_name, distance FROM hotelmadina";
    } else {
        echo json_encode(['error' => 'Invalid location specified.']);
        exit;
    }

    $result = $conn->query($query);

    if ($result) {
        $hotels = array();
        while ($row = $result->fetch_assoc()) {
            $hotels[] = $row;
        }
        echo json_encode($hotels);
    } else {
        echo json_encode(['error' => 'Error executing query: ' . $conn->error]);
    }
}

$conn->close();
?>
