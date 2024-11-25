<?php
// Include database connection
include('db.php');

// Check if `id` parameter is present and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $team_id = intval($_GET['id']);

    // Prepare and execute the delete query
    $query = "DELETE FROM teams WHERE team_id = $team_id";

    if (mysqli_query($conn, $query)) {
        // Redirect to teams page with a success message
        header("Location: teams.php?message=Team deleted successfully");
        exit();
    } else {
        // Redirect to teams page with an error message
        header("Location: teams.php?error=Error deleting team: " . mysqli_error($conn));
        exit();
    }
} else {
    // Redirect to teams page if the `id` parameter is missing or invalid
    header("Location: teams.php?error=Invalid team ID");
    exit();
}
