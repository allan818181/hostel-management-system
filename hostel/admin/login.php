<?php
session_start();
include '../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $error = '';

    // Check if fields are empty
    if (empty($username) || empty($password)) {
        $error = "Please fill in both fields.";
    } else {
        // Prepare and execute query
        $stmt = $conn->prepare("SELECT * FROM usere WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify user and password
        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true); // Secure session
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == 'admin') {
                header("Location: ../admin/dashboard.php");
                exit();
            } else {
                $error = "Unauthorized access. Admins only.";
                echo $error;
            }
        } else {
            $error = "Invalid username or password.";
        }
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
            <p>You are Admin.</p>
            <form action=" " method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="name" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                
                <butto type="submit" class="btn"><a href="../admin/dashboard.php/">Login</a></button>
               
            </form>
        </div>
    </div>
</body>
</html>


