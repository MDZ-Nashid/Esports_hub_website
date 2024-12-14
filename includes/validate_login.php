<?php
// validate_login.php
session_start();
require 'db.php';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Check if username exists
    $check_query = $conn->prepare("SELECT * FROM users WHERE username=?");
    $check_query->bind_param("s", $username);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows == 0) {
        $_SESSION['error'] = "Username not found.";
        header('Location: ../login.php');
        exit();
    }

    $user = $result->fetch_assoc();

    // Verify password
    if (!password_verify($password, $user['password'])) {
        $_SESSION['error'] = "Password didn't match.";
        header('Location: ../login.php');
        exit();
    }

    // Login successful
    $_SESSION['username'] = $user['username'];
    $_SESSION['user_id'] = $user['id'];
    header('Location: ../index.php');
    exit();
}
?>
