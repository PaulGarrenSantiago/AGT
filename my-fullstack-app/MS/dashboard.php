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
      min-height: 380px;
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
      padding: 0 1.5rem 1.2rem 1.5rem;
      box-sizing: border-box;
    }

    .card h3 {
      margin: 0 0 0.5rem 0;
      font-size: 1.1rem;
      color: #22223b;
      font-weight: 600;
      letter-spacing: 0.5px;
      word-break: break-word;
    }

    .card p {
      margin: 0 0 0.7rem 0;
      color: #444;
      font-size: 0.97rem;
      word-break: break-word;
    }

    .stats {
      display: flex;
      gap: 1.2rem;
      color: #4f8cff;
      font-size: 0.98rem;
      align-items: center;
      margin-top: auto;
      margin-bottom: 0.2rem;
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
    <h2>Trending Podcasts</h2>
    <div id="loading-spinner" style="display: flex; justify-content: center; align-items: center; min-height: 200px;">
      <div class="spinner"></div>
    </div>
    <div id="podcastGrid" class="grid">
      <!-- Podcasts will be loaded dynamically -->
    </div>
  </div>

  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-firestore.js"></script>
  <script src="../firebase-config.js"></script>

  <script>
    document.getElementById('podcastGrid').style.display = 'none';

    const db = firebase.firestore();
    db.collection("podcasts")
      .get()
      .then((querySnapshot) => {
        // Collect all podcasts
        const podcasts = [];
        querySnapshot.forEach((doc) => {
          const data = doc.data();
          data.id = doc.id;  // Save the document ID
          podcasts.push(data);
        });

        // Sort by creation date (newest first)
        podcasts.sort((a, b) => {
          return b.createdAt.seconds - a.createdAt.seconds;
        });

        // Pick first 12 for dashboard
        const dashboardPodcasts = podcasts.slice(0, 12);

        let html = '';
        dashboardPodcasts.forEach((data) => {
          html += `
            <a class="card" href="listen.php?id=${data.id}" style="text-decoration: none; color: inherit;">
              <img src="${data.imageURL}" alt="${data.title}" class="podcast-cover" />
              <div class="card-content">
                <div class="uploader-info" style="display: flex; align-items: center; margin-bottom: 0.8rem;">
                  <img src="${data.userPhotoURL || 'img/default-avatar.png'}" alt="${data.username}" 
                    style="width: 24px; height: 24px; border-radius: 50%; margin-right: 8px;">
                  <span style="color: #1e3a8a; font-weight: 500;">${data.username}</span>
                </div>
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
        document.getElementById('podcastGrid').innerHTML = html;
        document.getElementById('loading-spinner').style.display = 'none';
        document.getElementById('podcastGrid').style.display = 'grid';
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
              <div class="uploader-info" style="display: flex; align-items: center; margin-bottom: 0.8rem;">
                <img src="${data.userPhotoURL || 'img/default-avatar.png'}" alt="${data.username}" 
                  style="width: 24px; height: 24px; border-radius: 50%; margin-right: 8px;">
                <span style="color: #1e3a8a; font-weight: 500;">${data.username}</span>
              </div>
              <h3>${data.title}</h3>
              <p>${data.description || ''}</p>
              <div class="stats">
                <span><i class="fas fa-calendar"></i> ${formatDate(data.createdAt)}</span>
                <span><i class="fas fa-headphones"></i> ${formatListeners(data.listenCount || 0)}</span>
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
