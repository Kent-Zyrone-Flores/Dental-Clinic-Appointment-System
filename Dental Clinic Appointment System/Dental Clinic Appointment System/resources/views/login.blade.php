
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dental World Clinic - Login</title>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <!-- Login Form -->
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <nav class="navbar">
      <div class="navdiv">
        <!-- Logo with Image -->
        <div class="logo">
          <a href="#">
            <img src="Documentation/logo.png" alt="Dental World Clinic Logo">
            <span>Dental World Clinic</span>
          </a>
        </div>
        <!-- Navigation Links -->
        <ul>
          <li><a href="{{ route('landingpage') }}">Home</a></li>
          <button><a href="{{ route('login') }}">Log in</a></button>
        </ul>
      </div>
    </nav>

    <div class="login-form-container">
      <h1>Log In</h1>
      <p>Welcome back! Please log in to your account.</p>
  
      <!-- Display validation errors -->
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
  
      <form action="{{ route('login.submit') }}" method="POST">
          @csrf
          <div class="input-field">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
          </div>
          <div class="input-field">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" placeholder="Enter your password" required>
          </div>
          <div class="submit-button">
              <button type="submit">Log in</button>
          </div>
          <div>
              <p>Don't have an account? <a href="{{ route('signup') }}">Sign Up</a></p>
          </div>
      </form>
  </div>
  
  </form>

  <!-- Footer Section -->
  <footer class="footer">
    <div class="logo">
      <a href="#">
        <img src="Documentation/logo.png" alt="Dental World Clinic Logo">
        <span>DWC</span>
      </a>
    </div>
    <div class="footer-container">
      <div class="footer-details">
        <h2>Contact Details</h2>
        <p><strong>Phone:</strong> 0917-885-5153</p>
        <p><strong>Email:</strong> info@dentalworldclinic.com</p>
        <p><strong>Address:</strong> Poblacion, Tagoloan Misamis Oriental, 9001</p>
        <div class="footer-rights">
          <p>&copy; 2024 Dental World Clinic. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>

 <!-- Success message alert -->
 @if(session('success'))
        <div class="alert alert-success" style="background-color: #4CAF50; color: white; padding: 15px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error message alert -->
    @if(session('error'))
        <div class="alert alert-danger" style="background-color: #f44336; color: white; padding: 15px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif
 <!-- Success message alert -->
 @if(session('success'))
        <div class="alert alert-success" style="background-color: #4CAF50; color: white; padding: 15px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error message alert -->
    @if(session('error'))
        <div class="alert alert-danger" style="background-color: #f44336; color: white; padding: 15px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif