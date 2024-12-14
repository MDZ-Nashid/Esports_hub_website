
<nav class="navbar">
<div class="logo">
            <!-- Make the logo clickable -->
            <a href="index.php">
                <h1 id='esports'>Esports HUB</h1>
            </a>
        </div>
        <div class="navbar-links">
            <a href="news.php">News</a>
            <a href="team.php">Teams</a>

            <!-- User Dropdown -->
            <div class="profile-dropdown">
                <button class="profile-btn"><?php echo htmlspecialchars($_SESSION['username']); ?></button>
                <div class="dropdown-content">
                    <a href="includes/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>