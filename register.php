<?php
// register.php
session_start();
require 'includes/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<span class="error">' . $_SESSION['error'] . '</span>';
            unset($_SESSION['error']);
        }
        ?>
        <form action="includes/validate_registration.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <div class="link">
            <a href="login.php">Already have an account? Login here</a>
        </div>
    </div>
</body>
</html>
