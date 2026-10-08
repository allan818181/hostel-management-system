<?php
session_start();
include '../db.php';

// Redirect if not student
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'student') {
    header("Location: ../student/login.php");
    exit();
}

// Fetch data for rooms and users
$stmt_rooms = $conn->query("SELECT room_number, capacity, occupancy_status FROM rooms");
$rooms = $stmt_rooms->fetchAll();

$stmt_users = $conn->query("SELECT username, role FROM users WHERE role != 'admin'");
$users = $stmt_users->fetchAll();
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

/* Body and Layout */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9fb;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

/* Header */
header {
    margin-bottom: 30px;
    text-align: center;
}

header h1 {
    font-size: 2.5em;
    color: #444;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Dashboard Container */
.dashboard-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    width: 100%;
    max-width: 1200px;
}

/* Card Design */
.card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 100%;
    max-width: 550px;
}

.card h2 {
    font-size: 1.8em;
    margin-bottom: 20px;
    color: #555;
    border-bottom: 2px solid #ddd;
    padding-bottom: 10px;
}

/* Table Design */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    text-align: left;
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
}

th {
    background-color: #f4f4f4;
    font-weight: bold;
    color: #666;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

/* Responsive Design */
@media (max-width: 768px) {
    header h1 {
        font-size: 2em;
    }

    .dashboard-container {
        flex-direction: column;
        align-items: center;
    }

    .card {
        width: 90%;
    }
}

    </style>
    <title>Student Dashboard</title>
</head>
<body>
    <header>
        <h1>Student Dashboard</h1>
    </header>
    <div class="dashboard-container">
        <!-- Rooms Section -->
        <div class="card">
            <h2>Rooms Overview</h2>
            <table>
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Capacity</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rooms as $room): ?>
                        <tr>
                            <td><?= htmlspecialchars($room['room_number']) ?></td>
                            <td><?= htmlspecialchars($room['capacity']) ?></td>
                            <td><?= htmlspecialchars($room['occupancy_status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Users Section -->
        <div class="card">
            <h2>User Details</h2>
            <table>
                <a href="login.php">log out</a>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['role']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
