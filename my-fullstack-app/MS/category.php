<?php
  include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Categories - Anything Goes Tambayan</title>
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
      margin-bottom: 1.5rem;
      color: #222;
      font-size: 1.8rem;
      font-weight: 600;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem;
    }

    .card {
      background: white;
      border-radius: 18px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      transition: transform 0.15s, box-shadow 0.15s;
      padding: 0;
      height: 120px;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      cursor: pointer;
    }

    .card:hover {
      transform: translateY(-4px) scale(1.03);
      box-shadow: 0 8px 24px rgba(30,58,138,0.18);
    }

    .podcast-cover {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 18px;
      margin: 0;
      display: block;
    }

    @media (max-width: 1200px) {
      .grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 900px) {
      .grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 600px) {
      .grid {
        grid-template-columns: 1fr;
      }
      .container {
        padding: 1rem;
      }
      .card {
        height: 140px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Choose a Category</h2>
    <div class="grid">
      <div class="card" onclick="window.location.href='category-business.php'">
        <img src="img/business.png" alt="Business" class="podcast-cover" />
      </div>
      <div class="card" onclick="window.location.href='category-health.php'">
        <img src="img/health.png" alt="Health & Wellness" class="podcast-cover" />
      </div>
      <div class="card" onclick="window.location.href='category-technology.php'">
        <img src="img/technology.jpg" alt="Technology" class="podcast-cover" />
      </div>
      <div class="card" onclick="window.location.href='category-lifestyle.php'">
        <img src="img/lifestyle.png" alt="Lifestyle" class="podcast-cover" />
      </div>
    </div>

    <h2 style="margin-top:2rem;">More Categories</h2>
    <div class="grid">
      <div class="card" onclick="window.location.href='category-education.php'">
        <img src="img/education.png" alt="Education" class="podcast-cover" />
      </div>
      <div class="card" onclick="window.location.href='category-sports.php'">
        <img src="img/sports.jpg" alt="Sports" class="podcast-cover" />
      </div>
      <div class="card" onclick="window.location.href='category-comedy.php'">
        <img src="img/comedy.jpg" alt="Comedy" class="podcast-cover" />
      </div>
      <div class="card" onclick="window.location.href='category-music.php'">
        <img src="img/music.jpg" alt="Music" class="podcast-cover" />
      </div>
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
