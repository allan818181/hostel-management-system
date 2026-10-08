<?php
session_start();
include '../db.php';

// Redirect if not admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../admin/login.php");
    exit();
}

// Handle room addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_room'])) {
    // Sanitize input to prevent SQL injection
    $room_number = htmlspecialchars($_POST['room_number']);
    $capacity = htmlspecialchars($_POST['capacity']);

    // Ensure both room number and capacity are valid
    if (!empty($room_number) && is_numeric($capacity)) {
        $stmt = $conn->prepare("INSERT INTO rooms (room_number, capacity, occupancy_status) VALUES (?, ?, 'Available')");
        $stmt->execute([$room_number, $capacity]);
    }
}

// Fetch all rooms
$stmt = $conn->query("SELECT * FROM rooms");
$rooms = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <style>

        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body and General Layout */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0;
    color: #333;
    padding: 20px;
}

.container {
    width: 80%;
    margin: 0 auto;
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

/* Add Room Form */
.add-room-form {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-bottom: 30px;
}

.add-room-form input {
    padding: 10px;
    font-size: 1.1em;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 250px;
}

.add-room-form button {
    padding: 10px 20px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1.1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.add-room-form button:hover {
    background-color: #218838;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 1.1em;
    text-align: left;
}

table thead {
    background-color: #007bff;
    color: white;
}

table th, table td {
    padding: 12px;
    border: 1px solid #ddd;
}

table tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

table tbody tr:hover {
    background-color: #f1f1f1;
}

table a {
    color: #007bff;
    text-decoration: none;
    padding: 5px 10px;
    font-size: 1em;
    border: 1px solid #007bff;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

table a:hover {
    background-color: #007bff;
    color: white;
}

table a:active {
    transform: scale(0.98);
}

    </style>
    <title>Manage Rooms</title>
</head>
<body>
    <div class="container">
        <h1>Manage Rooms</h1>
        
        <!-- Room Add Form -->
        <form method="POST" class="add-room-form">
            <input type="text" name="room_number" placeholder="Room Number" required>
            <input type="number" name="capacity" placeholder="Capacity" required>
            <button type="submit" name="add_room">Add Room</button>
        </form>
        
        <!-- Room Table -->
        <table>
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rooms as $room): ?>
                <tr>
                    <td><?= htmlspecialchars($room['room_number']) ?></td>
                    <td><?= htmlspecialchars($room['capacity']) ?></td>
                    <td><?= htmlspecialchars($room['occupancy_status']) ?></td>
                    <td>
                        <a href="../admin/edit.php?id=<?= $room['room_id'] ?>">Edit</a>
                        <a href="../admin/delete.php?id=<?= $room['room_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
