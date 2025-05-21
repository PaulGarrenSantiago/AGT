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
      grid-template-columns: 1fr; /* 1 card per line */
      gap: 2rem;
      justify-items: center;
    }
    .card {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.12);
      text-align: center;
      width: 60%;
      min-width: 340px;
      max-width: 700px;
      position: relative;
      height: 340px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      overflow: hidden;
    }
    .card .ranking {
      position: absolute;
      top: 1.2rem;
      left: 1.2rem;
      font-size: 2.2rem;
      font-weight: bold;
      color: #1e3a8a;
      background: #e0e7ef;
      border-radius: 50%;
      width: 55px;
      height: 55px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 1px 4px rgba(30,58,138,0.08);
      z-index: 2;
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
      width: 100%;
      height: 60%;           /* Increase height for more visibility */
      object-fit: contain;   /* Show the whole image, no cropping */
      background: #f3f3f3;   /* Optional: add a background for letterboxing */
      border-radius: 8px 8px 0 0;
      margin-bottom: 0.7rem;
      margin-top: 0;
      display: block;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 style="text-align:center;">Top 10 Podcasts</h2>
    <div class="grid" style="justify-items: center;">
      <div class="card">
        <div class="ranking">#1</div>
        <img src="pod1.jpg" alt="Podcast Talk Show with Juan Luna" class="podcast-cover" />
        <hr>
        <h3>Podcast Talk Show with Juan Luna</h3>
        <p>April 5, 2023 • 21.9k listens</p>
        <a href="episode.html">View</a>
      </div>
      <div class="card">
        <div class="ranking">#2</div>
        <img src="pod2.jpg" alt="Positive Lifestyle" class="podcast-cover" />
        <hr>
        <h3>Positive Lifestyle</h3>
        <p>April 5, 2023 • 19k listens</p>
        <a href="episode.html">View</a>
      </div>
      <div class="card">
        <div class="ranking">#3</div>
        <img src="pod3.jpg" alt="Live Podcast" class="podcast-cover" />
        <hr>
        <h3>Live Podcast</h3>
        <p>April 5, 2023 • 17k listens</p>
        <a href="episode.html">View</a>
      </div>
      <div class="card">
        <div class="ranking">#4</div>
        <img src="pod4.png" alt="Morning Motivation" class="podcast-cover" />
        <hr>
        <h3>Morning Motivation</h3>
        <p>April 5, 2023 • 15k listens</p>
        <a href="episode.html">View</a>
      </div>
      <div class="card">
        <div class="ranking">#5</div>
        <img src="pod5.jpg" alt="Business Insights" class="podcast-cover" />
        <hr>
        <h3>Business Insights</h3>
        <p>April 5, 2023 • 13k listens</p>
        <a href="episode.html">View</a>
      </div>
      <div class="card">
        <div class="ranking">#6</div>
        <img src="pod6.jpg" alt="Health Matters" class="podcast-cover" />
        <hr>
        <h3>Health Matters</h3>
        <p>April 5, 2023 • 12k listens</p>
        <a href="episode.html">View</a>
      </div>
      <div class="card">
        <div class="ranking">#7</div>
        <img src="pod7.jpg" alt="Tech Trends" class="podcast-cover" />
        <hr>
        <h3>Tech Trends</h3>
        <p>April 5, 2023 • 11k listens</p>
        <a href="episode.html">View</a>
      </div>
      <div class="card">
        <div class="ranking">#8</div>
        <img src="pod8.jpg" alt="Comedy Hour" class="podcast-cover" />
        <hr>
        <h3>Comedy Hour</h3>
        <p>April 5, 2023 • 10k listens</p>
        <a href="episode.html">View</a>
      </div>
      <div class="card">
        <div class="ranking">#9</div>
        <img src="pod9.jpg" alt="Music Vibes" class="podcast-cover" />
        <hr>
        <h3>Music Vibes</h3>
        <p>April 5, 2023 • 9k listens</p>
        <a href="episode.html">View</a>
      </div>
      <div class="card">
        <div class="ranking">#10</div>
        <img src="pod10.jpg" alt="Sports Weekly" class="podcast-cover" />
        <hr>
        <h3>Sports Weekly</h3>
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
