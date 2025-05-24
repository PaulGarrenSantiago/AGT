<?php
  include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Top 10 Podcasts - Anything Goes Tambayan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      min-height: 100vh;
      width: 100%;
      overflow-x: hidden;
    }

    .container {
      padding: 2rem;
      margin-top: 20px;
      max-width: 1400px;
      margin-left: auto;
      margin-right: auto;
    }

    h2 {
      margin-bottom: 2rem;
      color: #222;
      font-size: 2rem;
      text-align: center;
      position: relative;
      padding-bottom: 1rem;
    }

    h2::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 3px;
      background: linear-gradient(90deg, #ffe32d, #1e3a8a, #e53935);
      border-radius: 2px;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2rem;
      padding: 0 2rem;
    }

    .card {
      background: white;
      border-radius: 18px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      transition: transform 0.2s, box-shadow 0.2s;
      padding: 0;
      height: 200px;
      display: flex;
      overflow: hidden;
      text-decoration: none;
      color: inherit;
      position: relative;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(30,58,138,0.18);
    }

    .podcast-cover {
      width: 200px;
      height: 200px;
      object-fit: cover;
      border-radius: 0;
      margin: 0;
    }

    .card-content {
      flex: 1;
      padding: 1.5rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .ranking {
      position: absolute;
      top: 1rem;
      right: 1rem;
      width: 40px;
      height: 40px;
      background: #1e3a8a;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 1.2rem;
      box-shadow: 0 2px 8px rgba(30,58,138,0.2);
    }

    .card h3 {
      margin: 0 0 0.5rem 0;
      font-size: 1.4rem;
      color: #1e3a8a;
    }

    .card p {
      margin: 0;
      color: #666;
      font-size: 1rem;
    }

    .card .stats {
      display: flex;
      gap: 1rem;
      margin-top: 1rem;
      color: #888;
      font-size: 0.9rem;
    }

    .card .stats i {
      color: #1e3a8a;
      margin-right: 0.3rem;
    }

    .top-3 {
      position: relative;
    }

    .top-3::before {
      content: '';
      position: absolute;
      top: -5px;
      left: -5px;
      right: -5px;
      bottom: -5px;
      border-radius: 20px;
      background: linear-gradient(45deg, #ffe32d, #1e3a8a, #e53935);
      z-index: -1;
      opacity: 0.3;
    }

    @media (max-width: 1200px) {
      .grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 600px) {
      .card {
        flex-direction: column;
        height: auto;
      }
      .podcast-cover {
        width: 100%;
        height: 200px;
      }
      .card-content {
        padding: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Top 10 Most Popular Podcasts</h2>
    <div class="grid">
      <a href="episode.php" class="card top-3">
        <img src="img/kk.jpg" alt="Kwento at Kape" class="podcast-cover" />
        <div class="card-content">
          <div class="ranking">#1</div>
          <h3>Kwento at Kape</h3>
          <p>A perfect blend of storytelling and coffee talks</p>
          <div class="stats">
            <span><i class="fas fa-calendar"></i>June 16, 2024</span>
            <span><i class="fas fa-headphones"></i>789.9k listens</span>
          </div>
        </div>
      </a>
      <a href="episode.php" class="card top-3">
        <img src="img/mic.jpg" alt="Mic sa Kanto" class="podcast-cover" />
        <div class="card-content">
          <div class="ranking">#2</div>
          <h3>Mic sa Kanto</h3>
          <p>Street-smart conversations and local insights</p>
          <div class="stats">
            <span><i class="fas fa-calendar"></i>October 15, 2023</span>
            <span><i class="fas fa-headphones"></i>100k listens</span>
          </div>
        </div>
      </a>
      <a href="episode.php" class="card top-3">
        <img src="img/kubo.jpg" alt="Sa may Kubo" class="podcast-cover" />
        <div class="card-content">
          <div class="ranking">#3</div>
          <h3>Sa may Kubo</h3>
          <p>Traditional stories with a modern twist</p>
          <div class="stats">
            <span><i class="fas fa-calendar"></i>July 26, 2023</span>
            <span><i class="fas fa-headphones"></i>55.9k listens</span>
          </div>
        </div>
      </a>
      <a href="episode.php" class="card">
        <img src="img/morning.jpg" alt="Morning Motivation" class="podcast-cover" />
        <div class="card-content">
          <div class="ranking">#4</div>
          <h3>Morning Motivation</h3>
          <p>Start your day with inspiring stories</p>
          <div class="stats">
            <span><i class="fas fa-calendar"></i>December 15, 2023</span>
            <span><i class="fas fa-headphones"></i>15k listens</span>
          </div>
        </div>
      </a>
      <a href="episode.php" class="card">
        <img src="img/mic.jpg" alt="Business Insights" class="podcast-cover" />
        <div class="card-content">
          <div class="ranking">#5</div>
          <h3>Business Insights</h3>
          <p>Expert analysis on business trends</p>
          <div class="stats">
            <span><i class="fas fa-calendar"></i>April 5, 2023</span>
            <span><i class="fas fa-headphones"></i>13k listens</span>
          </div>
        </div>
      </a>
      <a href="episode.php" class="card">
        <img src="img/kk.jpg" alt="Health Matters" class="podcast-cover" />
        <div class="card-content">
          <div class="ranking">#6</div>
          <h3>Health Matters</h3>
          <p>Your guide to a healthier lifestyle</p>
          <div class="stats">
            <span><i class="fas fa-calendar"></i>April 5, 2023</span>
            <span><i class="fas fa-headphones"></i>12k listens</span>
          </div>
        </div>
      </a>
      <a href="episode.php" class="card">
        <img src="img/kubo.jpg" alt="Tech Trends" class="podcast-cover" />
        <div class="card-content">
          <div class="ranking">#7</div>
          <h3>Tech Trends</h3>
          <p>Latest updates from the tech world</p>
          <div class="stats">
            <span><i class="fas fa-calendar"></i>April 5, 2023</span>
            <span><i class="fas fa-headphones"></i>11k listens</span>
          </div>
        </div>
      </a>
      <a href="episode.php" class="card">
        <img src="img/morning.jpg" alt="Comedy Hour" class="podcast-cover" />
        <div class="card-content">
          <div class="ranking">#8</div>
          <h3>Comedy Hour</h3>
          <p>Laughter and fun conversations</p>
          <div class="stats">
            <span><i class="fas fa-calendar"></i>April 5, 2023</span>
            <span><i class="fas fa-headphones"></i>10k listens</span>
          </div>
        </div>
      </a>
      <a href="episode.php" class="card">
        <img src="img/pod9.jpg" alt="Music Vibes" class="podcast-cover" />
        <div class="card-content">
          <div class="ranking">#9</div>
          <h3>Music Vibes</h3>
          <p>Your daily dose of music and entertainment</p>
          <div class="stats">
            <span><i class="fas fa-calendar"></i>April 5, 2023</span>
            <span><i class="fas fa-headphones"></i>9k listens</span>
          </div>
        </div>
      </a>
      <a href="episode.php" class="card">
        <img src="img/pod10.jpg" alt="Sports Weekly" class="podcast-cover" />
        <div class="card-content">
          <div class="ranking">#10</div>
          <h3>Sports Weekly</h3>
          <p>Complete coverage of sports events</p>
          <div class="stats">
            <span><i class="fas fa-calendar"></i>April 5, 2023</span>
            <span><i class="fas fa-headphones"></i>8k listens</span>
          </div>
        </div>
      </a>
    </div>
  </div>

  <script>
    // JavaScript to toggle the main menu dropdown
    document.getElementById('menuBtn').addEventListener('click', function(event) {
      event.stopPropagation();
      var dropdown = document.getElementById('dropdownMenu');
      if (dropdown.style.display === 'none' || !dropdown.style.display) {
        dropdown.style.display = 'flex';
        setTimeout(() => dropdown.classList.add('visible'), 10);
        document.getElementById('profileDropdown').style.display = 'none';
        document.getElementById('profileDropdown').classList.remove('visible');
      } else {
        dropdown.classList.remove('visible');
        setTimeout(() => dropdown.style.display = 'none', 200);
      }
    });

    // JavaScript to toggle the profile dropdown
    document.getElementById('profileBtn').addEventListener('click', function(event) {
      event.preventDefault();
      event.stopPropagation();
      var profileDropdown = document.getElementById('profileDropdown');
      if (profileDropdown.style.display === 'none' || !profileDropdown.style.display) {
        profileDropdown.style.display = 'flex';
        setTimeout(() => profileDropdown.classList.add('visible'), 10);
        document.getElementById('dropdownMenu').style.display = 'none';
        document.getElementById('dropdownMenu').classList.remove('visible');
      } else {
        profileDropdown.classList.remove('visible');
        setTimeout(() => profileDropdown.style.display = 'none', 200);
      }
    });

    // Close dropdowns if the user clicks outside
    window.addEventListener('click', function(event) {
      const dropdowns = [document.getElementById('dropdownMenu'), document.getElementById('profileDropdown')];
      dropdowns.forEach(dropdown => {
        if (!event.target.closest('.header-icon-btn')) {
          dropdown.classList.remove('visible');
          setTimeout(() => dropdown.style.display = 'none', 200);
        }
      });
    });
  </script>
</body>
</html>
