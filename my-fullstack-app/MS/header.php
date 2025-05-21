<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: black;
    }
    header {
      color: white;
      padding: 0;
      min-height: 320px;
      position: relative;
      overflow: hidden;
      height: 100px; /* Reduced height */
    }
    .header-bg-img {
      width: 100%;
      height: 110%;
      object-fit: cover;
      position: absolute;
      top: -60px; /* Move image upward */
      left: 0;
      z-index: 1;
    }
    .header-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%; /* Cover the entire header */
      z-index: 2;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 2rem;
    }
    .menu-icon,
    .upload-icon {
      color: white;
      font-size: 1.2rem;
      text-decoration: none;
      margin-right: 1rem; /* Reduced gap */
      margin-top: -140px;
    }
    /* Remove margin from last icon */
    nav a:last-child {
      margin-right: 40px;
    }
    .menu-icon:hover {
      color: #60a5fa;
    }
    .header-title {
      display: flex;
      align-items: center;
      gap: 1.5rem;
    }
    .header-title h1 {
      margin: 0;
      font-size: 2.5rem;
      letter-spacing: 2px;
    }
    nav {
      display: flex;
      position: absolute;
      top: 1.2rem;
      right: 2rem;
      z-index: 3;
      position: relative; /* Ensure dropdown is positioned relative to nav */
    }
    nav a {
      color: white;
      font-size: 1.5rem;
      text-decoration: none;
      transition: color 0.2s;
    }
    nav a:hover {
      color: #60a5fa;
    }
     /* Dropdown Menu Styles */
    .dropdown-menu {
      display: none;
      position: absolute;
      top: -110px;
      right: 15px;
      left: auto;
      background: rgb(101, 96, 96);
      border-radius: 3px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
      min-width: 170px;
      z-index: 10;
      flex-direction: column;
      padding: 0.5rem 0;
      overflow: visible;
    }
    .dropdown-menu a {
      color: #fff;
      padding: 0.7rem 1.2rem;
      text-decoration: none;
      display: block;
      font-size: 1rem;
      transition: background 0.2s;
    }
    .dropdown-menu a:hover {
      background: #454a50;
      color: #222;
    }
    
    </style>
</head>
<body>
    <header>
        <header>
    <img src="img/header.png" alt="Header Image" class="header-bg-img" />
    <div class="header-overlay">
      <div class="header-title">
        <!-- Optional: Add a title here -->
      </div>
      <!-- Icons on the right -->
      <nav>
  <a href="#" class="menu-icon" title="Menu" id="menuBtn"><i class="fas fa-bars"></i></a>
  <div class="dropdown-menu" id="dropdownMenu">
    <a href="category.php">Category</a>
    <a href="discover.php">Discover</a>
    <a href="top10.php">Top 10 Podcasts</a>
    <a href="mostrecent.php">Most Recent</a>
  </div>
  <a href="upload.php" class="upload-icon" title="Upload"><i class="fas fa-upload"></i></a>
  <a href="settings.php" class="upload-icon" title="Settings"><i class="fas fa-cog"></i></a>
  
  <a href="#" class="upload-icon" title="Profile" id="profileBtn"></a>
  <div class="dropdown-menu" id="profileDropdown" style="right:10; left:auto; top:-100px;">
    <a href="profile.php">Profile</a>
    <a href="settings.php">Settings</a>
    <a href="index.php">Logout</a>
  </div>
  <a href="index.php" class="upload-icon" title="Log Out"><i class="fas fa-sign-out-alt"></i></a>
</nav>
    </div>
  </header>
    </header>

    <!-- Add Firebase SDKs if not already present -->
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-auth-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore-compat.js"></script>
<script src="../firebase-config.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      // Try to get photoURL from Firestore first
      firebase.firestore().collection("users").doc(user.uid).get().then(function(doc) {
        let photoURL = "img/default-image.jpg";
        if (doc.exists && doc.data().photoURL) {
          photoURL = doc.data().photoURL;
        } else if (user.photoURL) {
          photoURL = user.photoURL;
        }
        // Replace the profile icon with the user's image
        const profileBtn = document.getElementById('profileBtn');
        if (profileBtn) {
          profileBtn.innerHTML = `<img src="${photoURL}" alt="Profile" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">`;
        }
      });
    }
  });
});
</script>
</body>
</html>