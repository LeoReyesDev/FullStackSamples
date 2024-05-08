<?php
include './connectToDB.php';  // Ensure this file sets up a new PDO connection
header('Content-Type: application/json');

// Define the SQL query to retrieve all users
$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($users) {
        echo json_encode(['success' => true, 'data' => $users]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No users found.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
