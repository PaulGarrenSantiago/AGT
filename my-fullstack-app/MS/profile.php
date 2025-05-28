<?php
  include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Profile - Anything Goes Tambayan</title>
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

    /* Profile Section Styles */
    .profile-section {
      margin-top: 70px;
      padding: 3rem 2rem;
      background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
      color: white;
      position: relative;
    }

    .profile-container {
      max-width: 1400px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      gap: 2.5rem;
    }

    .profile-avatar {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      border: 4px solid white;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
      position: relative;
    }

    .profile-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .profile-info {
      flex: 1;
    }

    .profile-name {
      font-size: 2.8rem;
      font-weight: 800;
      margin-bottom: 0.5rem;
      text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .profile-bio {
      font-size: 1.2rem;
      opacity: 0.9;
      margin-bottom: 1.5rem;
    }

    .profile-stats {
      display: flex;
      gap: 2.5rem;
      font-size: 1.1rem;
    }

    .profile-stats div {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .profile-stats span {
      font-weight: 600;
      font-size: 1.2rem;
    }

    /* Content Section Styles */
    .content-section {
      max-width: 1400px;
      margin: 2rem auto;
      padding: 0 2rem;
    }

    .topic-filters {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .topic-filters button {
      padding: 0.8rem 2rem;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      background: #f0f0f0;
      color: #444;
      cursor: pointer;
      transition: all 0.2s;
    }

    .topic-filters button.active,
    .topic-filters button:hover {
      background: #1e3a8a;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(30,58,138,0.2);
    }

    .topics-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 2rem;
    }

    .topic-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 12px rgba(0,0,0,0.08);
      transition: all 0.3s;
      cursor: pointer;
    }

    .topic-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(30,58,138,0.15);
    }

    .topic-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .topic-card-content {
      padding: 1.2rem;
    }

    .topic-card-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: #222;
      margin-bottom: 0.5rem;
    }

    .topic-card-stats {
      display: flex;
      align-items: center;
      gap: 1rem;
      color: #666;
      font-size: 0.9rem;
    }

    .topic-card-stats i {
      color: #1e3a8a;
    }

    @media (max-width: 900px) {
      .profile-container {
        flex-direction: column;
        text-align: center;
      }

      .profile-stats {
        justify-content: center;
      }

      .topics-grid {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      }
    }

    @media (max-width: 600px) {
      .profile-name {
        font-size: 2rem;
      }

      .profile-avatar {
        width: 140px;
        height: 140px;
      }

      .topic-filters {
        flex-wrap: wrap;
      }

      .topic-filters button {
        flex: 1;
        min-width: 140px;
      }
    }
  </style>
