<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Profile</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: #000;
      margin: 0;
      font-family: 'Montserrat', Arial, sans-serif;
      color: #fff;
    }
    .profile-header {
      background: linear-gradient(90deg, rgba(230, 203, 28, 0.76) 0%, rgba(45, 50, 194, 0.72) 47%, rgba(204, 35, 35, 0.79) 100%);
      padding: 2.5rem 2rem 2rem 4rem;
      display: flex;
      align-items: center;
      position: relative;
      min-height: 220px;
    }
    .profile-avatar {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      background: #fff;
      margin-right: 2.5rem;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      border: 6px solid #fff;
      position: relative;
    }
    .profile-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .profile-info {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .profile-name {
      font-size: 2.5rem;
      font-weight: 800;
      letter-spacing: 1px;
      color: #fff;
      margin: 0 0 0.5rem 0;
      text-shadow: 1px 1px 8px #222;
    }
    .profile-bio {
      font-size: 1.2rem;
      font-style: italic;
      color: #e0e0e0;
      margin-bottom: 0.5rem;
    }
    .profile-stats {
      position: absolute;
      top: 1.5rem;
      right: 2.5rem;
      display: flex;
      gap: 2.5rem;
      font-size: 1.1rem;
      font-weight: 600;
      color: #fff;
    }
    .profile-stats span {
      margin-left: 0.5rem;
      color: #fff;
    }
    .topic-filters {
      display: flex;
      gap: 1rem;
      margin: 2.5rem 0 2rem 3.5rem;
    }
    .topic-filters button {
      padding: 0.7rem 2rem;
      border-radius: 7px;
      border: none;
      font-size: 1.1rem;
      font-weight: 600;
      background: #111;
      color: #fff;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
      outline: none;
      border: 2px solid #444;
    }
    .topic-filters .active,
    .topic-filters button:hover {
      background: #ffe066;
      color: #222;
      border: 2px solid #ffe066;
    }
    .topics-grid {
      display: flex;
      gap: 2.5rem;
      margin: 0 0 2.5rem 3.5rem;
    }
    .topic-card {
      background: #181818;
      border-radius: 10px;
      overflow: hidden;
      width: 270px;
      box-shadow: 0 4px 18px rgba(0,0,0,0.18);
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 0 0 1.2rem 0;
    }
    .topic-card img {
      width: 100%;
      height: 210px;
      object-fit: cover;
      border-bottom: 2px solid #ffe066;
    }
    .back-btn {
      position: fixed;
      right: 3.5rem;
      bottom: 2.5rem;
      background: #ff3b3b;
      color: #fff;
      font-size: 1.3rem;
      font-weight: bold;
      border: none;
      border-radius: 10px;
      padding: 0.7rem 2.2rem;
      cursor: pointer;
      box-shadow: 0 2px 10px rgba(0,0,0,0.18);
      transition: background 0.2s;
    }
    .back-btn:hover {
      background: #d32f2f;
    }
    #edit-avatar-btn:hover {
  background: #ffd700;
}
    @media (max-width: 900px) {
      .profile-header, .topic-filters, .topics-grid {
        flex-direction: column;
        align-items: flex-start;
        margin-left: 1rem;
        margin-right: 1rem;
      }
      .profile-header {
        min-height: 320px;
        padding: 2rem 1rem 1.5rem 1rem;
      }
      .profile-avatar {
        margin-bottom: 1rem;
        margin-right: 0;
      }
      .topic-filters, .topics-grid {
        margin-left: 0;
      }
      .back-btn {
        right: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <!-- Add Firebase SDKs if not already present -->
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-auth-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-storage-compat.js"></script>
<script src="../firebase-config.js"></script>

  <div class="profile-header">
    <div class="profile-avatar" id="profile-avatar" style="position:relative;">
      <img src="img/avatar.jpg" alt="Profile" style="width:100%;height:100%;object-fit:cover;">
    </div>
    <div class="profile-info">
      <div class="profile-name" id="profile-username">USERNAME</div>
      <div class="profile-bio" id="profile-names">First Last</div>
    </div>
    <div class="profile-stats">
      <div>Following <span>7</span></div>
      <div>Followers <span>10.2k</span></div>
    </div>
  </div>

  <div class="topic-filters">
    <button class="active" onclick="setActiveFilter(this)">All Topics</button>
    <button onclick="window.location.href='populartopics.html'">Popular Topics</button>
    <button onclick="setActiveFilter(this)">Oldest Topics</button>
  </div>

  <div class="topics-grid">
    <div class="topic-card">
      <img src="img/pod1.jpg" alt="Podcast Talk Show with Juan Luna" />
    </div>
    <div class="topic-card">
      <img src="img/pod2.jpg" alt="Morning Podcast" />
    </div>
    <div class="topic-card">
      <img src="img/pod3.jpg" alt="Podcast" />
    </div>
  </div>

  <button class="back-btn" onclick="window.history.back()">Back</button>

  <script>
    function setActiveFilter(btn) {
      document.querySelectorAll('.topic-filters button').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      // Add logic here to filter topics if needed
    }
  </script>
  <script>
document.addEventListener("DOMContentLoaded", function() {
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      firebase.firestore().collection("users").doc(user.uid).get().then(function(doc) {
        if (doc.exists) {
          const data = doc.data();
          // Set avatar
          const avatarImg = document.querySelector("#profile-avatar img");
          avatarImg.src = data.photoURL || "img/default-image.jpg";
          // Set username
          document.getElementById("profile-username").textContent = data.username || "Username";
          // Set first and last name
          document.getElementById("profile-names").textContent = (data.firstName || "") + " " + (data.lastName || "");
        }
      });
    }
  });
});
</script>
</body>
</html>