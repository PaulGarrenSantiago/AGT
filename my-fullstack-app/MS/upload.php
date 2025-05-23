<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Podcast - Anything Goes Tambayan</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Add Firebase SDKs -->
  <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-auth-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore-compat.js"></script>
  <script src="../firebase-config.js"></script>
  
  <!-- Add authentication check -->
  <script>
    // Check authentication state before page loads
    firebase.auth().onAuthStateChanged(function(user) {
      if (!user) {
        // User is not logged in, redirect to login page
        window.location.href = 'login.php';
      }
    });
  </script>

  <style>
    body {
      margin: 0;
      font-family: 'Montserrat', Arial, sans-serif;
      background: #000;
      color: #fff;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      width: 100%;
      max-width: 600px;
      margin: 20px;
      position: relative;
    }

    .upload-card {
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      position: relative;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: none;
      border: none;
      font-size: 1.2rem;
      cursor: pointer;
      color: #666;
      padding: 5px;
      z-index: 10;
    }

    .close-btn:hover {
      color: #333;
    }

    .form-title {
      color: #0a2c5e;
      font-size: 1.5rem;
      text-align: center;
      margin-bottom: 2rem;
      font-weight: bold;
    }

    .upload-boxes {
      display: flex;
      gap: 20px;
      margin-bottom: 2rem;
    }

    .upload-box {
      flex: 1;
      border: 2px dashed #ccc;
      border-radius: 8px;
      padding: 2rem;
      text-align: center;
      cursor: pointer;
      transition: border-color 0.3s;
    }

    .upload-box:hover {
      border-color: #0a2c5e;
    }

    .upload-icon {
      font-size: 2rem;
      color: #666;
      margin-bottom: 0.5rem;
    }

    .upload-text {
      color: #666;
      font-size: 1rem;
    }

    .file-name {
      margin-top: 0.5rem;
      font-size: 0.8rem;
      color: #666;
      word-break: break-all;
    }

    .form-input {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    textarea.form-input {
      resize: vertical;
      min-height: 80px;
    }

    .category-select {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      background: white;
      color: #333;
    }

    .btn-publish {
      width: 100%;
      padding: 0.8rem;
      background: #0a2c5e;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1rem;
      font-weight: bold;
    }

    .btn-publish:hover {
      background: #0d3d7a;
    }

    #uploadStatus {
      text-align: center;
      margin: 1rem 0;
      padding: 0.8rem;
      border-radius: 4px;
      font-weight: 500;
    }

    #uploadStatus.error {
      background-color: #fee2e2;
      color: #dc2626;
      border: 1px solid #fecaca;
    }

    #uploadStatus.success {
      background-color: #dcfce7;
      color: #16a34a;
      border: 1px solid #bbf7d0;
    }

    .error {
      color: #dc3545;
    }

    @media (max-width: 480px) {
      .upload-boxes {
        flex-direction: column;
      }
      
      .container {
        margin: 10px;
      }
      
      .upload-card {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="upload-card">
      <button class="close-btn" type="button" onclick="window.location.href='dashboard.php'" aria-label="Close">
        ×
      </button>
      <h3 class="form-title">Upload your podcast here.</h3>
      <form id="uploadForm" enctype="multipart/form-data">
        <div class="upload-boxes">
          <label class="upload-box">
            <i class="fa fa-music upload-icon"></i>
            <div class="upload-text">Upload Audio</div>
            <div id="audioFileName" class="file-name"></div>
            <input type="file" id="audioFile" name="audioFile" accept="audio/*" required style="display:none;">
          </label>
          <label class="upload-box">
            <i class="fa fa-image upload-icon"></i>
            <div class="upload-text">Upload Thumbnail</div>
            <div id="imageFileName" class="file-name"></div>
            <input type="file" id="imageFile" name="imageFile" accept="image/*" required style="display:none;">
          </label>
        </div>
        <input type="text" class="form-input" name="title" id="title" placeholder="Title..." required>
        <textarea class="form-input" name="description" id="description" placeholder="Description..." required></textarea>
        <select class="category-select" name="category" id="category" required>
          <option value="">Select Category...</option>
          <option value="comedy">Comedy</option>
          <option value="education">Education</option>
          <option value="lifestyle">Lifestyle</option>
          <option value="music">Music</option>
          <option value="news">News</option>
          <option value="sports">Sports</option>
          <option value="technology">Technology</option>
        </select>
        <div id="uploadStatus"></div>
        <button type="submit" class="btn-publish">Publish</button>
      </form>
    </div>
  </div>

  <script>
    // Display file names when selected
    document.getElementById('audioFile').addEventListener('change', function(e) {
      document.getElementById('audioFileName').textContent = e.target.files[0]?.name || '';
    });

    document.getElementById('imageFile').addEventListener('change', function(e) {
      document.getElementById('imageFileName').textContent = e.target.files[0]?.name || '';
    });

    // Handle form submission
    document.getElementById('uploadForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      const statusDiv = document.getElementById('uploadStatus');
      statusDiv.textContent = 'Uploading...';

      try {
        // Check authentication first
        const user = firebase.auth().currentUser;
        if (!user) {
          throw new Error('Please log in to upload podcasts');
        }

        // Check if user profile exists
        const db = firebase.firestore();
        const userDoc = await db.collection('users').doc(user.uid).get();
        
        if (!userDoc.exists) {
          // Create a basic profile if it doesn't exist
          await db.collection('users').doc(user.uid).set({
            email: user.email,
            username: user.displayName || 'Anonymous User',
            photoURL: user.photoURL || 'img/default-avatar.png',
            createdAt: firebase.firestore.Timestamp.now()
          });
        }

        const formData = new FormData();
        const audioFile = document.getElementById('audioFile').files[0];
        const imageFile = document.getElementById('imageFile').files[0];

        if (!audioFile || !imageFile) {
          throw new Error('Please select both audio and image files');
        }

        formData.append('audioFile', audioFile);
        formData.append('imageFile', imageFile);

        // Upload files to server
        const response = await fetch('upload_handler.php', {
          method: 'POST',
          body: formData
        });

        const result = await response.json();

        if (!response.ok) throw new Error(result.message || 'Upload failed');

        // Get user data
        const userData = userDoc.exists ? userDoc.data() : {
          username: user.displayName || 'Anonymous User',
          photoURL: user.photoURL || 'img/default-avatar.png'
        };

        // Save to Firestore
        const podcastRef = await db.collection('podcasts').add({
          title: document.getElementById('title').value,
          description: document.getElementById('description').value,
          category: document.getElementById('category').value,
          audioURL: result.audioURL,
          imageURL: result.imageURL,
          createdAt: firebase.firestore.Timestamp.now(),
          updatedAt: firebase.firestore.Timestamp.now(),
          userId: user.uid,
          username: userData.username,
          userPhotoURL: userData.photoURL,
          listenCount: 0,
          totalRating: 0,
          ratingCount: 0,
          averageRating: 0
        });

        statusDiv.textContent = 'Upload successful!';
        statusDiv.className = 'success';
        
        // Redirect to dashboard after short delay
        setTimeout(() => {
          window.location.href = 'dashboard.php';
        }, 1500);

      } catch (error) {
        console.error('Upload error:', error);
        statusDiv.textContent = error.message;
        statusDiv.className = 'error';
      }
    });
  </script>
</body>
</html>