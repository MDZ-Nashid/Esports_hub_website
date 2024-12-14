<?php
session_start();
include 'includes/db.php'; // Include database connection

// Fetch news from database
$sql = "SELECT * FROM news ORDER BY news_time DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('includes/navbar.php'); ?>
    <!-- Big Title Section -->
    <div class="news-header">
        <h1>Popular News</h1>
    </div>

    <!-- News Cards Section -->
    <div class="news-container">
        <?php
        if ($result->num_rows > 0) {
            foreach ($result as $news) {
                echo "
                <div class='news-card'>
                    <h2>{$news['title']}</h2>
                    <p>{$news['description']}</p>
                    <a href='news_details.php?id={$news['id']}' class='read-more'>Read More</a>
                    <p class='news-time'>Published on: " . date('F j, Y, g:i A', strtotime($news['news_time'])) . "</p>
                </div>";
            }
        } else {
            echo "<p>No news available.</p>";
        }
        ?>
    </div>

</body>
<?php include('includes/footer.php') ?>
</html>
