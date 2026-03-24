<?php
session_start();
include '../db.php';

// Redirect if not student
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'student') {
    header("Location: ../student/login.php");
    exit();
}

// Handle booking
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = $_POST['room_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, room_id, start_date, end_date, status) VALUES (?, ?, ?, ?, 'Pending')");
    $stmt->execute([$_SESSION['user_id'], $room_id, $start_date, $end_date]);

    header("Location: ../student/dashboard.php");
    exit();
}

// Fetch available rooms
$stmt = $conn->query("SELECT * FROM rooms WHERE occupancy_status = 'Available'");
$rooms = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="">

    <style>
/* General Reset and Layout */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body and Page Layout */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    color: #333;
    padding: 40px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
}

/* Main Heading */
h1 {
    font-size: 2.5em;
    color: #444;
    margin-bottom: 20px;
}

/* Form Styling */
form {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
    margin-top: 20px;
}

/* Input Fields */
select, input[type="date"] {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1em;
    color: #555;
    transition: border-color 0.3s;
}

select:focus, input[type="date"]:focus {
    border-color: #ff6b6b;
    outline: none;
}

/* Button Styling */
button {
    width: 100%;
    padding: 12px;
    background-color: #ff6b6b;  /* Soft red */
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 1.2em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #e55c5c;
}

button:active {
    transform: scale(0.98);
}

/* Room Options */
option {
    font-size: 1em;
    padding: 10px;
}

/* Responsive Design */
@media (max-width: 768px) {
    body {
        padding: 20px;
    }

    form {
        width: 90%;
        padding: 20px;
    }

    h1 {
        font-size: 2em;
    }
title{
    padding-bottom: 400px;

    }
}



    </style>
    <title>Book Room</title>
</head>
<body>
    <h1>Book a Room</h1>    
    <form method="POST">
        <select name="room_id" required>
            <option value="0">Select a Room</option>
            <option value="1">101</option>
            <option value="2">102</option>
            <option value="3">103</option>
            <option value="4">104</option>
            <option value="5">105</option>
            <option value="6">106</option>
            <option value="7">107</option>
            <option value="8">108</option>
            <option value="9">109</option>
            <option value="10">110</option>
            <?php foreach ($rooms as $room): ?>
            <option value="<?= $room['room_id'] ?>">Room <?= $room['room_number'] ?> (Capacity: <?= $room['capacity'] ?>)</option>
            <?php endforeach; ?>
        </select>
        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <button type="submit">Book</button>
    </form>
</body>
</html>
