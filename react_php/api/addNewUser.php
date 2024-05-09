<?php
include './connectToDB.php';  // Ensure this file properly sets up a PDO connection named $pdo
header('Access-Control-Allow-Origin: *'); // Allow all domains for CORS (adjust in production)
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); // Adjust methods as necessary
header('Access-Control-Allow-Headers: Content-Type'); // Ensure the content-type header is allowed
header('Content-Type: application/json');

// Get JSON as a string from the request body
$json_str = file_get_contents('php://input');

// Decode the JSON into an associative array
$data = json_decode($json_str, true);

// Check if the data contains all necessary fields
if (isset($data['name'], $data['email'], $data['phone'])) {
    // Prepare the SQL statement to prevent SQL injection
    $sql = "INSERT INTO users (name, email, phone) VALUES (:name, :email, :phone)";
    $stmt = $pdo->prepare($sql);

    // Bind the values to the statement and execute it
    try {
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone']
        ]);
        echo json_encode(['success' => true, 'message' => 'User added successfully']);
    } catch (PDOException $e) {
        // Handle SQL errors (e.g., duplicate email)
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Missing required fields
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}