</head>
<body>
  <section class="profile-section">
    <div class="profile-container">
      <div class="profile-avatar" id="profile-avatar">
        <img src="img/default-avatar.jpg" alt="Profile" id="profile-image">
      </div>
      <div class="profile-info">
        <h1 class="profile-name" id="profile-username">Loading...</h1>
        <p class="profile-bio" id="profile-names">Loading...</p>
      </div>
    </div>
  </section>

  <section class="content-section">
    <div class="topic-filters">
      <button class="active" onclick="loadUserPodcasts('recent')">All Topics</button>
      <button onclick="loadUserPodcasts('popular')">Popular Topics</button>
      <button onclick="loadUserPodcasts('oldest')">Oldest Topics</button>
    </div>

    <div class="topics-grid" id="topics-container">
      <!-- Topics will be dynamically loaded here -->
    </div>
  </section>

  <script>
    function setActiveFilter(button) {
      document.querySelectorAll('.topic-filters button').forEach(b => b.classList.remove('active'));
      button.classList.add('active');
    }

    // Load user data and topics
    document.addEventListener("DOMContentLoaded", function() {
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          // Get user data from Firestore
          firebase.firestore().collection("users").doc(user.uid).get().then(function(doc) {
            if (doc.exists) {
              const data = doc.data();
              // Update profile image
              const profileImage = document.getElementById("profile-image");
              profileImage.src = data.photoURL || user.photoURL || "img/default-avatar.jpg";
              
              // Update username and full name
              document.getElementById("profile-username").textContent = data.username || user.displayName || "Username";
              
              // Set bio/names
              const fullName = `${data.firstName || ''} ${data.lastName || ''}`.trim();
              document.getElementById("profile-names").textContent = fullName || "Update your profile";

              // Load user's podcasts with default sorting (recent)
              loadUserPodcasts('recent');
            } else {
              // Create user document if it doesn't exist
              firebase.firestore().collection("users").doc(user.uid).set({
                email: user.email,
                username: user.displayName || "Username",
                photoURL: user.photoURL || "img/default-avatar.jpg",
                createdAt: firebase.firestore.FieldValue.serverTimestamp()
              }).then(() => {
                loadUserPodcasts('recent');
              });
            }
          }).catch(function(error) {
            console.error("Error getting user data:", error);
            document.getElementById("profile-username").textContent = "Error loading profile";
            document.getElementById("profile-names").textContent = "Please try again later";
          });
        } else {
          window.location.href = 'login.php';
        }
      });
    });

    function loadUserPodcasts(sortType = 'recent') {
      const user = firebase.auth().currentUser;
      if (!user) return;

      const topicsContainer = document.getElementById('topics-container');
      let query = firebase.firestore().collection("podcasts").where("userId", "==", user.uid);
      
      // Set the active button
      const buttons = document.querySelectorAll('.topic-filters button');
      buttons.forEach(button => {
        if (
          (sortType === 'recent' && button.textContent === 'All Topics') ||
          (sortType === 'popular' && button.textContent === 'Popular Topics') ||
          (sortType === 'oldest' && button.textContent === 'Oldest Topics')
        ) {
          button.classList.add('active');
        } else {
          button.classList.remove('active');
        }
      });

      // Apply sorting based on sortType
      switch(sortType) {
        case 'popular':
          query = query.orderBy("listenCount", "desc");
          break;
        case 'oldest':
          query = query.orderBy("createdAt", "asc");
          break;
        case 'recent':
        default:
          query = query.orderBy("createdAt", "desc");
          break;
      }
      
      query.get()
        .then((querySnapshot) => {
          topicsContainer.innerHTML = ''; // Clear existing content
          
          if (querySnapshot.empty) {
            topicsContainer.innerHTML = `
              <div style="grid-column: 1/-1; text-align: center; padding: 2rem;">
                <h3>No podcasts yet</h3>
                <p>Start creating your first podcast!</p>
                <a href="upload.php" class="btn-publish" style="display: inline-block; margin-top: 1rem; padding: 0.8rem 2rem; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; text-decoration: none; border-radius: 8px;">
                  <i class="fas fa-upload"></i> Upload Your First Podcast
                </a>
              </div>
            `;
            return;
          }

          querySnapshot.forEach((doc) => {
            const podcast = doc.data();
            const date = podcast.createdAt.toDate().toLocaleDateString('en-US', {
              year: 'numeric',
              month: 'short',
              day: 'numeric'
            });

            const podcastCard = `
              <div class="topic-card" onclick="window.location.href='view.php?id=${doc.id}'">
                <img src="${podcast.imageURL || 'img/default-podcast.jpg'}" alt="${podcast.title}">
                <div class="topic-card-content">
                  <h3 class="topic-card-title">${podcast.title}</h3>
                  <div class="topic-card-stats">
                    <span><i class="far fa-calendar"></i> ${date}</span>
                    <span><i class="fas fa-headphones"></i> ${podcast.listenCount || 0} listens</span>
                  </div>
                </div>
              </div>
            `;
            
            topicsContainer.innerHTML += podcastCard;
          });
        })
        .catch((error) => {
          console.error("Error loading podcasts:", error);
          topicsContainer.innerHTML = `
            <div style="grid-column: 1/-1; text-align: center; padding: 2rem;">
              <h3>Error loading podcasts</h3>
              <p>Please try again later</p>
            </div>
          `;
        });
    }
  </script>
</body>
</html>