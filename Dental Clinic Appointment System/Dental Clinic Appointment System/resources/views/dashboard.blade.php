<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/appointment.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Dashboard</title>
    
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
        <h1>Welcome to the Dental World</h1>

        <!-- Revenue List and Calendar Section -->
        <div class="row mb-4">
            <!-- Revenue List -->
            <div class="col-md-6">
                <h4>Revenue List</h4>
                <div class="revenue-list">
                    <ul>
                        <li>Revenue 1: 1000</li>
                        <li>Revenue 2: 1200</li>
                        <li>Revenue 3: 1500</li>
                        <li>Revenue 4: 900</li>
                    </ul>
                </div>
            </div>

            <!-- Calendar -->
            <div class="col-md-6">
                <div class="calendar">
                    <h4>Calendar</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sun</th>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                            </tr>
                        </thead>
                        <tbody id="calendar-body">
                            <tr>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>9</td>
                                <td>10</td>
                                <td>11</td>
                                <td>12</td>
                                <td>13</td>
                                <td>14</td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                                <td>19</td>
                                <td>20</td>
                                <td>21</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>23</td>
                                <td>24</td>
                                <td>25</td>
                                <td>26</td>
                                <td>27</td>
                                <td>28</td>
                            </tr>
                            <tr>
                                <td>29</td>
                                <td>30</td>
                                <td>31</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Patient List -->
        <div class="patient-table">
            <h4>Patient List</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>John Doe</td>
                        <td>34</td>
                        <td>(123) 456-7890</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Jane Smith</td>
                        <td>28</td>
                        <td>(987) 654-3210</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript to highlight the current date -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date();
            const day = today.getDate();
            const calendarCells = document.querySelectorAll("#calendar-body td");

            calendarCells.forEach(cell => {
                if (parseInt(cell.textContent) === day) {
                    cell.classList.add("today");
                }
            });
        });
    </script>
</body>
</html>
