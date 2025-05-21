<?php
  include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: black;
    }
    .container {
      padding: 2rem;
    }
    h2 {
      margin-bottom: 1rem;
      color: white;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr); /* 4 cards in one line */
      gap: 1rem;
    }
    .card {
      background: white;
      padding: 0;
      border-radius: 6px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: center;
      height: 100px; /* Make card shorter */
      display: flex;
      flex-direction: column;
      overflow: hidden;
    }
    .card h3 {
      margin: 0.5rem 0 0.2rem 0;
    }
    .card p {
      margin: 0 0 0.5rem 0;
      color: #444;
      font-size: 0.95rem;
    }
    
    .podcast-cover {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 6px;
      margin: 0;
      display: block;
    }
  </style>
</head>
<body>
  
  <div class="container">
  <h2>Choose a Category</h2>
  <div class="grid">
    <div class="card">
      <img src="img/business.png" alt="Business" class="podcast-cover" />
    </div>
    <div class="card">
      <img src="img/health.png" alt="Health & Wellness" class="podcast-cover" />
    </div>
    <div class="card">
      <img src="img/technology.jpg" alt="Technology" class="podcast-cover" />
    </div>
    <div class="card">
      <img src="img/lifestyle.png" alt="Lifestyle" class="podcast-cover" />
    </div>
  </div>
  <!-- New set of categories below -->
  <h2 style="margin-top:2rem;"></h2>
  <div class="grid">
    <div class="card">
      <img src="img/education.png" alt="Education" class="podcast-cover" />
    </div>
    <div class="card">
      <img src="img/sports.jpg" alt="Sports" class="podcast-cover" />
    </div>

    <div class="card">
      <img src="img/comedy.jpg" alt="Comedy" class="podcast-cover" />
    </div>
    <div class="card">
      <img src="img/music.jpg" alt="Music" class="podcast-cover" />
    </div>
    
  </div>
</div>

  <script>
    // JavaScript to toggle the dropdown menu
    document.getElementById('menuBtn').addEventListener('click', function() {
      var dropdown = document.getElementById('dropdownMenu');
      if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
      } else {
        dropdown.style.display = 'block';
      }
    });

    // Close the dropdown menu if the user clicks outside of it
    window.addEventListener('click', function(event) {
      var dropdown = document.getElementById('dropdownMenu');
      if (!event.target.matches('.menu-icon') && !event.target.matches('.menu-icon *')) {
        dropdown.style.display = 'none';
      }
    });
  </script>
</body>
</html>
