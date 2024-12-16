<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/appointment.css">
    <title>History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Basic styles */
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

        .dropdown-container {
            margin-top: 20px;
            padding-left: 10px;
        }

        /* Dropdown Menu Styling */
        .dropdown-menu {
            background-color: black; /* Set the background to black */
            color: white; /* Set the text color to white */
            padding: 10px;
            display: none;
            border-radius: 5px;
        }

        /* Style the dropdown items */
        .dropdown-menu .dropdown-item {
            color: white; /* White text for dropdown items */
            padding: 10px 15px;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #575757; /* Dark gray background on hover */
        }

        /* Make the dropdown visible when active */
        .dropdown-menu.show {
            display: block;
        }

        .nav-links a.active + .dropdown-menu {
            display: block;
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
            <div class="email"> 
                @if (Auth::check())
                    <p>Hello, {{ Auth::user()->email }}</p>
                @else
                    <p>Welcome, Guest!</p>
                @endif
            </div>
        </div><hr>

        <!-- Navigation Links -->
        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('appointments') }}" class="nav-link">Appointments</a>
            <a href="{{ route('reports') }}" class="nav-link">Reports</a>
            
            <!-- History Link with Dropdown Menu -->
            <a href="#" class="nav-link" id="historyLink">History</a>
            <div class="dropdown-menu" id="historyDropdown">
                <a href="#" class="dropdown-item" data-status="no_show">No Show</a>
                <a href="#" class="dropdown-item" data-status="cancelled">Cancelled</a>
                <a href="#" class="dropdown-item" data-status="settled">Settled</a>
            </div>
        </div>

        <div class="logout-btn">
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn text-white text-decoration-none">Logout</button>
            </form>  
        </div>
    </div>

    <div class="main-content">
        <h1>History</h1>

        <div class="search-container">
            <input type="text" class="form-control search-bar" placeholder="Search reports...">
            <button class="btn btn-success search-button">Search</button>
        </div>

        <!-- Control buttons for Create, Update, Delete, and Print -->
        <div class="control-buttons">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createReportModal">Create Report</button>
            <button class="btn btn-warning" onclick="updateReport()">Update Report</button>
            <button class="btn btn-danger" id="deleteReportsBtn">Delete Selected</button>
            <button class="btn btn-info" onclick="printReport()">Print Report</button>
        </div>

        <div class="history-table">
            <h4>Generated Report History</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>Appointment ID</th>
                        <th>Patient Name</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Revenue</th>
                    </tr>
                </thead>
                <tbody id="historyData">
                    @foreach($appointments as $appointment)
                        <tr class="appointment-row" data-status="{{ $appointment->status }}">
                            <td><input type="checkbox" class="appointment-checkbox" data-id="{{ $appointment->id }}"></td>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->service }}</td>
                            <td>{{ $appointment->status }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->revenue }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Revenue -->
        <div class="total-revenue">
            <h4>Total Revenue: ₱{{ $totalRevenue }}</h4>
        </div>
    </div>

    <!-- Modal for Create Report -->
    <div class="modal fade" id="createReportModal" tabindex="-1" aria-labelledby="createReportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createReportModalLabel">Create Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createReportForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Report Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                                <option value="In Progress">In Progress</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Toggle the dropdown visibility when clicking on "History"
        document.getElementById('historyLink').addEventListener('click', function() {
            document.getElementById('historyDropdown').classList.toggle('show');
        });

        // Filter history by status
        const filterHistory = (status) => {
            const rows = document.querySelectorAll('.appointment-row');
            rows.forEach(row => {
                if (status === 'all' || row.getAttribute('data-status') === status) {
                    row.style.display = ''; // Show
                } else {
                    row.style.display = 'none'; // Hide
                }
            });
        };

        // Add event listeners for dropdown items
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                const status = e.target.getAttribute('data-status');
                filterHistory(status);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
