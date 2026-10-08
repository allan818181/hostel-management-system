<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'student') {
            header('Location: ../student/booking.php') ;
            echo "login successfull now book";
            exit();
        } 
            
        
    } else {
        $error = "Invalid username or password";
        // echo $error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
            <h2>Welcome Back</h2>
            <p>Login to manage your hostel bookings.</p>
            <?php if (!empty($error)) : ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form action=" " method="POST">
                <div class="form-group">
                    <label for="email">Username</label>
                    <input type="text" id="name" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn">Login</button>
                <p class="form-footer">Don't have an account? <a href="../student/register.php">Register</a></p>
            </form>
        </div>
    </div>
</body>
</html>



