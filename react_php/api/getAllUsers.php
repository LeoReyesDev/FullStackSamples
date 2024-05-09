<?php
include './connectToDB.php';  // Include the database connection file

// Headers for CORS and content type
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Disable PDO prepared statement caching
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

try {
    // Prepare SQL statement to fetch all users
    $query = "SELECT id, name, email, phone FROM users";
    $stmt = $pdo->prepare($query); // Note: $pdo is defined in connectToDB.php

    // Execute the query and check if execution was successful
    if (!$stmt->execute()) {
        throw new Exception("Failed to execute the query.");
    }

    // Check if more than 0 record found
    if ($stmt->rowCount() > 0) {
        // Users array
        $users_arr = array();
        $users_arr["records"] = array();

        // Retrieve table contents
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user_item = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                "phone" => $row['phone']
            );

            array_push($users_arr["records"], $user_item);
        }

        // Set response code - 200 OK
        http_response_code(200);

        // Show users data in json format
        echo json_encode($users_arr);
    } else {
        // No users found
        http_response_code(404);
        echo json_encode(array("message" => "No users found."));
    }
} catch (Exception $e) {
    // Set response code - 500 Internal Server Error
    http_response_code(500);
    echo json_encode(array("message" => "Error accessing the database: " . $e->getMessage()));
}
