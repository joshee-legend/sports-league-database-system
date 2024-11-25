<?php
// Include database connection
include('db.php');

// Initialize variables
$team_id = $team_name = $city = $league_name = $founded_year = $team_coach = $home_stadium = "";
$error_message = $success_message = "";

// Check if the `id` parameter is present
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $team_id = intval($_GET['id']);

    // Fetch the team details from the database
    $query = "SELECT * FROM teams WHERE team_id = $team_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        // Fetch the team details
        $team = mysqli_fetch_assoc($result);
        $team_name = $team['team_name'];
        $city = $team['city'];
        $league_name = $team['league_name'];
        $founded_year = $team['founded_year'];
        $team_coach = $team['team_coach'];
        $home_stadium = $team['home_stadium'];
    } else {
        // Redirect if the team doesn't exist
        header("Location: teams.php?error=Team not found");
        exit();
    }
} else {
    // Redirect if no valid `id` is provided
    header("Location: teams.php?error=Invalid team ID");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $team_name = mysqli_real_escape_string($conn, $_POST['team_name']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $league_name = mysqli_real_escape_string($conn, $_POST['league_name']);
    $founded_year = intval($_POST['founded_year']);
    $team_coach = mysqli_real_escape_string($conn, $_POST['team_coach']);
    $home_stadium = mysqli_real_escape_string($conn, $_POST['home_stadium']);

    // Update query
    $update_query = "UPDATE teams 
                     SET team_name = '$team_name', 
                         city = '$city', 
                         league_name = '$league_name', 
                         founded_year = $founded_year, 
                         team_coach = '$team_coach', 
                         home_stadium = '$home_stadium' 
                     WHERE team_id = $team_id";

    if (mysqli_query($conn, $update_query)) {
        $success_message = "Team updated successfully!";
    } else {
        $error_message = "Error updating team: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Sports League Admin</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="teams.php">Teams</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Edit Team</h2>

        <!-- Success and Error Messages -->
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
        <?php endif; ?>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>

        <!-- Edit Team Form -->
        <form method="POST">
            <div class="mb-3">
                <label for="team_name" class="form-label">Team Name</label>
                <input type="text" class="form-control" id="team_name" name="team_name" value="<?= htmlspecialchars($team_name) ?>" required>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($city) ?>" required>
            </div>
            <div class="mb-3">
                <label for="league_name" class="form-label">League</label>
                <select class="form-select" id="league_name" name="league_name" required>
                    <option value="Premier League" <?= $league_name == "Premier League" ? "selected" : "" ?>>Premier League</option>
                    <option value="La Liga" <?= $league_name == "La Liga" ? "selected" : "" ?>>La Liga</option>
                    <option value="Bundesliga" <?= $league_name == "Bundesliga" ? "selected" : "" ?>>Bundesliga</option>
                    <option value="Serie A" <?= $league_name == "Serie A" ? "selected" : "" ?>>Serie A</option>
                    <option value="Ligue 1" <?= $league_name == "Ligue 1" ? "selected" : "" ?>>Ligue 1</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="founded_year" class="form-label">Founded Year</label>
                <input type="number" class="form-control" id="founded_year" name="founded_year" value="<?= htmlspecialchars($founded_year) ?>" required>
            </div>
            <div class="mb-3">
                <label for="team_coach" class="form-label">Team Coach</label>
                <input type="text" class="form-control" id="team_coach" name="team_coach" value="<?= htmlspecialchars($team_coach) ?>" required>
            </div>
            <div class="mb-3">
                <label for="home_stadium" class="form-label">Home Stadium</label>
                <input type="text" class="form-control" id="home_stadium" name="home_stadium" value="<?= htmlspecialchars($home_stadium) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Team</button>
            <a href="teams.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
