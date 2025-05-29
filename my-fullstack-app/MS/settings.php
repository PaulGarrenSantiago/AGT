<?php
include 'header.php';
include 'firebase_init.php';

$settings_content = '
  <div class="main-content">
    <div class="account-title">
      <i class="fa fa-user"></i> Account Settings
    </div>
    
    <!-- Profile Section -->
    <div class="profile-section">
      <div class="profile-info">
        <div class="profile-image">
          <img id="currentPhoto" src="img/profile-placeholder.jpg" alt="Profile Photo">

        </div>
        <div class="profile-details">
          <h3 id="displayName">Loading...</h3>
          <p id="userEmail">Loading...</p>
          <div class="account-actions">
            <a href="changepassword.php" class="action-btn">
              <i class="fas fa-key"></i> Change Password
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
';
?>

<style>
  .account-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #222;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .account-title i {
    color: #1e3a8a;
    font-size: 1.6rem;
  }

  .profile-section {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
  }

  .profile-info {
    display: flex;
    align-items: center;
    gap: 2rem;
  }

  .profile-image {
    position: relative;
    width: 120px;
    height: 120px;
  }

  .profile-image img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid white;
    box-shadow: 0 2px 12px rgba(0,0,0,0.1);
  }

  .change-photo-btn {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    background: #1e3a8a;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
  }

  .profile-details {
    flex: 1;
  }

  .profile-details h3 {
    font-size: 1.5rem;
    color: #222;
    margin: 0 0 0.5rem 0;
  }

  .profile-details p {
    color: #666;
    margin: 0 0 1.5rem 0;
  }

  .account-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
  }

  .action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem 1.2rem;
    background: #1e3a8a;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
  }

  .action-btn:hover {
    background: #1e40af;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(30,58,138,0.2);
  }

  @media (max-width: 768px) {
    .profile-info {
      flex-direction: column;
      text-align: center;
    }

    .profile-image {
      margin: 0 auto;
    }

    .profile-details {
      text-align: center;
    }

    .account-actions {
      justify-content: center;
    }
  }
</style>

<?php include 'settings_nav.php'; ?>

<script>
  // Wait for Firebase to be initialized from header.php
  function initializeUserData() {
    const auth = firebase.auth();
    const db = firebase.firestore();
    
    auth.onAuthStateChanged(function(user) {
      if (user) {
        // Update UI with Firebase Auth data first
        document.getElementById('displayName').textContent = user.displayName || 'User';
        document.getElementById('userEmail').textContent = user.email;
        document.getElementById('currentPhoto').src = user.photoURL || 'img/profile-placeholder.jpg';
        
        // Then get Firestore data
        db.collection('users').doc(user.uid).get()
          .then((doc) => {
            if (doc.exists) {
              const data = doc.data();
              document.getElementById('displayName').textContent = data.username || user.displayName || 'User';
              document.getElementById('userEmail').textContent = data.email || user.email;
              document.getElementById('currentPhoto').src = data.photoURL || user.photoURL || 'img/profile-placeholder.jpg';
            }
          })
          .catch((error) => {
            console.error('Error getting user data:', error);
          });
      } else {
        window.location.href = 'login.php';
      }
    });
  }

  // Check if Firebase is initialized
  function checkFirebase() {
    if (typeof firebase !== 'undefined' && firebase.apps.length) {
      initializeUserData();
    } else {
      setTimeout(checkFirebase, 100);
    }
  }

  // Start checking for Firebase
  checkFirebase();
</script> 