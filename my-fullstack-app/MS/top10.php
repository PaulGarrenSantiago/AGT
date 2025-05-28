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
      display: flex;
      flex-direction: column;
      gap: 2rem;
      padding: 0 2rem;
      max-width: 1000px;
      margin: 0 auto;
    }

    .card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 2px 8px rgba(30,42,73,0.08);
      padding: 2rem 2.5rem 1.5rem 2.5rem;
      display: flex;
      align-items: center;
      position: relative;
      min-height: 160px;
      margin-bottom: 0;
      transition: box-shadow 0.3s, transform 0.3s, background 0.3s;
      overflow: hidden;
      text-decoration: none;
      color: inherit;
      cursor: pointer;
    }

    .card:hover {
      box-shadow: 0 8px 32px rgba(30,42,73,0.18);
      transform: translateY(-6px) scale(1.02);
      background: linear-gradient(120deg, #fffbe6 0%, #e0e7ff 100%);
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

    .spinner {
      border: 6px solid #f3f3f3;
      border-top: 6px solid #1e3a8a;
      border-radius: 50%;
      width: 48px;
      height: 48px;
      animation: spin 1s linear infinite;
      margin: 0 auto;
    }
    @keyframes spin {
      0% { transform: rotate(0deg);}
      100% { transform: rotate(360deg);}
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Top 10 Most Popular Podcasts</h2>
    <div id="loading-spinner" style="display: flex; justify-content: center; align-items: center; min-height: 200px;">
      <div class="spinner"></div>
    </div>
    <div id="top10" class="grid"></div>
  </div>

  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-firestore.js"></script>
  <script src="/path/to/firebase-config.js"></script>
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

    // Hide the grid initially
    document.getElementById('top10').style.display = 'none';

    const db = firebase.firestore();
    db.collection("podcasts")
      .orderBy("listenCount", "desc")
      .limit(10)
      .get()
      .then((querySnapshot) => {
        let html = '';
        let rank = 1;
        querySnapshot.forEach((doc) => {
          const data = doc.data();
          const docId = doc.id;
          html += `
            <a href="listen.php?id=${docId}" class="card${rank <= 3 ? ' top-3' : ''}">
              <img src="${data.imageURL}" alt="${data.title}" class="podcast-cover" />
              <div class="card-content">
                <div class="ranking">#${rank}</div>
                <h3>${data.title}</h3>
                <p>${data.description || ''}</p>
                <div class="stats">
                  <span><i class="fas fa-calendar"></i> ${formatDate(data.createdAt)}</span>
                  <span><i class="fas fa-headphones"></i> ${formatListeners(data.listenCount || 0)}</span>
                  <span><i class="fas fa-star"></i> ${data.averageRating ? data.averageRating.toFixed(1) : '0.0'}</span>
                </div>
              </div>
            </a>
          `;
          rank++;
        });
        document.getElementById('top10').innerHTML = html;
        document.getElementById('loading-spinner').style.display = 'none';
        document.getElementById('top10').style.display = 'grid';
      });

    function formatDate(date) {
      if (typeof date === 'object' && date.seconds) {
        const d = new Date(date.seconds * 1000);
        return d.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
      }
      return date ? new Date(date).toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' }) : '';
    }
    function formatListeners(listeners) {
      if (!listeners) return '0 listens';
      if (listeners >= 1e6) return (listeners/1e6).toFixed(1) + 'M listens';
      if (listeners >= 1e3) return (listeners/1e3).toFixed(1) + 'k listens';
      return listeners + ' listens';
    }
  </script>
</body>
</html>
