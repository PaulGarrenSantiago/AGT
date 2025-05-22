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
    /* Upload Modal Styles */
#uploadModal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0, 0, 0, 0.7);
  z-index: 9999;
  align-items: center;
  justify-content: center;
}

.upload-modal-content {
  background: #fff;
  color: #222;
  border-radius: 1.2rem;
  max-width: 600px;
  width: 90vw;
  padding: 2rem;
  position: relative;
}

#closeUploadModal {
  position: absolute;
  top: 18px;
  right: 18px;
  background: none;
  border: none;
  font-size: 1.4rem;
  cursor: pointer;
}

.form-title {
  margin: 0 0 1.5rem 0;
  font-size: 1.8rem;
  text-align: center;
}

.upload-box {
  border: 2px solid #bbb;
  border-radius: 8px;
  padding: 1.5rem 0 1rem 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center; /* Add this */
  cursor: pointer;
  margin-bottom: 1.1rem;
  transition: border-color 0.2s;
  background: #fff;
  min-height: 130px; /* Ensures enough space for icon */
}

.upload-box:hover {
  background: rgba(96, 165, 250, 0.1);
}

.upload-text {
  font-size: 1rem;
  color: #60a5fa;
}

.form-input {
  width: 100%;
  padding: 0.8rem;
  margin-bottom: 1.2rem;
  border: 1px solid #ccc;
  border-radius: 0.5rem;
  font-size: 1rem;
}

.btn-publish {
  background: #60a5fa;
  color: #fff;
  border: none;
  padding: 0.8rem;
  border-radius: 0.5rem;
  cursor: pointer;
  font-size: 1rem;
  transition: background 0.2s;
}

.btn-publish:hover {
  background: #3b82f6;
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
  
  <a href="#" class="upload-icon" title="Profile" id="profileBtn"></a>
  <div class="dropdown-menu" id="profileDropdown" style="right:10; left:auto; top:-100px;">
    <a href="profile.php">Profile</a>
    <a href="settings.php">Settings</a>
    <a href="index.php">Logout</a>
  </div>
</nav>
    </div>
  </header>
    </header>

    <!-- Upload Modal Overlay -->
<div id="uploadModal">
  <div class="upload-modal-content">
    <button id="closeUploadModal" aria-label="Close">
      <i class="fa fa-times"></i>
    </button>
    <h3 class="form-title">Upload your podcast here.</h3>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
      <label for="fileInput" class="upload-box">
        <i class="fa fa-upload upload-icon"></i>
        <div class="upload-text">Upload</div>
        <input type="file" id="fileInput" name="file" required style="display:none;">
      </label>
      <input type="text" class="form-input" name="title" placeholder="Title..." required>
      <textarea class="form-input" name="description" placeholder="Description..." rows="2" required></textarea>
      <button type="submit" class="btn-publish">Publish</button>
    </form>
  </div>
</div>

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
          profileBtn.innerHTML = `<img src="${photoURL}" alt="Profile" style="width:25px;height:25px;border-radius:50%;object-fit:cover;">`;
        }
      });
    }
  });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Show modal when upload button is clicked
  const uploadBtn = document.querySelector('a[title="Upload"]');
  const uploadModal = document.getElementById('uploadModal');
  const closeUploadModal = document.getElementById('closeUploadModal');
  if (uploadBtn && uploadModal && closeUploadModal) {
    uploadBtn.addEventListener('click', function(e) {
      e.preventDefault();
      uploadModal.style.display = 'flex';
    });
    closeUploadModal.addEventListener('click', function() {
      uploadModal.style.display = 'none';
    });
    // Optional: close modal when clicking outside the form
    uploadModal.addEventListener('click', function(e) {
      if (e.target === uploadModal) uploadModal.style.display = 'none';
    });
  }
});
</script>
</body>
</html>