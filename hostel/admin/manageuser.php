<?php
session_start();
include '../db.php';

// Fetch all users
$stmt = $conn->query("SELECT * FROM users WHERE role != 'admin'");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="general.css">
    <title>Manage Users</title>
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
    background-color: #f4f4f9;
    color: #333;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* Main Container */
h1 {
    font-size: 2.5em;
    margin-bottom: 20px;
    color: #444;
    text-align: center;
}

/* Table Layout */
table {
    width: 80%;
    margin-top: 30px;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

thead {
    background: #f1f1f1;
}

th, td {
    padding: 15px;
    text-align: left;
    font-size: 1.1em;
}

th {
    font-weight: bold;
    color: #555;
}

tbody tr {
    border-bottom: 1px solid #ddd;
}

tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

/* Action Links */
a {
    text-decoration: none;
    color: #ff6b6b;  /* Soft red */
    font-weight: bold;
    padding: 8px 12px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #ff6b6b;
    color: white;
}

a:active {
    transform: scale(0.98);
}

/* Responsive Design */
@media (max-width: 768px) {
    table {
        width: 95%;
    }

    h1 {
        font-size: 2em;
    }

    th, td {
        font-size: 1em;
    }
}

    </style>
</head>
<body>
    <h1>Manage Users</h1>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['username'] ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <a href="../admin/delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
