<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}


// Handle Carousel Submission
if (isset($_POST['add_carousel'])) {
    $tournament_name = trim($_POST['tournament_name']);
    $game_name = trim($_POST['game_name']);
    $image = $_FILES['image'];

    if (empty($tournament_name) || empty($game_name) || empty($image['name'])) {
        $_SESSION['error'] = "All fields are required.";
    } else {
        // Handle image upload
        $imagePath = 'images/' . basename($image['name']);
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO tournaments (name, game, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $tournament_name, $game_name, $imagePath);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Carousel added successfully.";
            } else {
                $_SESSION['error'] = "Failed to add carousel.";
            }
        } else {
            $_SESSION['error'] = "Failed to upload image.";
        }
    }
}

// Handle Carousel Deletion
if (isset($_GET['delete_id'])) {
    $deleteId = intval($_GET['delete_id']);
    $stmt = $conn->prepare("SELECT image FROM tournaments WHERE id = ?");
    $stmt->bind_param("i", $deleteId);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    $stmt->fetch();
    $stmt->close();

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    $deleteStmt = $conn->prepare("DELETE FROM tournaments WHERE id = ?");
    $deleteStmt->bind_param("i", $deleteId);

    if ($deleteStmt->execute()) {
        $_SESSION['success'] = "Carousel deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete carousel.";
    }
}

// Fetch Carousel Items
$carouselItems = $conn->query("SELECT id, name, game, image FROM tournaments");

// Display Messages
$error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['error'], $_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Add Carousel</title>
</head>
<body>
    <!-- Navbar -->
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
        <h1>Add Carousel</h1>

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <p class="success"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <div class="add-carousel-container">
            <!-- Carousel Form -->
            <div class="form-container">
                <form method="POST" enctype="multipart/form-data">
                    <label for="tournament_name">Tournament Name:</label>
                    <input type="text" id="tournament_name" name="tournament_name" required>

                    <label for="game_name">Game Name:</label>
                    <input type="text" id="game_name" name="game_name" required>

                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>

                    <button type="submit" name="add_carousel">Add Carousel</button>
                </form>
            </div>

            <!-- Carousel Table -->
            <div class="carousel-table">
                <h2>Available Carousels</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Tournament Name</th>
                            <th>Game Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $carouselItems->fetch_assoc()): ?>
                            <tr>
                                <td><img src="<?= htmlspecialchars($row['image']) ?>" alt="Carousel Image" class="carousel-preview"></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['game']) ?></td>
                                <td>
                                    <a href="add_carousel.php?delete_id=<?= $row['id'] ?>" class="delete-btn"
                                       onclick="return confirm('Are you sure you want to delete this carousel?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

