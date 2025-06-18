<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lecturer Dashboard</title>
  <link rel="stylesheet" href="studentdashboard.css" />
  <style>
    .cards-section { display: none; }
    .cards-section.active { display: flex; }
    .cards { display: flex; gap: 1rem; }
  </style>
</head>
<body>

  <header>
    <div class="logo">📗 Lecturer Portal</div>
    <div class="user-role">Logged in as: Lecturer</div>
  </header>

  <div class="container">
    <aside>
      <nav>
        <a href="#" id="dashboard-link">Dashboard</a>
        <a href="#" id="courses-link">Manage Courses</a>
        <a href="#" id="students-link">Enrolled Students</a>
        <a href="#" id="profile-link">Profile</a>
        <a href="#" id="logout-link">Logout</a>
      </nav>
    </aside>

    <main>
      <h1>Welcome, Lecturer!</h1>
      <p>Manage your courses and student records efficiently.</p>
      
      <!-- Dashboard Cards -->
      <div class="cards-section active" id="dashboard-cards">
        <div class="cards">
          <div class="card">
            <h3>Courses Taught</h3>
            <p>3</p>
          </div>
          <div class="card">
            <h3>Students Enrolled</h3>
            <p>120</p>
          </div>
          <div class="card">
            <h3>Pending Assignments</h3>
            <p>8</p>
          </div>
        </div>
      </div>
      
      <!-- Manage Courses Cards -->
      <div class="cards-section" id="courses-cards">
        <div class="cards">
          <div class="card">
            <h3>Active Courses</h3>
            <p>2</p>
          </div>
          <div class="card">
            <h3>Archived Courses</h3>
            <p>1</p>
          </div>
        </div>
      </div>
      
      <!-- Enrolled Students Cards -->
      <div class="cards-section" id="students-cards">
        <div class="cards">
          <div class="card">
            <h3>Total Students</h3>
            <p>120</p>
          </div>
          <div class="card">
            <h3>Top Performer</h3>
            <p>Jane Doe</p>
          </div>
        </div>
      </div>
      
      <!-- Profile Cards -->
      <div class="cards-section" id="profile-cards">
        <div class="cards">
          <div class="card">
            <h3>Name</h3>
            <p>Lecturer Name</p>
          </div>
          <div class="card">
            <h3>Email</h3>
            <p>lecturer@email.com</p>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    const links = {
      'dashboard-link': 'dashboard-cards',
      'courses-link': 'courses-cards',
      'students-link': 'students-cards',
      'profile-link': 'profile-cards'
    };

    Object.keys(links).forEach(linkId => {
      document.getElementById(linkId).addEventListener('click', function(e) {
        e.preventDefault();
        // Hide all card sections
        document.querySelectorAll('.cards-section').forEach(section => {
          section.classList.remove('active');
        });
        // Show the selected card section
        document.getElementById(links[linkId]).classList.add('active');
      });
    });
  </script>
</body>
</html>