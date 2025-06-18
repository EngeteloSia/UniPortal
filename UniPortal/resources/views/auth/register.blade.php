<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | Dynamic Laravel App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
</head>
<body>

  <!-- Header -->
  <header>
    <div class="logo">
      <img src="https://via.placeholder.com/100x40?text=Logo" alt="App Logo">
      <h1 style="font-size: 18px;">Dynamic Laravel App</h1>
    </div>
    <div class="kebab" onclick="togglePanel()">⋮</div>
  </header>

  <!-- Side Panel -->
  <div class="side-panel" id="sidePanel">
    <div class="close-btn" onclick="togglePanel()">×</div>
    <h3>Quick Menu</h3>
    <a href="#">Home</a>
    <a href="#">Contact</a>
    <a href="#">About Project</a>
  </div>

  <!-- Register Box -->
  <div class="login-wrapper">
    <h2>Create an Account</h2>
    <form>
      <div class="form-group">
        <label>Full Name</label>
        <input type="text" required placeholder="Enter your full name">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" required placeholder="Enter your email">
      </div>
      <div class="form-group">
        <label>Card Number</label>
        <input type="text" required placeholder="Enter your Card Number">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" required placeholder="Create a password">
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" required placeholder="Confirm your password">
      </div>
      <button type="submit" class="login-btn">Register</button>
    </form>
    <div class="footer-note">
      Already have an account? <a href="index.html">Login</a>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Dynamic Laravel App. Developed by Group XYZ.</p>
    <p>
      <a href="#">Privacy Policy</a> |
      <a href="#">Terms of Service</a>
    </p>
  </footer>

  <!-- JS -->
  <script>
    function togglePanel() {
      document.getElementById('sidePanel').classList.toggle('active');
    }
  </script>

</body>
</html>
