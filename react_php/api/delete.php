<?php
include 'connectToDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$id]);

    if ($result) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user.";
    }
}
