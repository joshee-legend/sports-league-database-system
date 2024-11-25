<?php
// Include the database connection file
include 'db.php';

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $team1 = mysqli_real_escape_string($conn, $_POST['team1']);
    $team2 = mysqli_real_escape_string($conn, $_POST['team2']);
    $matchDate = mysqli_real_escape_string($conn, $_POST['matchDate']);
    $matchTime = mysqli_real_escape_string($conn, $_POST['matchTime']);
    $league = mysqli_real_escape_string($conn, $_POST['league']);
    
    // Example values for `venue_id` and `status`. Update as needed or include in the form.
    $venue_id = "1"; // Default venue ID
    $status = "Scheduled"; // Default match status
    $location = "Default Location"; // Update this as per your requirements

    // Insert data into the database
    $sql = "INSERT INTO fixtures ( team1_id, team2_id, match_date, match_time, venue_id, location, status)
            VALUES ('$team1', '$team2', '$matchDate', '$matchTime', '$venue_id', '$location', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Fixture added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixtures Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- Optional: Custom CSS -->
</head>
<body>
   <!-- Navigation Bar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Sports League Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="teams.php">Teams</a></li>
                    <li class="nav-item"><a class="nav-link" href="players.php">Players</a></li>
                    <li class="nav-item"><a class="nav-link" href="league.php">Leagues</a></li>
                    <li class="nav-item"><a class="nav-link active" href="fixtures.php">Matches/Fixtures</a></li>
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Fixtures Management</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addFixtureModal">Add Fixture</button>
        </div>

        <!-- Fixtures Table (Example for Premier League) -->
        <div class="accordion" id="fixturesAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Premier League
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#fixturesAccordion">
                    <div class="accordion-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>League</th>
                                    <th>Team 1</th>
                                    <th>Team 2</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Venue</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM fixtures");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                     
                                        <td>{$row['team1_id']}</td>
                                        <td>{$row['team2_id']}</td>
                                        <td>{$row['match_date']}</td>
                                        <td>{$row['match_time']}</td>
                                        <td>{$row['venue_id']}</td>
                                        <td>{$row['location']}</td>
                                        <td>{$row['status']}</td>
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

    <!-- Add Fixture Modal -->
    <div class="modal fade" id="addFixtureModal" tabindex="-1" aria-labelledby="addFixtureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="fixtures.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFixtureModalLabel">Add New Fixture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="team1" class="form-label">Team 1</label>
                            <input type="text" class="form-control" id="team1" name="team1" required>
                        </div>
                        <div class="mb-3">
                            <label for="team2" class="form-label">Team 2</label>
                            <input type="text" class="form-control" id="team2" name="team2" required>
                        </div>
                        <div class="mb-3">
                            <label for="matchDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="matchDate" name="matchDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="matchTime" class="form-label">Time</label>
                            <input type="time" class="form-control" id="matchTime" name="matchTime" required>
                        </div>
                        <div class="mb-3">
                            <label for="league" class="form-label">League</label>
                            <select class="form-select" id="league" name="league" required>
                                <option value="Premier League">Premier League</option>
                                <option value="La Liga">La Liga</option>
                                <option value="Bundesliga">Bundesliga</option>
                                <option value="Serie A">Serie A</option>
                                <option value="Ligue 1">Ligue 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Fixture</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
