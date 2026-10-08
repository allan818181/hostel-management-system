<?php
session_start();
include '../db.php';

// // Debug session
if (!isset($_SESSION['admin_logged_in'])) {
    echo "Session not set. Redirecting to login.";
    header('Location: ../admin/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <style>
    /* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(130deg, #017aff, #00d3ff);
    color: #333;
}

/* Navigation Bar */
nav {
    background: #ffffff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

nav a {
    text-decoration: none;
    color: #007aff;
    margin: 0 15px;
    font-weight: bold;
    transition: color 0.3s ease;
}

nav a:hover {
    color: #0056b3;
}

nav .logout {
    background: #ff4d4d;
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    transition: background 0.3s ease;
}

nav .logout:hover {
    background: #e63939;
}

/* Dashboard Container */
.container {
    max-width: 1200px;
    margin: 50px auto;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    text-align: center;
}

.container h1 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #007aff;
}

.container p {
    font-size: 18px;
    margin-bottom: 30px;
    color: #555;
}

/* Dashboard Cards */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.card {
    background: linear-gradient(120deg, #007aff, #00d4ff);
    color: white;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
}

.card h3 {
    font-size: 22px;
    margin-bottom: 10px;
}

.card p {
    font-size: 16px;
    font-weight: bold;
}

/* Footer */
footer {
    text-align: center;
    padding: 15px;
    background: rgba(255, 255, 255, 0.8);
    color: #333;
    font-size: 14px;
    margin-top: 50px;
    box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
}
</style>
    <title>Admin Dashboard</title>
</head>
<body>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="../manageroom.php">Manage Rooms</a>
        <a href="../manageuser.php">Manage Users</a>
        <a href="../login.php">Logout</a>
    </nav>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p>Welcome, <?php echo $_SESSION['admin_username'] ?? 'Admin'; ?>!</p>
    </div>
</body>
</html>
