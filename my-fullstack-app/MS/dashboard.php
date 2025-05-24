<?php
  include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard - Anything Goes Tambayan</title>
  <style>
    .container {
      padding: 2rem;
    }
    h2 {
      margin-bottom: 1rem;
      color: #222;
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
      height: 270px;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      text-decoration: none;
      color: inherit;
    }
    .card:hover {
      transform: translateY(-4px) scale(1.03);
      box-shadow: 0 8px 24px rgba(30,58,138,0.18);
    }
    .podcast-cover {
      width: 100%;
      height: 170px;
      object-fit: cover;
      border-radius: 0;
      margin-bottom: 0;
      display: block;
    }
    .card hr {
      display: none;
    }
    .card h3, .card p {
      margin: 0.7rem 1rem 0 1rem;
      text-align: left;
    }
    .card h3 {
      font-size: 1.08rem;
      font-weight: 600;
      margin-bottom: 0.3rem;
    }
    .card p {
      font-size: 0.97rem;
      color: #444;
      margin-bottom: 0.7rem;
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
            <img src="${data.imageURL}" alt="${data.title}" class="podcast-cover">
            <div class="card-content">
              <div class="uploader-info">
                <img src="${data.userPhotoURL}" alt="${data.username}" class="uploader-avatar" style="width:24px;height:24px;border-radius:50%;margin-right:8px;">
                <span class="uploader-name" style="color:#1e3a8a;font-weight:500;">${data.username}</span>
              </div>
              <h3 class="card-title">${data.title}</h3>
              <div class="card-meta">
                ${new Date(data.createdAt.toDate()).toLocaleDateString()}
              </div>
              <div class="card-stats" style="display:flex;justify-content:space-between;color:#666;font-size:0.9rem;margin-top:8px;">
                <span><i class="fas fa-play"></i> ${data.listenCount || 0}</span>
                <span><i class="fas fa-star"></i> ${data.averageRating ? data.averageRating.toFixed(1) : '0.0'}</span>
              </div>
            </div>
          `;
          
          grid.appendChild(card);
        }
      } catch (error) {
        console.error('Error loading podcasts:', error);
        // Show error message to user
        const grid = document.getElementById('podcastGrid');
        grid.innerHTML = `
          <div style="grid-column: 1/-1; text-align: center; padding: 2rem;">
            <p style="color: #666;">Unable to load podcasts. Please try again later.</p>
          </div>
        `;
      }
    });

    // Listen for search events from the header
    document.addEventListener('headerSearch', async (e) => {
      const searchQuery = e.detail.toLowerCase();
      const grid = document.getElementById('podcastGrid');
      grid.innerHTML = ''; // Clear current podcasts

      try {
        const db = firebase.firestore();
        const podcastsRef = db.collection('podcasts');
        
        // Get all podcasts and filter client-side (for demo purposes)
        // In production, you'd want to implement server-side search
        const snapshot = await podcastsRef.get();
        const matchingPodcasts = snapshot.docs.filter(doc => {
          const data = doc.data();
          return data.title.toLowerCase().includes(searchQuery) ||
                 data.username.toLowerCase().includes(searchQuery);
        });

        if (matchingPodcasts.length === 0) {
          grid.innerHTML = `
            <div style="grid-column: 1/-1; text-align: center; padding: 2rem;">
              <p style="color: #666;">No podcasts found matching "${searchQuery}"</p>
            </div>
          `;
          return;
        }

        matchingPodcasts.forEach(doc => {
          const data = doc.data();
          const card = document.createElement('div');
          card.className = 'card';
          card.onclick = () => window.location.href = `listen.php?id=${doc.id}`;
          
          card.innerHTML = `
            <img src="${data.imageURL}" alt="${data.title}" class="podcast-cover">
            <div class="card-content">
              <div class="uploader-info">
                <img src="${data.userPhotoURL}" alt="${data.username}" class="uploader-avatar" style="width:24px;height:24px;border-radius:50%;margin-right:8px;">
                <span class="uploader-name" style="color:#1e3a8a;font-weight:500;">${data.username}</span>
              </div>
              <h3 class="card-title">${data.title}</h3>
              <div class="card-meta">
                ${new Date(data.createdAt.toDate()).toLocaleDateString()}
              </div>
              <div class="card-stats" style="display:flex;justify-content:space-between;color:#666;font-size:0.9rem;margin-top:8px;">
                <span><i class="fas fa-play"></i> ${data.listenCount || 0}</span>
                <span><i class="fas fa-star"></i> ${data.averageRating ? data.averageRating.toFixed(1) : '0.0'}</span>
              </div>
            </div>
          `;
          
          grid.appendChild(card);
        });
      } catch (error) {
        console.error('Error searching podcasts:', error);
        grid.innerHTML = `
          <div style="grid-column: 1/-1; text-align: center; padding: 2rem;">
            <p style="color: #666;">Error searching podcasts. Please try again later.</p>
          </div>
        `;
      }
    });
  </script>
</body>
</html>
