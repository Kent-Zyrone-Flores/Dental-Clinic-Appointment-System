<!-- resources/views/appointments/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/appointment.css">
    <title>Appointments</title>
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
            <div class="email"> @if (Auth::check())
                <p>Hello, {{ Auth::user()->email }}</p>
            @else
                <p>Welcome, Guest!</p>
            @endif</div>
        </div><hr>

        <!-- Navigation Links -->
        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            <a href="{{ route('appointments') }}" class="nav-link">Appointments</a>
            <a href="{{ route('reports') }}" class="nav-link">Reports</a>
            <a href="{{ route('history') }}" class="nav-link">History</a>
        </div>

        <div class="logout-btn">
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn text-white text-decoration-none">Logout</button>
            </form>  
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Appointments</h1>

        <!-- Appointment Controls -->
        <div class="appointment-controls">
            <input type="text" class="form-control search-bar" placeholder="Search appointments...">
            <button class="btn btn-success search-button">Search</button>
        </div>

        <!-- Appointment Table -->
        <div class="appointment-table">
            <h4>Appointment List</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Patient Name</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Service</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->phone }}</td>
                            <td>{{ $appointment->address }}</td>
                            <td>{{ $appointment->service }}</td>
                            <td>{{ $appointment->amount }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>{{ $appointment->status }}</td>
                            
                            <td class="status-column">
    <select class="status-dropdown" data-id="{{ $appointment->id }}">
        <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
        <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
        <option value="Rescheduled" {{ $appointment->status == 'Rescheduled' ? 'selected' : '' }}>Rescheduled</option>
    </select>
    <a href="#" class="btn btn-danger btn-sm delete-btn" data-id="{{ $appointment->id }}">Delete</a>
</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener for changing status via dropdown
        document.querySelectorAll('.status-dropdown').forEach(dropdown => {
            dropdown.addEventListener('change', function() {
                const appointmentId = this.getAttribute('data-id');
                const newStatus = this.value;
                updateStatus(appointmentId, newStatus);
            });
        });

        // Event listener for Edit button
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const appointmentId = this.getAttribute('data-id');
                // Implement your edit functionality (open a modal or redirect to edit page)
                alert(`Edit appointment with ID: ${appointmentId}`);
            });
        });

        // Event listener for Delete button
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const appointmentId = this.getAttribute('data-id');
                deleteAppointment(appointmentId);
            });
        });
    });

    // Function to update appointment status via AJAX
    function updateStatus(appointmentId, newStatus) {
        fetch(`/appointments/update-status/${appointmentId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Status updated successfully!');
            } else {
                alert('Error updating status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the status.');
        });
    }

    // Function to delete an appointment via AJAX
    function deleteAppointment(appointmentId) {
        const confirmation = confirm("Are you sure you want to delete this appointment?");
        if (confirmation) {
            fetch(`/appointments/delete/${appointmentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF token for security
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Appointment deleted successfully!');
                    // Optionally, remove the row from the table after deletion
                    document.querySelector(`tr[data-id="${appointmentId}"]`).remove();
                } else {
                    alert('Error deleting appointment');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the appointment.');
            });
        }
    }
</script>
