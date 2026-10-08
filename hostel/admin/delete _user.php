<?php
session_start();
include '../db.php';

// Check if the user is an admin
// if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
//     // If the user is not an admin, redirect to a forbidden page or login
//     header("Location: forbidden.php");
//     exit();
// }

// Check if the user ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = intval($_GET['id']);

    // Prevent deleting admin users by adding a condition
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role != 'admin'");
    $stmt->execute([$userId]);

    // Redirect back to the manage users page
    header("Location: manageuser.php");
    exit();
} else {
    // If no valid ID is provided, redirect with an error message
    header("Location: manageuser.php?.error=invalid_id");
    exit();
}
