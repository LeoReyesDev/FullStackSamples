<?php
include 'connectToDB.php';

header('Content-Type: application/json');

// Get JSON as a string
$json_str = file_get_contents('php://input');
// Decode it into an associative array
$data = json_decode($json_str, true);

if (isset($data['id'], $data['name'], $data['email'], $data['phone'])) {
    $sql = "UPDATE users SET name = :name, email = :email, phone = :phone WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            ':id' => $data['id'],
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone']
        ]);
        echo json_encode(['success' => true, 'message' => 'User updated successfully']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}
