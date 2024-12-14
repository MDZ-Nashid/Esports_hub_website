<?php
// login.php
session_start();
require 'includes/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<span class="error">' . $_SESSION['error'] . '</span>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo '<span class="success">' . $_SESSION['success'] . '</span>';
            unset($_SESSION['success']);
        }
        ?>
        <form action="includes/validate_login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <div class="link">
            <a href="register.php">Don't have an account? Register here</a>
        </div>
    </div>
</body>
</html>
