<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Officials</title>
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
            <h2>Match Officials</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addOfficialModal">Add Official</button>
        </div>

        <!-- Search Bar -->
        <div class="mb-3">
            <input type="text" id="searchOfficials" class="form-control" placeholder="Search officials by name, role, or league">
        </div>

        <!-- Officials Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>League</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="officialsTable">
                <!-- Example Row -->
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>Referee</td>
                    <td>Premier League</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <!-- Additional rows will be dynamically added -->
            </tbody>
        </table>
    </div>

    <!-- Add Official Modal -->
    <div class="modal fade" id="addOfficialModal" tabindex="-1" aria-labelledby="addOfficialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addOfficialForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addOfficialModalLabel">Add Match Official</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="officialName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="officialName" required>
                        </div>
                        <div class="mb-3">
                            <label for="officialRole" class="form-label">Role</label>
                            <select class="form-select" id="officialRole" required>
                                <option value="Referee">Referee</option>
                                <option value="Assistant Referee">Assistant Referee</option>
                                <option value="VAR Official">VAR Official</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="officialLeague" class="form-label">League</label>
                            <select class="form-select" id="officialLeague" required>
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
                        <button type="submit" class="btn btn-success">Add Official</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script> <!-- Custom JavaScript -->
</body>
</html>
