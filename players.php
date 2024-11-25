<?php
// Database connection
include('db.php');  // Include your DB connection file (update the path if necessary)





// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $team_id = mysqli_real_escape_string($conn, $_POST['team_id']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $shirt_number = mysqli_real_escape_string($conn, $_POST['shirt_number']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $contacts = mysqli_real_escape_string($conn, $_POST['contacts']);
    $joined_year = mysqli_real_escape_string($conn, $_POST['joined_year']);

    // Insert query
    $query = "INSERT INTO players (first_name, last_name, team_id, position, shirt_number, date_of_birth, nationality, height, weight, contacts, joined_year) 
              VALUES ('$first_name', '$last_name', '$team_id', '$position', '$shirt_number', '$date_of_birth', '$nationality', '$height', '$weight', '$contacts', '$joined_year')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Redirect back to players page after successful insertion
        header("Location: players.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
$query = "SELECT player_id, first_name, last_name, teams.team_name, leagues.league_name, position, shirt_number, date_of_birth, nationality, height, weight, contacts, joined_year 
          FROM players 
          JOIN teams  ON players.team_id = teams.team_id
          JOIN leagues ON teams.league_id = leagues.league_id"; // Adjust table and column names according to your schema

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- Custom CSS file -->
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
        <div class="row mb-3">
            <div class="col-md-6">
                <h2>Players Management</h2>
            </div>
            <div class="col-md-6 text-end">
                <input type="text" id="searchBar" class="form-control" placeholder="Search by name, league, team, position, or age...">
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addPlayerModal">Add New Player</button>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Player ID</th>
                            <th>Team ID</th>
                            <th>F.Name</th>
                            <th>L.Name</th>
                            <th>Team</th>
                            <th>League</th>
                            <th>Position</th>
                            <th>Shirt No.</th>
                            <th>DOB</th>
                            <th>Current Age</th>
                            <th>Nationality</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Contacts</th>
                            <th>Joined Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="playersTableBody">
                        <?php
                        // Check if there are any players to display
                        if (mysqli_num_rows($players_result) > 0) {
                            while ($row = mysqli_fetch_assoc($players_result)) {
                                // Calculate age based on DOB (assuming DOB is in 'YYYY-MM-DD' format)
                                $dob = new DateTime($row['date_of_birth']);
                                $today = new DateTime('today');
                                $age = $today->diff($dob)->y;

                                echo "<tr>
                                        <td>{$row['player_id']}</td>
                                        <td>{$row['team_id']}</td>
                                        <td>{$row['first_name']}</td>
                                        <td>{$row['last_name']}</td>
                                        <td>{$row['team_name']}</td>
                                        <td>{$row['league_name']}</td>
                                        <td>{$row['position']}</td>
                                        <td>{$row['shirt_number']}</td>
                                        <td>{$row['date_of_birth']}</td>
                                        <td>{$age}</td>
                                        <td>{$row['nationality']}</td>
                                        <td>{$row['height']}</td>
                                        <td>{$row['weight']}</td>
                                        <td>{$row['contacts']}</td>
                                        <td>{$row['joined_year']}</td>
                                        <td>
                                            <button class='btn btn-primary btn-sm'>Edit</button>
                                            <button class='btn btn-danger btn-sm'>Delete</button>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='16'>No players found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Player Modal -->

 

    <div class="modal fade" id="addPlayerModal" tabindex="-1" aria-labelledby="addPlayerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlayerModalLabel">Add New Player</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="players.php" method="POST">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="team_id" class="form-label">Team</label>
                            <select class="form-control" id="team_id" name="team_id" required>
                                <?php
                                // Fetch teams from database for the dropdown
                                $team_query = "SELECT team_id, team_name FROM teams";
                                $team_result = mysqli_query($conn, $team_query);
                                while ($team = mysqli_fetch_assoc($team_result)) {
                                    echo "<option value='{$team['team_id']}'>{$team['team_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="position" required>
                        </div>
                        <div class="mb-3">
                            <label for="shirt_number" class="form-label">Shirt Number</label>
                            <input type="number" class="form-control" id="shirt_number" name="shirt_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                        </div>
                        <div class="mb-3">
                            <label for="nationality" class="form-label">Nationality</label>
                            <input type="text" class="form-control" id="nationality" name="nationality" required>
                        </div>
                        <div class="mb-3">
                            <label for="height" class="form-label">Height (cm)</label>
                            <input type="number" class="form-control" id="height" name="height" required>
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Weight (kg)</label>
                            <input type="number" class="form-control" id="weight" name="weight" required>
                        </div>
                        <div class="mb-3">
                            <label for="contacts" class="form-label">Contacts</label>
                            <input type="text" class="form-control" id="contacts" name="contacts" required>
                        </div>
                        <div class="mb-3">
                            <label for="joined_year" class="form-label">Joined Year</label>
                            <input type="number" class="form-control" id="joined_year" name="joined_year" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Player</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Custom JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script> <!-- Custom JavaScript file -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchBar = document.getElementById("searchBar");
            const tableRows = document.querySelectorAll("#playersTableBody tr");

            // Filter table rows based on search input
            searchBar.addEventListener("input", function () {
                const filter = searchBar.value.toLowerCase();
                tableRows.forEach(row => {
                    const playerName = row.children[2].textContent.toLowerCase();
                    const teamName = row.children[4].textContent.toLowerCase();
                    const leagueName = row.children[5].textContent.toLowerCase();
                    const position = row.children[6].textContent.toLowerCase();
                    const age = row.children[9].textContent.toLowerCase();

                    if (
                        playerName.includes(filter) ||
                        teamName.includes(filter) ||
                        leagueName.includes(filter) ||
                        position.includes(filter) ||
                        age.includes(filter)
                    ) {
                        row.style.display = ""; // Show row
                    } else {
                        row.style.display = "none"; // Hide row
                    }
                });
            });
        });
    </script>
</body>
</html>
