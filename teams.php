


<?php
// Include database connection
include('db.php');

// Initialize variables
$team_name = $city = $league_name = $founded_year = "";
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form values are set and sanitize them
    if (isset($_POST['team_name']) && !empty($_POST['team_name'])) {
        $team_name = mysqli_real_escape_string($conn, $_POST['team_name']);
    }
    
    if (isset($_POST['city']) && !empty($_POST['city'])) {
        $city = mysqli_real_escape_string($conn, $_POST['city']);
    }
    
    if (isset($_POST['league_name']) && !empty($_POST['league_name'])) {
        $league_name = mysqli_real_escape_string($conn, $_POST['league_name']);
    }
    
    if (isset($_POST['team_coach']) && !empty($_POST['team_coach'])) {
        $team_coach = mysqli_real_escape_string($conn, $_POST['team_coach']);
    }
    
    if (isset($_POST['home_stadium']) && !empty($_POST['home_stadium'])) {
        $home_stadium = mysqli_real_escape_string($conn, $_POST['home_stadium']);
    }
    
    // Validate the founded year (ensure it’s a valid integer)
    if (isset($_POST['founded_year']) && is_numeric($_POST['founded_year']) && !empty($_POST['founded_year'])) {
        $founded_year = mysqli_real_escape_string($conn, $_POST['founded_year']);
    } else {
        $error_message = "Founded year must be a valid number!";
    }

    // Insert the data into the database if all required fields are provided
    if ($team_name && $city && $league_name && $founded_year) {
        $query = "INSERT INTO teams (team_name, city, league_name, founded_year, team_coach, home_stadium) 
                  VALUES ('$team_name', '$city', '$league_name', '$founded_year', '$team_coach', '$home_stadium')";
        if (mysqli_query($conn, $query)) {
            // No redirection here, just re-fetch the teams to show them immediately
        } else {
            $error_message = "Error: " . mysqli_error($conn);
        }
    } else {
        $error_message = "Please fill in all fields!";
    }
}

// Fetch teams from the database (re-fetching after insert)
$teams_query = "SELECT * FROM teams";
$teams_result = mysqli_query($conn, $teams_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams Management</title>
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
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="teams.php">Teams</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="players.php">Players</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="league.php">Leagues</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="fixtures.php">Matches/Fixtures</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="standings.php">Standings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="officials.php">Match Officials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="venues.php">Match Venues</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="results.php">Results</a>
                    </li>

                    
                </ul>
            </div>
        </div>
    </nav>
<!-- Main Content -->
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Teams Management</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTeamModal">Add Team</button>
    </div>

    <!-- Search Bar -->
    <div class="input-group mb-4">
        <input type="text" id="searchBar" class="form-control" placeholder="Search by team name, league, or city...">
    </div>

    <!-- Teams Table -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Team Name</th>
                <th>League</th>
                <th>City</th>
                <th>Team Coach</th>
                <th>Home Stadium</th>
                <th>Founded Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch each team from the database and display in the table
            $teams_query = "SELECT * FROM teams";  // Make sure you have the correct SQL query
            $teams_result = mysqli_query($conn, $teams_query);

            // Check if the query was successful and display teams
            if ($teams_result) {
                while ($row = mysqli_fetch_assoc($teams_result)) {
                    echo "<tr>
                            <td>{$row['team_name']}</td>
                            <td>{$row['league_name']}</td>
                            <td>{$row['city']}</td>
                            <td>{$row['team_coach']}</td>
                            <td>{$row['home_stadium']}</td>
                            <td>{$row['founded_year']}</td>
                            <td>
                                   <a href='edit_team.php?id={$row['team_id']}' class='btn btn-primary btn-sm'>Edit</a>
                                            <a href='delete_team.php?id={$row['team_id']}' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No teams found</td></tr>";  // Show a message if no teams are found
            }
            ?>
        </tbody>
    </table>
</div>


   <!-- Add Team Modal -->
   <div class="modal fade" id="addTeamModal" tabindex="-1" aria-labelledby="addTeamModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="teams.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTeamModalLabel">Add New Team</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="teamName" class="form-label">Team Name</label>
                            <input type="text" class="form-control" id="teamName" name="team_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="teamName" class="form-label">Team Coach</label>
                            <input type="text" class="form-control" id="team_coach" name="team_coach" required>
                        </div>

                        <div class="mb-3">
                            <label for="teamName" class="form-label">Home Stadium</label>
                            <input type="text" class="form-control" id="home_stadium" name="home_stadium" required>
                        </div>
                        <div class="mb-3">
                            <label for="league_name" class="form-label">League</label>
                            <select class="form-select" id="league_name" name="league_name" required>
                                <option value="Premier League">Premier League</option>
                                <option value="La Liga">La Liga</option>
                                <option value="Bundesliga">Bundesliga</option>
                                <option value="Serie A">Serie A</option>
                                <option value="Ligue 1">Ligue 1</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="teamCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="mb-3">
                            <label for="founded_year" class="form-label">Founded Year</label>
                            <input type="number" class="form-control" id="founded_year" name="founded_year" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Team</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Custom JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script> <!-- Custom JavaScript -->
    <script>
    document.getElementById("searchBar").addEventListener("input", function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll("table tbody tr");

        rows.forEach(function(row) {
            // Ensure to access the correct cell for each column (starting at index 0)
            const teamName = row.cells[0]?.textContent.toLowerCase() || "";
            const leagueName = row.cells[1]?.textContent.toLowerCase() || "";
            const city = row.cells[2]?.textContent.toLowerCase() || "";
            const teamCoach = row.cells[3]?.textContent.toLowerCase() || "";  // 4th column
            const homeStadium = row.cells[4]?.textContent.toLowerCase() || "";  // 5th column
            const foundedYear = row.cells[5]?.textContent.toLowerCase() || "";  // 6th column

            // Check if any of the columns contain the search term
            if (teamName.includes(searchTerm) || 
                leagueName.includes(searchTerm) || 
                city.includes(searchTerm) || 
                teamCoach.includes(searchTerm) || 
                homeStadium.includes(searchTerm) || 
                foundedYear.includes(searchTerm)) {
                row.style.display = "table-row";  // Show the row
            } else {
                row.style.display = "none";  // Hide the row
            }
        });
    });
</script>


    <?php
// Close the database connection
mysqli_close($conn);
?>
</body>
</html>
