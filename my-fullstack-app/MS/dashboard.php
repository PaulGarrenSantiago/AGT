<?php
  include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard - Anything Goes Tambayan</title>
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
      grid-template-columns: repeat(4, 1fr);
      gap: 1.5rem;
    }
    .card {
      background: white;
      border-radius: 8px;
      overflow: hidden;
      transition: transform 0.2s;
      cursor: pointer;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .card-content {
      padding: 1rem;
    }
    .card-title {
      margin: 0 0 0.5rem 0;
      font-size: 1.1rem;
      color: #333;
    }
    .card-meta {
      color: #666;
      font-size: 0.9rem;
      margin-bottom: 0.5rem;
    }
    .card-stats {
      display: flex;
      justify-content: space-between;
      color: #888;
      font-size: 0.9rem;
    }
    .uploader-info {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 0.5rem;
    }
    .uploader-avatar {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      object-fit: cover;
    }
    .uploader-name {
      color: #0a2c5e;
      font-weight: 500;
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
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Trending Podcasts</h2>
    <div class="grid" id="podcastGrid">
      <!-- Podcasts will be loaded dynamically -->
    </div>
  </div>

  <script>
    // Load podcasts from Firestore
    document.addEventListener('DOMContentLoaded', async () => {
      try {
        const db = firebase.firestore();
        const podcastsRef = db.collection('podcasts');
        
        // Get podcasts ordered by listen count (trending)
        const snapshot = await podcastsRef.orderBy('listenCount', 'desc').limit(12).get();
        const grid = document.getElementById('podcastGrid');
        
        for (const doc of snapshot.docs) {
          const data = doc.data();
          const card = document.createElement('div');
          card.className = 'card';
          card.onclick = () => window.location.href = `listen.php?id=${doc.id}`;
          
          card.innerHTML = `
            <img src="${data.imageURL}" alt="${data.title}" class="card-image">
            <div class="card-content">
              <div class="uploader-info">
                <img src="${data.userPhotoURL}" alt="${data.username}" class="uploader-avatar">
                <span class="uploader-name">${data.username}</span>
              </div>
              <h3 class="card-title">${data.title}</h3>
              <div class="card-meta">
                ${new Date(data.createdAt.toDate()).toLocaleDateString()}
              </div>
              <div class="card-stats">
                <span><i class="fas fa-play"></i> ${data.listenCount || 0}</span>
                <span><i class="fas fa-star"></i> ${data.averageRating ? data.averageRating.toFixed(1) : '0.0'}</span>
              </div>
            </div>
          `;
          
          grid.appendChild(card);
        }
      } catch (error) {
        console.error('Error loading podcasts:', error);
      }
    });

    // Menu toggle handlers
    document.getElementById('menuBtn').addEventListener('click', function(event) {
      event.stopPropagation();
      var dropdown = document.getElementById('dropdownMenu');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      document.getElementById('profileDropdown').style.display = 'none';
    });

    document.getElementById('profileBtn').addEventListener('click', function(event) {
      event.preventDefault();
      event.stopPropagation();
      var profileDropdown = document.getElementById('profileDropdown');
      profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
      document.getElementById('dropdownMenu').style.display = 'none';
    });

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
