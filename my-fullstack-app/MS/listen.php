<?php
  include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listen to Podcast - Anything Goes Tambayan</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/podcast-interactions.css">
  <style>
    body {
      margin: 0;
      font-family: 'Montserrat', Arial, sans-serif;
      background: #000;
      color: #fff;
      min-height: 100vh;
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 1rem;
      box-sizing: border-box;
    }

    .podcast-header {
      display: flex;
      gap: 2rem;
      margin-bottom: 1.5rem;
      background: rgba(255, 255, 255, 0.1);
      padding: 1.5rem;
      border-radius: 12px;
      flex-wrap: wrap;
    }

    .podcast-image {
      width: 300px;
      height: 300px;
      object-fit: cover;
      border-radius: 8px;
      margin: 0 auto;
    }

    .podcast-info {
      flex: 1;
      min-width: 280px;
    }

    .podcast-title {
      font-size: 1.8rem;
      margin: 0 0 1rem 0;
      line-height: 1.2;
      word-break: break-word;
    }

    .podcast-meta {
      color: #aaa;
      margin-bottom: 1rem;
      font-size: 0.9rem;
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
    }

    .podcast-meta span {
      white-space: nowrap;
    }

    .podcast-description {
      color: #ddd;
      line-height: 1.6;
      margin-bottom: 1.5rem;
      font-size: 0.95rem;
      word-break: break-word;
    }

    .audio-player {
      width: 100%;
      margin-bottom: 1.5rem;
    }

    .audio-player audio {
      width: 100%;
      border-radius: 8px;
    }

    .uploader-info {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      margin-bottom: 1rem;
    }

    .uploader-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    .uploader-name {
      color: #fff;
      font-weight: bold;
      font-size: 0.95rem;
    }

    .interaction-section {
      background: white;
      padding: 1.5rem;
      border-radius: 12px;
      margin-top: 1.5rem;
      color: #333;
    }

    /* Comments specific styles */
    .comments-section {
      margin-top: 1.5rem;
    }

    .comment {
      background: #f8f9fa;
      border-radius: 8px;
      padding: 1rem;
      margin-bottom: 1rem;
    }

    .comment-header {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      margin-bottom: 0.5rem;
      flex-wrap: wrap;
    }

    .comment-user-avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      object-fit: cover;
    }

    .comment-user-name {
      font-weight: bold;
      color: #0a2c5e;
      font-size: 0.9rem;
    }

    .comment-time {
      color: #666;
      font-size: 0.85rem;
      margin-left: auto;
    }

    .comment-content {
      color: #333;
      line-height: 1.5;
      font-size: 0.9rem;
      word-break: break-word;
    }

    .comment-form {
      margin-top: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .comment-form textarea {
      width: 100%;
      min-height: 80px;
      padding: 0.8rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 1rem;
      font-family: inherit;
      resize: vertical;
      font-size: 0.9rem;
      box-sizing: border-box;
    }

    .comment-form button {
      background: #0a2c5e;
      color: white;
      border: none;
      padding: 0.8rem 1.5rem;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.2s;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .comment-form button:hover {
      background: #0d3d7a;
    }

    .comments-container {
      max-height: 500px;
      overflow-y: auto;
      padding-right: 0.8rem;
    }

    .comments-container::-webkit-scrollbar {
      width: 6px;
    }

    .comments-container::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 4px;
    }

    .comments-container::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 4px;
    }

    .comments-container::-webkit-scrollbar-thumb:hover {
      background: #555;
    }

    /* Ensure dropdowns appear above content */
    .dropdown-menu {
      z-index: 1000;
    }

    nav {
      z-index: 1000;
      position: relative;
    }

    @media (max-width: 768px) {
      .container {
        padding: 0.8rem;
      }

      .podcast-header {
        padding: 1rem;
        gap: 1.5rem;
      }

      .podcast-image {
        width: 100%;
        height: auto;
        aspect-ratio: 1;
        max-width: 400px;
      }

      .podcast-info {
        width: 100%;
      }

      .podcast-title {
        font-size: 1.5rem;
        margin-bottom: 0.8rem;
      }

      .podcast-meta {
        font-size: 0.85rem;
        gap: 0.8rem;
      }

      .podcast-description {
        font-size: 0.9rem;
        margin-bottom: 1rem;
      }

      .interaction-section {
        padding: 1rem;
        margin-top: 1rem;
      }

      .comment {
        padding: 0.8rem;
      }

      .comment-header {
        gap: 0.5rem;
      }

      .comment-time {
        width: 100%;
        margin-left: 0;
        margin-top: 0.3rem;
        font-size: 0.8rem;
      }
    }

    @media (max-width: 480px) {
      .container {
        padding: 0.5rem;
      }

      .podcast-header {
        padding: 0.8rem;
        gap: 1rem;
      }

      .podcast-title {
        font-size: 1.3rem;
      }

      .uploader-info {
        gap: 0.5rem;
      }

      .uploader-avatar {
        width: 32px;
        height: 32px;
      }

      .uploader-name {
        font-size: 0.9rem;
      }

      .podcast-meta {
        font-size: 0.8rem;
        gap: 0.5rem;
      }

      .comment-form textarea {
        min-height: 60px;
        padding: 0.6rem;
        font-size: 0.85rem;
      }

      .comment-form button {
        padding: 0.6rem 1.2rem;
        font-size: 0.85rem;
      }
    }

    /* Touch device optimizations */
    @media (hover: none) {
      .comment-form button:hover {
        background: #0a2c5e;
      }

      audio::-webkit-media-controls-panel {
        padding: 0.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div id="podcastContent">
      <!-- Content will be loaded dynamically -->
    </div>
    <div class="interaction-section" id="interactionSection">
      <!-- Interactions will be loaded dynamically -->
    </div>
  </div>

  <script src="js/podcast-interactions.js"></script>
  <script src="js/podcast-interactions-ui.js"></script>
  <script>
    // Get podcast ID from URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const podcastId = urlParams.get('id');

    if (!podcastId) {
      window.location.href = 'dashboard.php';
    }

    // Load podcast data
    document.addEventListener('DOMContentLoaded', async () => {
      try {
        const db = firebase.firestore();
        const podcastDoc = await db.collection('podcasts').doc(podcastId).get();
        
        if (!podcastDoc.exists) {
          window.location.href = 'dashboard.php';
          return;
        }

        const data = podcastDoc.data();

        // Create podcast content
        const content = document.getElementById('podcastContent');
        content.innerHTML = `
          <div class="podcast-header">
            <img src="${data.imageURL}" alt="${data.title}" class="podcast-image">
            <div class="podcast-info">
              <h1 class="podcast-title">${data.title}</h1>
              <div class="uploader-info">
                <img src="${data.userPhotoURL}" alt="${data.username}" class="uploader-avatar">
                <span class="uploader-name">${data.username}</span>
              </div>
              <div class="podcast-meta">
                <span>${new Date(data.createdAt.toDate()).toLocaleDateString()}</span> • 
                <span>${data.listenCount || 0} listens</span> • 
                <span>${data.averageRating ? data.averageRating.toFixed(1) : '0.0'} ★ (${data.ratingCount || 0})</span>
              </div>
              <p class="podcast-description">${data.description}</p>
              <div class="audio-player">
                <audio controls id="audioPlayer">
                  <source src="${data.audioURL}" type="audio/mpeg">
                  Your browser does not support the audio element.
                </audio>
              </div>
            </div>
          </div>
        `;

        // Initialize interactions
        const interactionSection = document.getElementById('interactionSection');
        initPodcastInteractions(podcastId, interactionSection);

        // Add listen count increment on first play
        const audioPlayer = document.getElementById('audioPlayer');
        let hasStartedPlaying = false;
        audioPlayer.addEventListener('play', async () => {
          if (!hasStartedPlaying) {
            await incrementListenCount(podcastId);
            hasStartedPlaying = true;
            
            // Update listen count in the UI
            const listenCountSpan = document.querySelector('.podcast-meta span:nth-child(2)');
            if (listenCountSpan) {
              const currentListens = parseInt(listenCountSpan.textContent) || 0;
              listenCountSpan.textContent = `${currentListens + 1} listens`;
            }
          }
        });

      } catch (error) {
        console.error('Error loading podcast:', error);
      }
    });

    // Menu toggle handlers
    document.getElementById('menuBtn').addEventListener('click', function(event) {
      event.stopPropagation();
      var dropdown = document.getElementById('dropdownMenu');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      document.getElementById('profileDropdown').style.display = 'none';
    });

    // Profile dropdown toggle
    document.getElementById('profileBtn').addEventListener('click', function(event) {
      event.preventDefault();
      event.stopPropagation();
      var profileDropdown = document.getElementById('profileDropdown');
      profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
      document.getElementById('dropdownMenu').style.display = 'none';
    });

    // Close dropdowns when clicking outside
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