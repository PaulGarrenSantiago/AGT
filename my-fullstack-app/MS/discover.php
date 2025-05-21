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
    <h2>Discover More Topics</h2>
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
