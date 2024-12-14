<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            <div class="welcome-section">
                <h1>Welcome to Admin Dashboard <?php echo htmlspecialchars($_SESSION['admin_username']); ?></h1>
                <p>Manage your site effectively with the options provided in the sidebar.</p>
            </div>
        </div>
    </div>
</body>
</html>
