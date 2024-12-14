<?php
session_start();
require_once 'includes/db.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}



// Handle Popular Games Submission
if (isset($_POST['add_game'])) {
    $game_name = trim($_POST['game_name']);
    $game_description = trim($_POST['game_description']);
    $game_image = $_FILES['game_image'];

    if (empty($game_name) || empty($game_description) || empty($game_image['name'])) {
        $_SESSION['error'] = "All fields are required.";
    } else {
        // Handle image upload
        $imagePath = 'images/' . basename($game_image['name']);
        if (move_uploaded_file($game_image['tmp_name'], $imagePath)) {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO games (game_name, game_description, game_image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $game_name, $game_description, $imagePath);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Game added successfully.";
            } else {
                $_SESSION['error'] = "Failed to add game.";
            }
        } else {
            $_SESSION['error'] = "Failed to upload image.";
        }
    }
}

// Handle Game Deletion
if (isset($_GET['delete_id'])) {
    $deleteId = intval($_GET['delete_id']);
    $stmt = $conn->prepare("SELECT game_image FROM games WHERE id = ?");
    $stmt->bind_param("i", $deleteId);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    $stmt->fetch();
    $stmt->close();

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    $deleteStmt = $conn->prepare("DELETE FROM games WHERE id = ?");
    $deleteStmt->bind_param("i", $deleteId);

    if ($deleteStmt->execute()) {
        $_SESSION['success'] = "Game deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete game.";
    }
}

// Fetch Games
$games = $conn->query("SELECT id, game_name, game_description, game_image FROM games");

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
    <title>Add Popular Games</title>
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
        <h1>Add Popular Games</h1>

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <p class="success"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <div class="add-games-container">
            <!-- Games Form -->
            <div class="form-container">
                <form method="POST" enctype="multipart/form-data">
                    <label for="game_name">Game Name:</label>
                    <input type="text" id="game_name" name="game_name" required>

                    <label for="game_description">Game Description:</label>
                    <textarea id="game_description" name="game_description" required></textarea>

                    <label for="game_image">Game Image:</label>
                    <input type="file" id="game_image" name="game_image" accept="image/*" required>

                    <button type="submit" name="add_game">Add Game</button>
                </form>
            </div>

            <!-- Games Table -->
            <div class="games-table">
                <h2>Available Games</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Game Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $games->fetch_assoc()): ?>
                            <tr>
                                <td><img src="<?=htmlspecialchars($row['game_image']) ?>"  alt="Game Image" class="game-preview"></td>
                                <td><?= htmlspecialchars($row['game_name']) ?></td>
                                <td><?= htmlspecialchars($row['game_description']) ?></td>
                                <td>
                                    <a href="add_popular_games.php?delete_id=<?= $row['id'] ?>" class="delete-btn"
                                       onclick="return confirm('Are you sure you want to delete this game?');">Delete</a>
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

