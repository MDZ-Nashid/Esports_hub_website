<?php
session_start();
include('includes/db.php'); // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch the user's created teams from the database
$user_id = $_SESSION['user_id'];  // Assuming the user is logged in and their ID is stored in the session
$query = "SELECT * FROM teams WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Management</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('includes/navbar.php'); ?> <!-- Include Navbar -->

    <div class="team-page-container">
        <!-- Team Creation Form Section -->
        <div class="team-form">
            <h2>Create a New Team</h2>
            <form action="includes/team_creation_process.php" method="POST">
                <label for="team_name">Team Name:</label>
                <input type="text" id="team_name" name="team_name" required>

                <label for="game_name">Game Name:</label>
                <input type="text" id="game_name" name="game_name" required>

                <label for="coach_name">Coach Name:</label>
                <input type="text" id="coach_name" name="coach_name" required>

                <label for="player_IGL">IGL (In-game Leader):</label>
                <input type="text" id="player_IGL" name="player_IGL" required>

                <label for="player_1">Member 1:</label>
                <input type="text" id="player_1" name="player_1" required>

                <label for="player_2">Member 2:</label>
                <input type="text" id="player_2" name="player_2" required>

                <label for="player_3">Member 3:</label>
                <input type="text" id="player_3" name="player_3" required>

                <label for="player_4">Member 4:</label>
                <input type="text" id="player_4" name="player_4" required>

                <label for="player_5">Member 5:</label>
                <input type="text" id="player_5" name="player_5" required>

                <button type="submit">Create Team</button>
            </form>
        </div>

        <!-- Created Teams Section -->
        <div class="created-teams">
            <h2>Your Created Teams</h2>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <ul>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <li>
                            <strong><?php echo $row['team_name']; ?></strong><br>
                            Game: <?php echo $row['game']; ?><br>
                            Coach: <?php echo $row['coach_name']; ?><br>
                            Players: <?php echo $row['igl_name'] . ', ' . $row['member1_name'] . ', ' . $row['member2_name'] . ', ' . $row['member3_name'] . ', ' . $row['member4_name'] . ', ' . $row['member5_name'] ; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>You haven't created any teams yet.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

<?php include('includes/footer.php') ?>
</html>
