<?php
// Include database connection
include('db.php');

// Initialize variables
$league_id = $league_name = $start_date = $country = $no_of_teams = "";
$error_message = "";

// Get league data for editing
if (isset($_GET['id'])) {
    $league_id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM leagues WHERE league_id = $league_id");

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $league_name = $row['league_name'];
        $start_date = $row['start_date'];
        $country = $row['country'];
        $no_of_teams = $row['no_of_teams'];
    } else {
        $error_message = "League not found.";
    }
}

// Handle form submission for updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $league_id = intval($_POST['league_id']);
    $league_name = mysqli_real_escape_string($conn, $_POST['league_name']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $no_of_teams = intval($_POST['no_of_teams']);

    $query = "UPDATE leagues SET 
                league_name = '$league_name', 
                start_date = '$start_date', 
                country = '$country', 
                no_of_teams = $no_of_teams 
              WHERE league_id = $league_id";

    if (mysqli_query($conn, $query)) {
        header("Location: league.php"); // Redirect to leagues page after successful update
        exit();
    } else {
        $error_message = "Error updating league: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit League</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit League</h2>
        
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php endif; ?>

        <form action="edit_league.php" method="POST">
            <input type="hidden" name="league_id" value="<?= $league_id ?>">
            
            <div class="mb-3">
                <label for="leagueName" class="form-label">League Name</label>
                <input type="text" class="form-control" id="leagueName" name="league_name" value="<?= $league_name ?>" required>
            </div>
            <div class="mb-3">
                <label for="startDate" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="startDate" name="start_date" value="<?= $start_date ?>" required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" id="country" name="country" value="<?= $country ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_of_teams" class="form-label">Number of Teams</label>
                <input type="number" class="form-control" id="no_of_teams" name="no_of_teams" value="<?= $no_of_teams ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="league.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
