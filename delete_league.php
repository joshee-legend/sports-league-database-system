<?php
// Include database connection
include('db.php');

// Check if an ID is provided
if (isset($_GET['id'])) {
    $league_id = intval($_GET['id']); // Sanitize ID

    //  the delete query
    $query = "DELETE FROM leagues WHERE league_id = $league_id";

    if (mysqli_query($conn, $query)) {
        header("Location: league.php?success=League+deleted+successfully"); // Redirect on success
        exit();
    } else {
        header("Location: league.php?error=" . urlencode("Error deleting league: " . mysqli_error($conn))); // Redirect with error message
        exit();
    }
} else {
    header("Location: league.php?error=" . urlencode("Invalid request")); // Redirect if no ID provided
    exit();
}
?>
