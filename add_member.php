<?php
session_start();
require_once "includes/db.php";

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle form submission to add an admin
$error = $success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_admin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "All fields are required!";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username already exists
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username already exists!";
        } else {
            // Add the admin to the database
            $stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);
            if ($stmt->execute()) {
                $success = "Admin added successfully!";
            } else {
                $error = "Failed to add admin. Please try again.";
            }
        }
    }
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // Restrictions: Prevent deleting ID=1 and self-deletion
    if ($delete_id === 1) {
        $error = "Cannot delete the primary admin.";
    } elseif ($delete_id === $_SESSION['admin_username']) {
        $error = "You cannot delete yourself!";
    } else {
        $stmt = $conn->prepare("DELETE FROM admins WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            $success = "Admin deleted successfully!";
        } else {
            $error = "Failed to delete admin. Please try again.";
        }
    }
}

// Fetch all admins
$stmt = $conn->prepare("SELECT * FROM admins ORDER BY id ASC");
$stmt->execute();
$admins = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<div class="dashboard-container">
    <!-- Sidebar -->
    <nav class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin_logout.php">Logout</a></li>
            <li><a href="admin_dashboard.php">Home</a></li>
            <li><a href="add_member.php">Add Member</a></li>
            <li><a href="add_carousel.php">Add Carousel</a></li>
            <li><a href="add_popular_games.php">Add Popular Games</a></li>
            <li><a href="add_news.php">Add News</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
    <div class="add-member-container">
        <!-- Add Admin Form -->
        <div class="form-container">
            <h1>Add New Admin</h1>

            <?php if (!empty($error)) echo "<p class='error'>$error</p>";unset($success) ?>
            <?php if (!empty($success)) echo "<p class='success'>$success</p>";unset($success) ?>

            <form method="POST" action="add_member.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" name="add_admin">Add Admin</button>
            </form>
        </div>

        <!-- Admin Table -->
        <div class="admin-table">
            <h2>Current Admins</h2>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $admins->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td>
                            <?php if ($row['id'] !== 1 && $row['username'] !== $_SESSION['admin_username']): ?>
                                <a href="add_member.php?delete_id=<?= $row['id'] ?>" class="delete-btn"
                                   onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a>
                            <?php else: ?>
                                <span class="disabled-btn">Not Allowed</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
</body>
</html>
