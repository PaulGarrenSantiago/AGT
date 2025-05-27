<?php
  include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Business Podcasts - Anything Goes Tambayan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Inter', Arial, sans-serif;
      background-color: #f6f8fa;
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
    <h2>Business Podcasts</h2>
    <div id="loading-spinner" style="display: flex; justify-content: center; align-items: center; min-height: 200px;">
      <div class="spinner"></div>
    </div>
    <div id="category-podcasts" class="grid"></div>
  </div>

  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-firestore.js"></script>
  <script src="/path/to/firebase-config.js"></script>
  <script>
    document.getElementById('category-podcasts').style.display = 'none';

    const db = firebase.firestore();
    db.collection("podcasts")
      .where("category", "==", "business")
      .get()
      .then((querySnapshot) => {
        let html = '';
        querySnapshot.forEach((doc) => {
          const data = doc.data();
          html += `
            <a class="card" href="${data.audioURL || '#'}" target="_blank" style="text-decoration: none; color: inherit;">
              <img src="${data.imageURL}" alt="${data.title}" class="podcast-cover" />
              <div class="card-content">
                <h3>${data.title}</h3>
                <p>${data.description || ''}</p>
                <div class="stats">
                  <span><i class="fas fa-calendar"></i> ${formatDate(data.createdAt)}</span>
                  <span><i class="fas fa-headphones"></i> ${formatListeners(data.viewCount)}</span>
                </div>
              </div>
            </a>
          `;
        });
        document.getElementById('category-podcasts').innerHTML = html;
        document.getElementById('loading-spinner').style.display = 'none';
        document.getElementById('category-podcasts').style.display = 'grid';
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
