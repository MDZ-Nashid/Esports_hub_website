<?php
// validate_registration.php
session_start();
require 'db.php';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Password Validation
    if (strlen($password) < 8 || !preg_match('/[\W]/', $password)) {
        $_SESSION['error'] = "Password must be at least 8 characters and include a special character.";
        header('Location: ../register.php');
        exit();
    }

    // Check for unique username and email
    $check_query = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $check_query->bind_param("ss", $username, $email);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username or Email already exists.";
        header('Location: ../register.php');
        exit();
    }

    // Insert new user
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $insert_query = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $insert_query->bind_param("sss", $username, $email, $hashed_password);

    if ($insert_query->execute()) {
        $_SESSION['success'] = "Registration successful! Please login.";
        header('Location: ../login.php');
        exit();
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
        header('Location: ../register.php');
        exit();
    }
}
?>
