<?php
session_start();
include '../db.php';

// Redirect if not admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Get room details
if (isset($_GET['id'])) {
    $room_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM rooms WHERE room_id = ?");
    $stmt->execute([$room_id]);
    $room = $stmt->fetch();

    if (!$room) {
        echo "Room not found.";
        exit();
    }
}

// Update room details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_number = $_POST['room_number'];
    $capacity = $_POST['capacity'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE rooms SET room_number = ?, capacity = ?, occupancy_status = ? WHERE room_id = ?");
    $stmt->execute([$room_number, $capacity, $status, $room_id]);

    header("Location: manage_rooms.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">

    <style>
        /* Action Buttons */
.edit-btn, .delete-btn {
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 5px;
    font-size: 0.9em;
    color: #fff;
    transition: background-color 0.3s ease;
}

.edit-btn {
    background-color: #4caf50; /* Green */
}

.edit-btn:hover {
    background-color: #45a049;
}

.delete-btn {
    background-color: #f44336; /* Red */
}

.delete-btn:hover {
    background-color: #e53935;
}

    </style>
    <title>Edit Room</title>
</head>
<body>
    <h1>Edit Room</h1>
    <form method="POST">
        <label for="room_number">Room Number</label>
        <input type="text" id="room_number" name="room_number" value="<?= htmlspecialchars($room['room_number']) ?>" required>
        
        <label for="capacity">Capacity</label>
        <input type="number" id="capacity" name="capacity" value="<?= htmlspecialchars($room['capacity']) ?>" required>
        
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="Available" <?= $room['occupancy_status'] == 'Available' ? 'selected' : '' ?>>Available</option>
            <option value="Occupied" <?= $room['occupancy_status'] == 'Occupied' ? 'selected' : '' ?>>Occupied</option>
        </select>
        
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
