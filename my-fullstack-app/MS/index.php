<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Anything Goes Tambayan</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: black;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header {
      background: linear-gradient(90deg, rgba(230, 203, 28, 0.76) 0%, rgba(45, 50, 194, 0.72) 47%, rgba(204, 35, 35, 0.79) 100%);
      color: white;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    nav a {
      color: white;
      margin-left: 1rem;
      text-decoration: none;
    }

    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .button {
      display: block;
      width: fit-content;
      margin: 20px auto;
      padding: 0.7rem 1.5rem;
      background-color: #1e3a8a;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    footer {
      background-color: #333;
      color: white;
      padding: 15px 30px;
      font-family: Arial, sans-serif;
      font-size: 0.9rem;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .social-icons a {
      margin-left: 15px;
      display: inline-block;
    }

    .social-icons a img {
      width: 24px;
      height: 24px;
      filter: brightness(0) invert(1);
      transition: filter 0.3s ease;
    }

    .social-icons a:hover img {
      filter: brightness(0) invert(0.7);
    }

    copyright {
      white-space: nowrap;
    }
  </style>  
</head>
<body>
  <header>
    <div class="text-center">
      <h1 style="font-size: 3rem; font-weight: bold; margin-top: 2px;">
        <strong>
          <span style="color: #f5f508e3;">ANYTHING</span> 
          <span style="color: rgb(50, 138, 232);">GOES</span> 
          <span style="color: red;">TAMBAYAN</span>
        </strong>
      </h1>
      <p style="margin-top: -40px;">Your Hangout Spot for Chill Talks, Real Stories, and Anything Under the Sun!</p>
    </div>

    <nav>
      <a href="login.php">Login</a>
      <a href="signup.php">Sign Up</a>
    </nav>
  </header>

  <main>
    <a href="dashboard.html" class="button">Listen to Popular Topics</a>
  </main>

  <footer>
    <div class="footer-content">
      <span>&copy; 2025 Anything Goes Tambayan. All rights reserved.</span>
      <div class="social-icons">
        <a href="https://facebook.com" target="_blank" title="Facebook">
          <img src="fb.png" alt="Facebook" />
        </a>
        <a href="https://twitter.com" target="_blank" title="Twitter">
          <img src="x.png" alt="Twitter" />
        </a>
        <a href="https://instagram.com" target="_blank" title="Instagram">
          <img src="ig.jpg" alt="Instagram" />
        </a>
      </div>
    </div>
  </footer>
</body>
</html>
