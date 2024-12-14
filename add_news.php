<?php
session_start();
include 'includes/db.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}


// Add news functionality
if (isset($_POST['add_news'])) {
    $news_title = $_POST['news_title'];
    $news_description = $_POST['news_description'];
    $detailed_news = $_POST['detailed_news'];

    if (!empty($news_title) && !empty($news_description) && !empty($detailed_news)) {
        $stmt = $conn->prepare("INSERT INTO news (title, description, full_details) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $news_title, $news_description, $detailed_news);

        if ($stmt->execute()) {
            $_SESSION['success'] = "News added successfully!";
        } else {
            $_SESSION['error'] = "Failed to add news!";
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "All fields are required!";
    }
}

// Delete news functionality
if (isset($_GET['delete_id'])) {
    $news_id = $_GET['delete_id'];

    // Prevent deletion of first news (id=1)
    if ($news_id != 1) {
        $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
        $stmt->bind_param("i", $news_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "News deleted successfully!";
        } else {
            $_SESSION['error'] = "Failed to delete news!";
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Cannot delete the first news!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
    <link rel="stylesheet" href="css/dashboard.css"> <!-- Link to external CSS -->
</head>
<body>

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
        <main class="main-content">
            <h1 class="page-title">Add News</h1>

            <!-- Success or Error Messages -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="success-message">
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <!-- Form and Table Section -->
            <div class="add-games-container">
                <!-- News Form -->
                 <div class="form-container">
                 <form action="add_news.php" method="POST">
                    <label for="news_title">News Title</label>
                    <input type="text" name="news_title" id="news_title" required>

                    <label for="news_description">Short Description</label>
                    <textarea name="news_description" id="news_description" rows="3" required></textarea>

                    <label for="detailed_news">Detailed News</label>
                    <textarea name="detailed_news" id="detailed_news" rows="5" required></textarea>

                    <button type="submit" name="add_news" class="btn">Add News</button>
                </form>
                 </div>
                

                <!-- News Table -->
                <div class="news-table-container">
                    <table class="news-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $conn->query("SELECT * FROM news ORDER BY news_time DESC");
                            if ($result->num_rows > 0) {
                                $serial = 1;
                                while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $serial++; ?></td>
                                        <td><?= htmlspecialchars($row['title']); ?></td>
                                        <td><?= htmlspecialchars($row['description']); ?></td>
                                        <td>
                                            <a href="add_news.php?delete_id=<?= $row['id']; ?>" class="btn-delete">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile;
                            } else { ?>
                                <tr>
                                    <td colspan="4">No news added yet.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
</body>
</html>
