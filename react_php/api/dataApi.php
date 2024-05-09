<?php
// Include the database connection file
require './connectDB.php';

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

// Helper function to return JSON response
function jsonResponse($status, $message, $data = null)
{
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode(['message' => $message, 'data' => $data]);
    exit;
}

// CRUD operations
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST': // Create User
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $name = $data['name'] ?? '';
        $email = $data['email'] ?? '';
        $phone = $data['phone'] ?? '';

        if (!$name || !$email || !$phone) {
            jsonResponse(400, "Invalid input data");
        }

        $sql = "INSERT INTO users (name, email, phone) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $phone]);
        jsonResponse(201, "User created successfully", ['id' => $pdo->lastInsertId()]);
        break;

    case 'GET': // Get All Users
        $stmt = $pdo->query("SELECT * FROM users");
        $users = $stmt->fetchAll();
        jsonResponse(200, "Users retrieved successfully", $users);
        break;

    case 'PUT': // Update User
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $id = $data['id'] ?? null;
        $name = $data['name'] ?? null;
        $email = $data['email'] ?? null;
        $phone = $data['phone'] ?? null;

        if (!$id || !$name || !$email || !$phone) {
            jsonResponse(400, "Invalid input data");
        }

        $sql = "UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$name, $email, $phone, $id])) {
            jsonResponse(200, "User updated successfully");
        } else {
            jsonResponse(500, "Failed to update user");
        }
        break;

    case 'DELETE': // Delete User
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $id = $data['id'] ?? null;

        if (!$id) {
            jsonResponse(400, "Invalid ID provided");
        }

        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$id]);
        if ($result) {
            jsonResponse(200, "User deleted successfully");
        } else {
            jsonResponse(500, "Failed to delete user");
        }
        break;


    default:
        jsonResponse(405, "Method Not Allowed");
        break;
}
