<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/appointment.css">
    <title>History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        
        .nav-links a:hover {
            background-color: #575757;
        }
        .logout-btn {
            background-color: green;
            text-align: center;
            padding: 10px 0;
            border-radius: 5px;
        }
        .logout-btn a {
            color: white;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: darkgreen;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }
        .history-table {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .control-buttons {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }
        .control-buttons button {
            margin-left: 10px;
        }
        .search-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }
        .search-bar {
            width: 300px;
            margin-right: 10px;
        }
        .search-button {
            margin-left: 10px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Profile Section -->
        <div class="profile-section">
            <img src="https://via.placeholder.com/80?text=Photo" alt="Profile Photo" class="profile-photo">
            <div class="name">Admin Name</div>
            <div class="email">admin@example.com</div>
        </div><hr>

        <!-- Navigation Links -->
        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('appointments') }}" class="nav-link">Appointments</a>
            <a href="{{ route('reports') }}" class="nav-link">Reports</a>
            <a href="{{ route('history') }}" class="nav-link">History</a>
        </div><hr><br><br><br><br><br>

        <div class="logout-btn"><a href="#" class="text-white text-decoration-none">Logout</a></div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>History</h1>

        <!-- Search Bar on the Right Side -->
        <div class="search-container">
            <input type="text" class="form-control search-bar" placeholder="Search history...">
            <button class="btn btn-success search-button">Search</button>
        </div>

        <!-- Control Buttons for CRUD Operations -->
        <div class="control-buttons">
            <button class="btn btn-primary">Create</button>
            <button class="btn btn-warning">Update</button>
            <button class="btn btn-danger">Delete</button>
        </div>

        <!-- History Table -->
        <div class="history-table">
            <h4>History List</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>History ID</th>
                        <th>Action</th>
                        <th>Timestamp</th>
                        <th>Performed By</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
