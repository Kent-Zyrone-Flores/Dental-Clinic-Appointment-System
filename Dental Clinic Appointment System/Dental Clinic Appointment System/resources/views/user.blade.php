<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dental World Clinic</title>
  <link rel="stylesheet" href="css/landingpage.css">
</head>
<body>
  <nav class="navbaruser">
    <nav class="navbar">
      <div class="navdiv">
        <div class="logo">
          <a href="#">
            <img src="Documentation/logo.png" alt="Dental World Clinic Logo">
            <span>Dental World Clinic</span>
          </a>
        </div>
        <ul>
          <button><a href="/">Logout</a></button>
        </ul>
      </div>
    </nav>
  </nav>
  
  <center>
    @if (Auth::check())
        <h1>Hello, {{ Auth::user()->email }}</h1>
    @else
        <h1>Welcome, Guest!</h1>
    @endif
</center>


  <div style="
    display: flex; flex-direction: row;
  " class="container">
     
    <form method="POST" action="{{ route('user.submit') }}">
      @csrf
      <div style="border: solid rgb(182, 181, 181) 1px" class="form-container">
        <h2>Book Appointment</h2>
        <center>
          <form id="appointmentForm">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Full Name" required>

            <label for="phone">Contact No.</label>
            <input type="tel" id="phone" name="phone" placeholder="Contact Number" required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="Address" required>

            <label for="service">Service</label>
            <select id="service" name="service" required>
              <option value="General Dentistry" data-price="₱1000">General Dentistry</option>
              <option value="Orthodontics" data-price="₱1500 ">Orthodontics</option>
              <option value="Cosmetic Dentistry" data-price="₱2000">Cosmetic Dentistry</option>
              <option value="Pediatric Dentistry" data-price="₱2500">Pediatric Dentistry</option>
              <option value="Specialized Procedures" data-price="₱3000">Specialized Procedures</option>
            </select>
            <br>

            <label for="amount">Amount</label>
            <input type="text" id="amount" name="amount" placeholder="Amount" readonly required>

            <label for="date">Date</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Time</label>
            <input type="time" id="time" name="time" required>

            <button type="submit">Book</button>
          </form>
        </center>
      </div>
    </form>
 

    <div style="margin-left: 10px; border: solid rgb(182, 181, 181) 1px" class="booking-container">
      <h2>Booking Appointments</h2>
      <table class="appointment-table" id="bookingTable">
        <thead>
          <tr>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Service</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Cancel</th>
          </tr>
        </thead>
        <tbody>
          @foreach($appointments as $appointment)
            <tr>
              <td>{{ $appointment->name }}</td>
              <td>{{ $appointment->phone }}</td>
              <td>{{ $appointment->address }}</td>
              <td>{{ $appointment->service }}</td>
              <td>{{ $appointment->amount }}</td>
              <td>{{ $appointment->date }}</td>
              <td>{{ $appointment->time }}</td>
              <td>{{ $appointment->status }}</td>
              <td><button class="cancel-button" onclick="removeRow(this)">Cancel</button></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <script>
    const appointmentForm = document.getElementById('appointmentForm');
    const serviceSelect = document.getElementById('service');
    const amountInput = document.getElementById('amount');

    serviceSelect.addEventListener('change', function () {
      const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
      const price = selectedOption.getAttribute('data-price');
      amountInput.value = price;
    });

    function removeRow(button) {
      const row = button.closest('tr');
      row.remove();
    }

    serviceSelect.dispatchEvent(new Event('change'));
  </script>
</body>
</html>
