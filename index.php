<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports League Admin Dashboard</title>
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
    
    <!-- Main Dashboard Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Statistics Cards -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Teams</div>
                    <div class="card-body">
                        <h5 class="card-title">25</h5> <!-- Example static data -->
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Players</div>
                    <div class="card-body">
                        <h5 class="card-title">150</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Leagues</div>
                    <div class="card-body">
                        <h5 class="card-title">5</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3" >
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Matches/Fixtures</div>
                    <div class="card-body">
                        <h5 class="card-title">30</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">League Standings</div>
                    <div class="card-body">
                        <h5 class="card-title">5 Leagues</h5> <!-- Example static data -->
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Officials Table</div>
                    <div class="card-body">
                        <h5 class="card-title">25</h5> <!-- Example static data -->
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Venues Tables</div>
                    <div class="card-body">
                        <h5 class="card-title">25</h5> <!-- Example static data -->
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Results</div>
                    <div class="card-body">
                        <h5 class="card-title">25</h5> <!-- Example static data -->
                    </div>
                </div>
            </div>

        
        </div>

      

        <!-- Table for Displaying Data -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Teams Management</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Team ID</th>
                                    <th>Team Name</th>
                                    <th>Coach</th>
                                    <th>Home City</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example rows -->
                                <tr>
                                    <td>1</td>
                                    <td>Team A</td>
                                    <td>Coach X</td>
                                    <td>City Y</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Team B</td>
                                    <td>Coach Y</td>
                                    <td>City Z</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script> <!-- Custom JavaScript file -->
</body>
</html>
