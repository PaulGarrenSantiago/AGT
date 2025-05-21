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
      padding: 1rem;
      border-radius: 6px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: center;
        height: 270px;
    }
    .card h3 {
      margin: 0.5rem 0 0.2rem 0;
    }
    .card p {
      margin: 0 0 0.5rem 0;
      color: #444;
      font-size: 0.95rem;
    }
    .card a {
      display: inline-block;
      margin-top: 0.1rem;
      background-color: #1e3a8a;
      color: white;
      padding: 0.3rem 9rem;
      text-decoration: none;
      border-radius: 4px;
    }
    .podcast-cover {
      width: 70%;
      height: 60%;
      border-radius: 4px;
      margin-bottom: 0.5rem;
    }

  </style>
</head>
<body>
  <div class="container">
    <h2>Trending Podcasts</h2>
    <div class="grid">
      <div class="card">
        <img src="pod1.jpg" alt="Podcast Talk Show with Juan Luna" class="podcast-cover" />
        <hr>
        <h3>Podcast Talk Show with Juan Luna</h3>
        <p>April 5, 2023 • 21.9k listens</p>
        <a href="episode.html">View</a>
      </div>
      <div class="card">
        <img src="pod2.jpg" alt="Positive Lifestyle" class="podcast-cover" />
        <hr>
        <h3>Positive Lifestyle</h3>
        <p>April 5, 2023 • 10k listens</p>
        <a href="episode.html">View</a>
      </div>
      <div class="card">
        <img src="pod3.jpg" alt="Live Podcast" class="podcast-cover" />
        <hr>
        <h3>Live Podcast</h3>
        <p>April 5, 2023 • 55k listens</p>
        <a href="episode.html">View</a>
      </div>
      <div class="card">
        <img src="pod4.png" alt="Morning Motivation" class="podcast-cover" />
        <hr>
        <h3>Morning Motivation</h3>
        <p>April 5, 2023 • 8k listens</p>
        <a href="episode.html">View</a>
      </div>
    </div>
  </div>

  <script>
    // JavaScript to toggle the main menu dropdown
    document.getElementById('menuBtn').addEventListener('click', function(event) {
      event.stopPropagation();
      var dropdown = document.getElementById('dropdownMenu');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      document.getElementById('profileDropdown').style.display = 'none';
    });

    // JavaScript to toggle the profile dropdown
    document.getElementById('profileBtn').addEventListener('click', function(event) {
      event.preventDefault();
      event.stopPropagation();
      var profileDropdown = document.getElementById('profileDropdown');
      profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
      document.getElementById('dropdownMenu').style.display = 'none';
    });

    // Close dropdowns if the user clicks outside
    window.addEventListener('click', function(event) {
      if (!event.target.matches('#menuBtn') && !event.target.closest('#dropdownMenu')) {
        document.getElementById('dropdownMenu').style.display = 'none';
      }
      if (!event.target.matches('#profileBtn') && !event.target.closest('#profileDropdown')) {
        document.getElementById('profileDropdown').style.display = 'none';
      }
    });
  </script>
</body>
</html>
