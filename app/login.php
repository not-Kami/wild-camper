<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wild Campers</title>
    <link rel="stylesheet" href="../public/style/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <div class="login-header">
                <h1>Start your perfect trip</h1>
            </div>
            <div class="social-login">
                <button class="social-btn google">G</button>
                <button class="social-btn apple">A</button>
                <button class="social-btn facebook">F</button>
            </div>
            <p>or</p>
            <form action="app/login.php" method="POST">
                <input type="text" name="username" placeholder="Full name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="start-btn">Start</button>
            </form>
            <p>Already have an account? <a href="index.php?page=login">Log in</a></p>
        </div>
        <div class="login-image">
            <img src="../public/img/hero_land_rover_jump.png" alt="Login Image">
        </div>
    </div>
</body>
</html>
<?php
session_start();
require 'config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: ../index.php?page=home');
        exit;
    } else {
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: ../index.php?page=login');
        exit;
    }
}
?>
