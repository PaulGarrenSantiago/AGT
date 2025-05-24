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
    }
    header {
      background: #fff;
      color: #222;
      padding: 0;
      min-height: 70px;
      position: relative;
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
      z-index: 10;
      height: 70px;
    }
    .header-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 70px;
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 2rem;
    }
    .logo {
      display: flex;
      align-items: center;
      font-size: 2rem;
      font-weight: bold;
      color: #e53935;
      letter-spacing: 1px;
      gap: 0.5rem;
      text-decoration: none;
    }
    .logo i {
      font-size: 2.2rem;
    }
    .search-bar {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 2rem;
    }
    .search-bar input[type="text"] {
      width: 400px;
      padding: 0.6rem 1rem;
      border: 1px solid #ccc;
      border-radius: 20px 0 0 20px;
      outline: none;
      font-size: 1rem;
      background: #f5f5f5;
      transition: border 0.2s;
    }
    .search-bar button {
      padding: 0.6rem 1.2rem;
      border: none;
      background: #f5f5f5;
      border-radius: 0 20px 20px 0;
      cursor: pointer;
      font-size: 1.1rem;
      color: #555;
      border-left: 1px solid #ccc;
      transition: background 0.2s;
    }
    .search-bar button:hover {
      background: #e3e3e3;
    }
    .header-icons {
      display: flex;
      align-items: center;
      gap: 1.2rem;
    }
    .header-icon-btn {
      background: #f5f5f5;
      border: none;
      border-radius: 50%;
      width: 38px;
      height: 38px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
      color: #444;
      cursor: pointer;
      transition: background 0.2s;
      position: relative;
    }
    .header-icon-btn:hover {
      background: #e3e3e3;
      color: #1e3a8a;
    }
    .profile-pic {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #eee;
      cursor: pointer;
    }
    /* Dropdown Menu Styles */
    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      min-width: 200px;
      z-index: 1000;
      padding: 0.5rem;
      margin-top: 8px;
    }

    .dropdown-menu.active {
      display: flex;
      flex-direction: column;
    }

    .dropdown-menu a {
      color: #222;
      padding: 0.8rem 1.2rem;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 0.8rem;
      font-size: 0.95rem;
      border-radius: 8px;
      transition: all 0.2s;
    }

    .dropdown-menu a i {
      font-size: 1.1rem;
      color: #666;
      transition: color 0.2s;
    }

    .dropdown-menu a:hover {
      background: #f5f5f5;
      color: #1e3a8a;
    }

    .dropdown-menu a:hover i {
      color: #1e3a8a;
    }

    @media (max-width: 1024px) {
      .search-bar input[type="text"] {
        width: 300px;
      }
    }

    @media (max-width: 768px) {
      .search-bar {
        margin: 0 1rem;
      }
      .search-bar input[type="text"] {
        width: 200px;
      }
      .header-content {
        padding: 0 1rem;
      }
    }

    @media (max-width: 480px) {
      .search-bar {
        display: none;
      }
      .logo span {
        font-size: 0.9rem;
      }
    }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <a href="dashboard.php" class="logo">
                <img src="img/logo.png" alt="Logo" style="height:48px; width:auto; display:block;" />
                <span style="color:#ffe32d;"><strong>ANYTHING</strong></span>
                <span style="color:#1e3a8a;"><strong>GOES</strong></span>
                <span style="color:#e53935;"><strong>TAMBAYAN</strong></span>
            </a>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search podcasts..." />
                <button id="searchButton"><i class="fas fa-search"></i></button>
            </div>
            <div class="header-icons">
                <button class="header-icon-btn" id="menuBtn" title="Menu"><i class="fas fa-bars"></i></button>
                <div class="dropdown-menu" id="dropdownMenu" style="right:0;">
                    <a href="category.php"><i class="fas fa-th-large"></i>Category</a>
                    <a href="discover.php"><i class="fas fa-compass"></i>Discover</a>
                    <a href="top10.php"><i class="fas fa-chart-line"></i>Top 10 Podcasts</a>
                    <a href="mostrecent.php"><i class="fas fa-clock"></i>Most Recent</a>
                </div>
                <a href="upload.php" class="header-icon-btn" title="Upload"><i class="fas fa-upload"></i></a>
                <button class="header-icon-btn" id="profileBtn" title="Profile">
                    <img src="img/avatar.jpg" alt="Profile" class="profile-pic" />
                </button>
                <div class="dropdown-menu" id="profileDropdown" style="right:0;">
                    <a href="profile.php"><i class="fas fa-user"></i>Profile</a>
                    <a href="settings.php"><i class="fas fa-cog"></i>Settings</a>
                    <a href="manage.php"><i class="fas fa-tasks"></i>Manage Topics</a>
                    <a href="index.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Add Firebase SDKs -->
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-auth-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore-compat.js"></script>
    <script src="../firebase-config.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Firebase auth state observer
        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
                firebase.firestore().collection("users").doc(user.uid).get().then(function(doc) {
                    let photoURL = "img/default-image.jpg";
                    if (doc.exists && doc.data().photoURL) {
                        photoURL = doc.data().photoURL;
                    } else if (user.photoURL) {
                        photoURL = user.photoURL;
                    }
                    const profileBtn = document.getElementById('profileBtn');
                    if (profileBtn) {
                        profileBtn.innerHTML = `<img src="${photoURL}" alt="Profile" class="profile-pic">`;
                    }
                });
            }
        });

        // Menu toggle handlers
        const menuBtn = document.getElementById('menuBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        menuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('active');
            profileDropdown.classList.remove('active');
        });

        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            profileDropdown.classList.toggle('active');
            dropdownMenu.classList.remove('active');
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.header-icon-btn')) {
                dropdownMenu.classList.remove('active');
                profileDropdown.classList.remove('active');
            }
        });

        // Search functionality
        const searchButton = document.getElementById('searchButton');
        const searchInput = document.getElementById('searchInput');

        searchButton.addEventListener('click', function() {
            const searchQuery = searchInput.value.toLowerCase();
            const searchEvent = new CustomEvent('headerSearch', { detail: searchQuery });
            document.dispatchEvent(searchEvent);
        });

        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchButton.click();
            }
        });
    });
    </script>
</body>
</html>