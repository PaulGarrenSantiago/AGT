<?php
  include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Podcast - Anything Goes Tambayan</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-gradient: linear-gradient(135deg, #4be1ec 0%, #1a6dff 100%);
      --secondary-gradient: linear-gradient(135deg, #ff5858 0%, #ff2d2d 100%);
      --text-primary: #222;
      --text-secondary: #555;
    }

    body {
      margin: 0;
      font-family: 'Montserrat', Arial, sans-serif;
      background-color: #f9f9f9;
      min-height: 100vh;
    }

    .container {
      max-width: 800px;
      margin: 1rem auto;
      padding: 0 1rem;
      box-sizing: border-box;
    }

    .upload-section {
      background: white;
      border-radius: 18px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      padding: 1.5rem;
      width: 100%;
      box-sizing: border-box;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .upload-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 24px rgba(30,58,138,0.18);
    }

    .section-title {
      color: var(--text-primary);
      font-size: 1.3rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 1.5rem;
      position: relative;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 50%;
      transform: translateX(-50%);
      width: 50px;
      height: 3px;
      background: var(--primary-gradient);
      border-radius: 2px;
    }

    .upload-boxes-container {
      display: flex;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .upload-box {
      border: 2.5px dashed #1a6dff;
      border-radius: 12px;
      padding: 1.5rem 1rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      cursor: pointer;
      transition: all 0.3s ease;
      background: rgba(26, 109, 255, 0.05);
      min-height: 140px;
      justify-content: center;
      flex: 1;
      position: relative;
      overflow: hidden;
    }

    #thumbnailZone {
      border-color: #4be1ec;
      background: rgba(75, 225, 236, 0.05);
    }

    #thumbnailZone .upload-icon {
      color: #4be1ec;
    }

    #thumbnailZone:hover {
      border-color: #1a6dff;
      background: rgba(26, 109, 255, 0.08);
    }

    #thumbnailZone:hover .upload-icon {
      color: #1a6dff;
    }

    .upload-icon {
      font-size: 2rem;
      margin-bottom: 0.8rem;
      transition: transform 0.3s ease;
    }

    .upload-text {
      text-align: center;
      font-size: 0.9rem;
      color: var(--text-secondary);
      transition: color 0.3s ease;
      word-break: break-word;
      padding: 0 0.5rem;
    }

    .form-input {
      width: 100%;
      padding: 0.8rem 1rem;
      margin-bottom: 1rem;
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      font-size: 1rem;
      font-family: inherit;
      outline: none;
      transition: all 0.3s ease;
      background: #fff;
      color: var(--text-primary);
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      box-sizing: border-box;
    }

    .form-input:focus {
      border-color: #1a6dff;
      box-shadow: 0 4px 15px rgba(26, 109, 255, 0.15);
    }

    textarea.form-input {
      min-height: 100px;
      resize: vertical;
    }

    .btn-publish {
      width: 100%;
      padding: 0.8rem;
      border: none;
      border-radius: 10px;
      background: var(--primary-gradient);
      color: #fff;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 1px;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .btn-publish i {
      font-size: 1.1rem;
    }

    .btn-publish:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(26, 109, 255, 0.4);
    }

    .loading {
      position: relative;
      color: transparent !important;
    }

    .loading::after {
      content: '';
      position: absolute;
      width: 20px;
      height: 20px;
      border: 3px solid #fff;
      border-top-color: transparent;
      border-radius: 50%;
      animation: loading 0.8s linear infinite;
    }

    @keyframes loading {
      to { transform: rotate(360deg); }
    }

    select.form-input {
      appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      background-size: 1em;
      padding-right: 2.5rem;
    }

    select.form-input:invalid {
      color: #666;
    }

    #uploadStatus {
      text-align: center;
      margin: 0.8rem 0;
      padding: 0.8rem;
      border-radius: 10px;
      font-weight: 500;
      display: none;
      font-size: 0.9rem;
    }

    #uploadStatus.error {
      display: block;
      background-color: #fee2e2;
      color: #dc2626;
      border: 1px solid #fecaca;
    }

    #uploadStatus.success {
      display: block;
      background-color: #dcfce7;
      color: #16a34a;
      border: 1px solid #bbf7d0;
    }

    @media (max-width: 768px) {
      .container {
        margin: 0.5rem auto;
      }

      .upload-section {
        padding: 1rem;
        border-radius: 12px;
      }

      .section-title {
        font-size: 1.2rem;
        margin-bottom: 1.2rem;
      }
    }

    @media (max-width: 480px) {
      .upload-boxes-container {
        flex-direction: column;
      }

      .upload-box {
        width: 100%;
        min-height: 120px;
        padding: 1rem;
      }

      .upload-icon {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
      }

      .upload-text {
        font-size: 0.85rem;
      }

      .form-input {
        padding: 0.7rem 0.9rem;
        font-size: 0.95rem;
      }

      .btn-publish {
        padding: 0.7rem;
        font-size: 0.9rem;
      }
    }

    /* Touch device optimizations */
    @media (hover: none) {
      .upload-section:hover {
        transform: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      }

      .upload-box {
        -webkit-tap-highlight-color: transparent;
      }

      .btn-publish:hover {
        transform: none;
        box-shadow: none;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="upload-section">
      <h3 class="section-title">Upload Your Podcast</h3>
      <form id="uploadForm" enctype="multipart/form-data">
        <div class="upload-boxes-container">
          <label for="thumbnailInput" class="upload-box" id="thumbnailZone">
            <i class="fa fa-image upload-icon"></i>
            <div class="upload-text">Upload Thumbnail Image</div>
            <input type="file" id="thumbnailInput" name="imageFile" required style="display:none;" accept="image/*">
          </label>
          <label for="audioInput" class="upload-box" id="audioZone">
            <i class="fa fa-music upload-icon"></i>
            <div class="upload-text">Upload Audio File</div>
            <input type="file" id="audioInput" name="audioFile" required style="display:none;" accept="audio/*">
          </label>
        </div>
        <input type="text" class="form-input" name="title" id="title" placeholder="Enter podcast title..." required>
        <select class="form-input" name="category" id="category" required>
          <option value="">Select Category</option>
          <option value="business">Business</option>
          <option value="health">Health & Wellness</option>
          <option value="technology">Technology</option>
          <option value="lifestyle">Lifestyle</option>
          <option value="education">Education</option>
          <option value="sports">Sports</option>
          <option value="comedy">Comedy</option>
          <option value="music">Music</option>
        </select>
        <textarea class="form-input" name="description" id="description" placeholder="Write a description for your podcast..." rows="3" required></textarea>
        <div id="uploadStatus"></div>
        <button type="submit" class="btn-publish" id="publishBtn">
          <i class="fas fa-podcast"></i> Publish Podcast
        </button>
      </form>
    </div>
  </div>

  <script>
    // Enhance file upload interaction
    const thumbnailZone = document.getElementById('thumbnailZone');
    const audioZone = document.getElementById('audioZone');
    const thumbnailInput = document.getElementById('thumbnailInput');
    const audioInput = document.getElementById('audioInput');
    const form = document.getElementById('uploadForm');
    const publishBtn = document.getElementById('publishBtn');
    const uploadStatus = document.getElementById('uploadStatus');

    // Drag and drop functionality
    [thumbnailZone, audioZone].forEach(zone => {
      ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        zone.addEventListener(eventName, preventDefaults, false);
      });
    });

    function preventDefaults(e) {
      e.preventDefault();
      e.stopPropagation();
    }

    // Highlight effects
    ['dragenter', 'dragover'].forEach(eventName => {
      thumbnailZone.addEventListener(eventName, () => highlight(thumbnailZone), false);
      audioZone.addEventListener(eventName, () => highlight(audioZone), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
      thumbnailZone.addEventListener(eventName, () => unhighlight(thumbnailZone), false);
      audioZone.addEventListener(eventName, () => unhighlight(audioZone), false);
    });

    function highlight(zone) {
      zone.style.borderColor = '#4be1ec';
      zone.style.transform = 'scale(1.02)';
    }

    function unhighlight(zone) {
      zone.style.borderColor = zone === thumbnailZone ? '#4be1ec' : '#1a6dff';
      zone.style.transform = 'scale(1)';
    }

    // Handle file drops
    thumbnailZone.addEventListener('drop', (e) => handleDrop(e, thumbnailInput, 'image'), false);
    audioZone.addEventListener('drop', (e) => handleDrop(e, audioInput, 'audio'), false);

    function handleDrop(e, input, type) {
      const dt = e.dataTransfer;
      const files = dt.files;
      if (files.length > 0) {
        const file = files[0];
        if (file.type.startsWith(type)) {
          input.files = files;
          updateFileName(input === thumbnailInput ? thumbnailZone : audioZone, file);
        } else {
          showError(`Please upload a valid ${type} file.`);
        }
      }
    }

    // Handle file input changes
    thumbnailInput.addEventListener('change', (e) => {
      if (e.target.files.length > 0) {
        updateFileName(thumbnailZone, e.target.files[0]);
      }
    });

    audioInput.addEventListener('change', (e) => {
      if (e.target.files.length > 0) {
        updateFileName(audioZone, e.target.files[0]);
      }
    });

    function updateFileName(zone, file) {
      const uploadText = zone.querySelector('.upload-text');
      uploadText.textContent = `Selected: ${file.name}`;
      zone.style.borderColor = '#4be1ec';
    }

    function showError(message) {
      uploadStatus.textContent = message;
      uploadStatus.className = 'error';
      setTimeout(() => {
        uploadStatus.className = '';
        uploadStatus.textContent = '';
      }, 3000);
    }

    function showSuccess(message) {
      uploadStatus.textContent = message;
      uploadStatus.className = 'success';
    }

    // Handle form submission
    form.addEventListener('submit', async function(e) {
      e.preventDefault();
      publishBtn.classList.add('loading');
      publishBtn.disabled = true;

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
          await db.collection('users').doc(user.uid).set({
            email: user.email,
            username: user.displayName || 'Anonymous User',
            photoURL: user.photoURL || 'img/default-avatar.png',
            createdAt: firebase.firestore.Timestamp.now()
          });
        }

        const formData = new FormData(this);

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
        await db.collection('podcasts').add({
          title: this.title.value,
          description: this.description.value,
          category: this.category.value,
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

        showSuccess('Upload successful!');
        
        // Redirect to dashboard after short delay
        setTimeout(() => {
          window.location.href = 'dashboard.php';
        }, 1500);

      } catch (error) {
        console.error('Upload error:', error);
        showError(error.message);
        publishBtn.classList.remove('loading');
        publishBtn.disabled = false;
      }
    });
  </script>
</body>
</html>