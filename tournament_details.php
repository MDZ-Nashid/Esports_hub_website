<?php
session_start();
include('includes/db.php'); // Include database connection

// Fetch game from URL
$game = isset($_GET['game']) ? htmlspecialchars($_GET['game']) : null;

if (!$game) {
    echo "<h2 style='text-align:center;'>No game selected.</h2>";
    exit();
}

// Prepare and execute the query
$query = "SELECT name, date, prizepool, hosted_by FROM tournament_details WHERE game = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $game);
$stmt->execute();
$result = $stmt->get_result();

// Fetch tournaments
$tournaments = [];
while ($row = $result->fetch_assoc()) {
    $tournaments[] = $row;
}

// Close connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($game); ?> Tournaments</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Include the Navbar -->
    <?php include('includes/navbar.php'); ?>

    <div class="tournament-details-container">
        <h2><?php echo ucfirst($game); ?> Upcoming Tournaments</h2>
        <?php if (!empty($tournaments)): ?>
            <ul class="tournament-list">
                <?php foreach ($tournaments as $tournament): ?>
                    <li class="tournament-item">
                        <h3><?php echo htmlspecialchars($tournament['name']); ?></h3>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($tournament['date']); ?></p>
                        <p><strong>Prize Pool:</strong> <?php echo htmlspecialchars($tournament['prizepool']); ?></p>
                        <p><strong>Hosted By:</strong> <?php echo htmlspecialchars($tournament['hosted_by']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p style="text-align:center;">No upcoming tournaments found for <?php echo htmlspecialchars($game); ?>.</p>
        <?php endif; ?>
    </div>
</body>

<?php include('includes/footer.php') ?>
</html>
