<?php
// index.php
session_start();
require 'includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Fetch tournaments from the database
$query = $conn->query("SELECT * FROM tournaments");
$tournaments = $query->fetch_all(MYSQLI_ASSOC);

// Fetch popular games from the database
$query2 = "SELECT * FROM games LIMIT 6";
$result = mysqli_query($conn, $query2);
$games = mysqli_fetch_all($result, MYSQLI_ASSOC);



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Esports HUB</title>
</head>
<body>
    <!-- Navbar -->
    <?php include('includes/navbar.php'); ?>


    <div class="upcoming-tournaments">
        <h2>Upcoming Dashing Tournaments</h2>
    </div>
    <!-- Carousel -->
<div class="carousel">
    <div class="carousel-inner">
        <?php foreach ($tournaments as $index => $tournament): ?>
        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
            <img src="<?php echo $tournament['image']; ?>" alt="<?php echo htmlspecialchars($tournament['game']); ?>">
            <div class="carousel-caption">
                <h3><?php echo htmlspecialchars($tournament['name']); ?></h3>
                <a href="tournament_details.php?game=<?php echo urlencode($tournament['game']); ?>" class="details-btn">View Details</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control prev" onclick="prevSlide()">❮</button>
    <button class="carousel-control next" onclick="nextSlide()">❯</button>
</div>



<div class="title-section">
    <h2 class="section-title">Explore Popular Esports Games</h2>
    <p class="section-subtitle">Discover the top games that dominate the esports world.</p>
</div>


 <!-- Game Cards Section -->
 <div class="game-cards-section">
        <div class="game-cards-container">
            <!-- First Section: 3 Cards -->
            <div class="game-cards">
                <?php
                // Iterate through the first 3 games
                foreach (array_slice($games, 0, 3) as $game) {
                    echo '
                    <div class="game-card">
                        <img src="' . $game['game_image'] . '" alt="' . $game['game_name'] . '">
                        <div class="game-info">
                            <h3>' . $game['game_name'] . '</h3>
                            <p>' . $game['game_description'] . '</p>
                        </div>
                    </div>
                    ';
                }
                ?>
            </div>
            
            <!-- Second Section: 3 Cards -->
            <div class="game-cards">
                <?php
                // Iterate through the next 3 games
                foreach (array_slice($games, 3) as $game) {
                    echo '
                    <div class="game-card">
                        <img src="' . $game['game_image'] . '" alt="' . $game['game_name'] . '">
                        <div class="game-info">
                            <h3>' . $game['game_name'] . '</h3>
                            <p>' . $game['game_description'] . '</p>
                        </div>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="js/carousel.js"></script>
</body>
<?php include('includes/footer.php') ?>
</html>
