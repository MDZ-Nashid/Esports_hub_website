<?php
session_start();
include 'includes/db.php';

// Get news ID from the query string
$news_id = $_GET['id'];

// Fetch the specific news
$sql = "SELECT * FROM news WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $news_id);
$stmt->execute();
$result = $stmt->get_result();
$news = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $news['title']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>


<body>
<?php include('includes/navbar.php'); ?>

    <!-- Main Content Wrapper -->
    <div class="main-content-wrapper">
        <!-- News Details Container -->
        <div class="news-details-container">
            <!-- News Title Section -->
            <div class="news-title-section">
                <h1><?php echo $news['title']; ?></h1>
                <p class="news-time">Published on: <?php echo date('F j, Y, g:i A', strtotime($news['news_time'])); ?></p>
            </div>

            <!-- News Content Section -->
            <div class="news-content">
                <p><?php echo nl2br($news['full_details']); ?></p>
            </div>

            <!-- Back to News Page -->
            <div class="back-to-news">
                <a href="news.php">← Back to News</a>
            </div>
        </div>
    </div>

</body>
<?php include('includes/footer.php') ?>
</html>
