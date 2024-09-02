<?php
// delete.php

header('Content-Type: application/json');
$response = array('success' => false, 'message' => 'Failed to delete record.');

if (isset($_POST['uuid'])) {
    $uuid = $_POST['uuid'];
    
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'php_cal');
    
    // Check connection
    if ($conn->connect_error) {
        $response['message'] = 'Database connection failed: ' . $conn->connect_error;
        echo json_encode($response);
        exit;
    }
    
    // Begin transaction
    $conn->begin_transaction();
    
    try {
        // Combined delete query for users and price_table
        $stmt = $conn->prepare("
            DELETE users, price_table 
            FROM users 
            INNER JOIN price_table 
            ON users.id = price_table.id
            WHERE users.uuid = ?");
        
        $stmt->bind_param('s', $uuid);
        $stmt->execute();

        // Commit transaction
        $conn->commit();
        
        if ($stmt->affected_rows > 0) {
            $response['success'] = true;
            $response['message'] = 'Record deleted successfully.';
        } else {
            $response['message'] = 'No record found to delete.';
        }

    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        $response['message'] = 'Error: ' . $e->getMessage();
    }
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
}

echo json_encode($response);
?>
