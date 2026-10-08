<?php
session_start();
include "../db.php";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'student'; // Default role is 'student'

    // Check if username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
        $error = "Username already exists!";
    } else {
        // Insert new user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->execute([$username, $password, $role]);
        $success = "Registration successful! You can now log in.";
        echo $success;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

</head>
<body>
    <style>
        /* General Styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background: #f9f9f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #333;
}

/* Form Wrapper */
.form-wrapper {
    width: 100%;
    max-width: 400px;
    margin: 20px;
    background: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

/* Form Container */
.form-container {
    padding: 30px;
    text-align: center;
}

.form-container h2 {
    font-size: 1.8rem;
    margin-bottom: 10px;
    color: #007BFF;
}

.form-container p {
    font-size: 1rem;
    margin-bottom: 20px;
    color: #555;
}

/* Form Group */
.form-group {
    margin-bottom: 15px;
    text-align: left;
}

.form-group label {
    font-weight: bold;
    font-size: 0.9rem;
    display: block;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: border 0.3s ease;
}

.form-group input:focus {
    border: 1px solid #007BFF;
    outline: none;
}

/* Button */
.btn {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    font-weight: bold;
    color: white;
    background: #007BFF;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn:hover {
    background: #0056b3;
}

/* Form Footer */
.form-footer {
    margin-top: 15px;
    font-size: 0.9rem;
}

.form-footer a {
    color: #007BFF;
    text-decoration: none;
    font-weight: bold;
}

.form-footer a:hover {
    text-decoration: underline;
}

    </style>
    <div class="form-wrapper">
        <div class="form-container">
            <h2>Create Your Account</h2>
            <p>Join us to manage your hostel bookings easily.</p>
            <form action=" " method="POST">
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                 <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Confirm password" required>
                </div>
                <button type="submit" class="btn">Register</button>
                <p class="form-footer">Already have an account? <a href="../student/login.php">Login</a></p>
                <p><a href="../admin/login.php">Login as admin</a></p>
            </form>
        </div>
    </div>
</body>
</html>
