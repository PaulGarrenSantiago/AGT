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
      padding: 0;
      font-family: 'Inter', Arial, sans-serif;
      background-color: #f6f8fa;
      min-height: 100vh;
      width: 100%;
      overflow-x: hidden;
    }
    .container {
      padding: 2rem 0;
      max-width: 1200px;
      margin: 0 auto;
    }
    h2 {
      margin-bottom: 2rem;
      color: #22223b;
      text-align: center;
      font-weight: 700;
      letter-spacing: 1px;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 2rem;
    }
    .card {
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 4px 24px rgba(30,42,73,0.08);
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: box-shadow 0.2s, transform 0.2s;
      min-height: 340px;
      overflow: hidden;
      position: relative;
    }
    .card:hover {
      box-shadow: 0 8px 32px rgba(30,42,73,0.16);
      transform: translateY(-6px) scale(1.02);
    }
    .podcast-cover {
      width: 100%;
      height: 170px;
      object-fit: cover;
      border-radius: 18px 18px 0 0;
      background: #e9ecef;
      margin-bottom: 1rem;
    }
    .card-content {
      flex: 1;
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      padding: 1.2rem 1.5rem 1.2rem 1.5rem;
      box-sizing: border-box;
    }
    .card h3 {
      margin: 0 0 0.5rem 0;
      font-size: 1.1rem;
      color: #22223b;
      font-weight: 600;
      letter-spacing: 0.5px;
    }
    .card p {
      margin: 0 0 0.7rem 0;
      color: #444;
      font-size: 0.97rem;
      word-break: break-word;
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
      height: 1.5em;
      line-height: 1.5;
    }
    .stats {
      display: flex;
      gap: 1.2rem;
      color: #4f8cff;
      font-size: 0.98rem;
      align-items: center;
      margin-top: 1rem;
    }
    .stats i {
      margin-right: 0.3rem;
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
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Recently Uploaded</h2>
    <div id="loading-spinner" style="display: flex; justify-content: center; align-items: center; min-height: 200px;">
      <div class="spinner"></div>
    </div>
    <div id="podcasts" class="grid"></div>
  </div>

  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-firestore.js"></script>
  <script src="/path/to/firebase-config.js"></script>

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

    const db = firebase.firestore();
    document.getElementById('podcasts').style.display = 'none'; // Hide podcasts grid initially

    db.collection("podcasts")
      .orderBy("createdAt", "desc")
      .limit(12)
      .get()
      .then((querySnapshot) => {
        let html = '';
        querySnapshot.forEach((doc) => {
          const data = doc.data();
          const docId = doc.id;  // Get the document ID
          html += `
            <a class="card" href="listen.php?id=${docId}" style="text-decoration: none; color: inherit;">
              <img src="${data.imageURL}" alt="${data.title}" class="podcast-cover" loading="lazy" />
              <div class="card-content">
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
        });
        document.getElementById('podcasts').innerHTML = html;
        document.getElementById('loading-spinner').style.display = 'none'; // Hide spinner
        document.getElementById('podcasts').style.display = 'grid'; // Show podcasts grid
      });

    function formatDate(date) {
      // If Firestore Timestamp object
      if (typeof date === 'object' && date.seconds) {
        const d = new Date(date.seconds * 1000);
        return d.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
      }
      // If string
      return date ? new Date(date).toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' }) : '';
    }

    function formatListeners(viewCount) {
      if (typeof viewCount !== 'number' || isNaN(viewCount)) return '0';
      return viewCount.toLocaleString();
    }
  </script>
</body>
</html>
