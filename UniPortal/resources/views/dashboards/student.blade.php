<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Dashboard</title>
  <link rel="stylesheet" href="studentdashboard.css" />
  <style>
    .cards-section { display: none; }
    .cards-section.active { display: flex; }
    .cards { display: flex; gap: 1rem; }
  </style>
</head>
<body>

  <header>
    <div class="logo">📘 Student Portal</div>
    <div class="user-role">Logged in as: Student</div>
  </header>

  <div class="container">
    <aside>
      <nav>
        <a href="#" id="dashboard-link">Dashboard</a>
        <a href="#" id="courses-link">My Courses</a>
        <a href="#" id="grades-link">Grades</a>
        <a href="#" id="profile-link">Profile</a>
        <a href="#">Logout</a>
      </nav>
    </aside>

    <main>
      <h1>Welcome, Student!</h1>
      <p>Here are your enrolled courses and academic status.</p>
      
      <!-- Dashboard Cards -->
      <div class="cards-section active" id="dashboard-cards">
        <div class="cards">
          <div class="card">
            <h3>Total Courses</h3>
            <p>5</p>
          </div>
          <div class="card">
            <h3>Average Grade</h3>
            <p>75%</p>
          </div>
          <div class="card">
            <h3>Upcoming Exams</h3>
            <p>2</p>
          </div>
        </div>
      </div>
      
      <!-- My Courses Cards -->
      <div class="cards-section" id="courses-cards">
        <div class="cards">
          <div class="card">
            <h3>Current Courses</h3>
            <p>Math, Science, English, History, Art</p>
          </div>
        </div>
      </div>
      
      <!-- Grades Cards -->
      <div class="cards-section" id="grades-cards">
        <div class="cards">
          <div class="card">
            <h3>Math</h3>
            <p>80%</p>
          </div>
          <div class="card">
            <h3>Science</h3>
            <p>70%</p>
          </div>
          <div class="card">
            <h3>English</h3>
            <p>75%</p>
          </div>
        </div>
      </div>
      
      <!-- Profile Cards -->
      <div class="cards-section" id="profile-cards">
        <div class="cards">
          <div class="card">
            <h3>Name</h3>
            <p>Student Name</p>
          </div>
          <div class="card">
            <h3>Email</h3>
            <p>student@email.com</p>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    const links = {
      'dashboard-link': 'dashboard-cards',
      'courses-link': 'courses-cards',
      'grades-link': 'grades-cards',
      'profile-link': 'profile-cards'
    };

    Object.keys(links).forEach(linkId => {
      document.getElementById(linkId).addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('.cards-section').forEach(section => {
          section.classList.remove('active');
        });
        document.getElementById(links[linkId]).classList.add('active');
      });
    });
  </script>
</body>
</html>