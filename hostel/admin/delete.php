<?php
session_start();
include '../db.php';

// Redirect if not admin
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
//     header("Location: ../login.php");
//     exit();
// }

// Delete the room
if (isset($_GET['id'])) {
    $room_id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM rooms WHERE room_id = ?");
    $stmt->execute([$room_id]);

    header("Location: manage_rooms.php");
    exit();
} else {
    echo "Room ID not provided.";
}
?>
