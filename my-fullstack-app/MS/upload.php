<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Settings - Anything Goes Tambayan</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Montserrat', Arial, sans-serif;
      background: #000;
      color: #fff;
      height: 100vh;
      overflow: hidden; /* Prevent scrolling */
    }
    .header {
      background: linear-gradient(90deg, rgba(230, 203, 28, 0.76) 0%, rgba(45, 50, 194, 0.72) 47%, rgba(204, 35, 35, 0.79) 100%);
      padding: 24px 0 12px 0;
      text-align: left;
      box-shadow: 0 2px 16px 0 rgba(0,0,0,0.18);
    }
    .header-title {
      font-size: 2.7rem;
      font-weight: 800;
      letter-spacing: 2px;
      margin-left: 48px;
      text-shadow: 1px 2px 8px #222, 0 1px 0 #fff2;
    }
    .header-title .goes { color: #3ec6ff; }
    .header-title .tambayan { color: #ff2d2d; }
    .header-desc {
      font-size: 1.08rem;
      margin-left: 52px;
      margin-top: 7px;
      color: #fff;
      opacity: 0.92;
      letter-spacing: 0.5px;
      text-shadow: 0 1px 6px #222;
    }
    .container {
      height: 100vh; /* Fill viewport */
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden; /* Prevent scrollbars */
    }
    .upload-card {
      width: 100%;
      max-width: 600px;         /* Increased from 400px */
      box-sizing: border-box;
      padding: 3rem 3rem;       /* Increased padding */
      border-radius: 1.2rem;
      box-shadow: 0 2px 24px rgba(0,0,0,0.22);
      background: #fff;
      color: #222;
      display: flex;
      flex-direction: column;
      align-items: stretch;
      z-index: 1;
      margin-bottom: 100px;
    }
    .form-label {
      font-weight: 500;
    }
    .btn-upload {
      background: #007bff;
      color: #fff;
      font-weight: 500;
      border: none;
      border-radius: 6px;
      padding: 10px 0;
      margin-top: 10px;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn-upload:hover {
      background: #0056b3;
    }
    .back-btn {
      position: fixed;          /* Changed from absolute */
      bottom: 40px;
      right: 60px;
      background: linear-gradient(90deg, #ff5858 0%, #ff2d2d 100%);
      color: #fff;
      border: none;
      border-radius: 50px;
      padding: 14px 48px 14px 32px;
      font-size: 1.2rem;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
      box-shadow: 0 4px 18px #ff2d2d44, 0 2px 10px #ff2d2d22;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      gap: 12px;
      outline: none;
      z-index: 100;
    }
    .back-btn i {
      font-size: 1.3rem;
      margin-right: 8px;
      transition: transform 0.2s;
    }
    .back-btn:hover {
      background: linear-gradient(90deg, #ff7b7b 0%, #c1272d 100%);
      box-shadow: 0 6px 24px #c1272d66;
      transform: translateY(-2px) scale(1.04);
    }
    .back-btn:active {
      transform: scale(0.98);
    }
    .form-title {
      color: #0a2c5e;
      font-size: 1.2rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 1.2rem;
    }
    .upload-box {
      border: 2px solid #bbb;
      border-radius: 8px;
      padding: 1.5rem 0 1rem 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      cursor: pointer;
      margin-bottom: 1.1rem;
      transition: border-color 0.2s;
    }
    .upload-box:hover {
      border-color: #007bff;
    }
    .upload-icon {
      font-size: 2.8rem;
      color: #222;
      margin-bottom: 0.3rem;
    }
    .upload-text {
      color: #222;
      font-size: 1.1rem;
      font-weight: 500;
    }
    .form-input {
      width: 100%;
      padding: 0.7rem 1rem;
      margin-bottom: 1rem;
      border: 1.5px solid #bbb;
      border-radius: 7px;
      font-size: 1rem;
      font-family: inherit;
      outline: none;
      transition: border-color 0.2s;
      background: #fff;
      color: #222;
      resize: none;
    }
    .form-input:focus {
      border-color: #007bff;
    }
    .btn-publish {
      width: 100%;
      padding: 0.8rem 0;
      border: none;
      border-radius: 7px;
      background: linear-gradient(90deg, #4be1ec 0%, #1a6dff 100%);
      color: #fff;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, transform 0.1s;
      margin-top: 0.2rem;
    }
    .btn-publish:hover {
      background: linear-gradient(90deg, #1a6dff 0%, #4be1ec 100%);
      transform: scale(1.03);
    }
    .close-btn {
      position: absolute;
      top: 18px;
      right: 18px;
      background: none;
      border: none;
      color: #222;
      font-size: 1.4rem;
      cursor: pointer;
      z-index: 10;
      padding: 4px 8px;
      transition: color 0.2s, background 0.2s;
    }
    .close-btn:hover {
      color: #fff;
      background: #ff2d2d;
      border-radius: 50%;
    }
    @media (max-width: 900px) {
      .container {
        flex-direction: column;
        justify-content: flex-start;
        align-items: stretch;
        min-height: unset;
        padding: 30px 0;
      }
      .upload-card {
        margin: 40px auto 0 auto;
        max-width: 98vw;        /* Responsive for mobile */
        padding: 1.5rem 0.5rem;
      }
      .back-btn {
        right: 20px;
        bottom: 20px;
        padding: 12px 24px;
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="header">
    <div class="header-title">
      <span style="color:#ffe85c;">ANYTHING</span> <span class="goes">GOES</span> <span class="tambayan">TAMBAYAN</span>
    </div>
    <div class="header-desc">
      Your Hangout Spot for Chill Talks, Real Stories, and Anything Under the Sun!
    </div>
  </div>
  <div class="container">
    <div class="upload-card" style="position:relative;">
      <!-- X Button -->
      <button class="close-btn" type="button" onclick="window.location.href='dashboard.html'" aria-label="Close">
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
    <button class="back-btn" onclick="window.location.href='dashboard.html'"><i class="fa fa-arrow-left"></i> Back</button>
  </div>
</body>
</html>