<?php
session_start();
// Include database connection
include('db.php');

// Get the posted form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $team_name = $_POST['team_name'];
    $game_name = $_POST['game_name'];
    $coach_name = $_POST['coach_name'];
    $player_IGL = $_POST['player_IGL'];
    $player_1 = $_POST['player_1'];
    $player_2 = $_POST['player_2'];
    $player_3 = $_POST['player_3'];
    $player_4 = $_POST['player_4'];
    $player_5 = $_POST['player_5'];
    $user_id = $_SESSION['user_id']; // Assuming the user is logged in and user ID is available in session

    // Insert the new team into the database
    $query = "INSERT INTO teams ( team_name, game, igl_name, member1_name, member2_name, member3_name, member4_name, member5_name, coach_name,user_id) 
              VALUES ('$team_name', '$game_name', '$player_IGL', '$player_1', '$player_2', '$player_3', '$player_4', '$player_5','$coach_name','$user_id')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../team.php"); // Redirect back to the team page
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
