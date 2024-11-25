<?php
// include database connection (assuming you have a connection file)


include('db.php');

if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_GET['success']) ?>
    </div>
<?php elseif (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>

<?php 
// Initialize variables
$league_name = $start_date = $country = $no_of_teams = "";
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $league_name = mysqli_real_escape_string($conn, $_POST['league_name']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $no_of_teams = mysqli_real_escape_string($conn, $_POST['no_of_teams']);

    // Insert the data into the database
    $query = "INSERT INTO leagues (league_name, start_date, country, no_of_teams) VALUES ('$league_name', '$start_date', '$country', '$no_of_teams')";
    if (mysqli_query($conn, $query)) {
        header("Location: league.php"); // Redirect to leagues page after successful insert
        exit();
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leagues Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Sports League Admin</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="teams.php">Teams</a></li>
                    <li class="nav-item"><a class="nav-link" href="players.php">Players</a></li>
                    <li class="nav-item"><a class="nav-link" href="league.php">Leagues</a></li>
                    <li class="nav-item"><a class="nav-link" href="fixtures.php">Matches/Fixtures</a></li>
                    <li class="nav-item"><a class="nav-link" href="standings.php">Standings</a></li>
                    <li class="nav-item"><a class="nav-link" href="officials.php">Match Officials</a></li>
                    <li class="nav-item"><a class="nav-link" href="venues.php">Match Venues</a></li>
                    <li class="nav-item"><a class="nav-link" href="results.php">Results</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Leagues Management</h2>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLeagueModal">Add New League</button>
                </div>
                
                <!-- Error Message -->
                <?php if ($error_message != ""): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error_message ?>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>League ID</th>
                                    <th>League Name</th>
                                    <th>Country Of Origin</th>
                                    <th>Start Date</th>
                                    <th>Number of Teams</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch leagues from the database/ READ DATA
                                $result = mysqli_query($conn, "SELECT * FROM leagues");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                        <td>{$row['league_id']}</td>
                                        <td>{$row['league_name']}</td>
                                        <td>{$row['country']}</td>
                                        <td>{$row['start_date']}</td>
                                        <td>{$row['no_of_teams']}</td>
                                        <td>
                                            <a href='edit_league.php?id={$row['league_id']}' class='btn btn-primary btn-sm'>Edit</a>
                                            <a href='delete_league.php?id={$row['league_id']}' class='btn btn-danger btn-sm'>Delete</a>
                                        </td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add League Modal -->
    <div class="modal fade" id="addLeagueModal" tabindex="-1" aria-labelledby="addLeagueModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLeagueModalLabel">Add New League</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                     <!-- Add League Form -->
                    <form action="league.php" method="POST">
                        <div class="mb-3">
                            <label for="leagueName" class="form-label">League Name</label>
                            <input type="text" class="form-control" id="leagueName" name="league_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">country</label>
                            <input type="text" class="form-control" id="country" name="country" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_of_teams" class="form-label">Number of Teams</label>
                            <input type="number" class="form-control" id="no_of_teams" name="no_of_teams" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save League</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Custom JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
