<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Anything Goes Tambayan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
      --primary: #1e3a8a;
      --accent-yellow: #ffe32d;
      --accent-red: #e53935;
      --text-primary: #2d3748;
      --text-secondary: #4a5568;
      --bg-primary: #f9fafb;
      --bg-secondary: #ffffff;
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--bg-primary);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: var(--text-primary);
      overflow-x: hidden;
      position: relative;
    }

    header {
      background: var(--bg-secondary);
      padding: 0;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      height: 80px;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.95);
    }

    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 2rem;
      height: 80px;
    }

    .logo {
      display: flex;
      align-items: center;
      text-decoration: none;
      gap: 0.5rem;
      transform: translateY(0);
      transition: transform 0.3s ease;
    }

    .logo:hover {
      transform: translateY(-2px);
    }

    .logo img {
      height: 48px;
      width: auto;
    }

    nav {
      display: flex;
      gap: 1rem;
    }

    nav a {
      color: var(--text-primary);
      text-decoration: none;
      padding: 0.8rem 1.5rem;
      border-radius: 30px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      font-weight: 500;
      position: relative;
      overflow: hidden;
    }

    nav a:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    nav a::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, var(--primary), #2563eb);
      opacity: 0;
      transition: opacity 0.3s ease;
      z-index: -1;
    }

    nav a:hover::before {
      opacity: 0.1;
    }

    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 4rem 2rem 8rem;
      text-align: center;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      margin-top: 80px;
      position: relative;
      min-height: calc(100vh - 80px - 73px);
      margin-bottom: 73px;
    }

    main::before {
      content: '';
      position: fixed;
      width: 100%;
      height: 100%;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="1" fill="%231e3a8a" opacity="0.1"/></svg>') 0 0/50px 50px;
      opacity: 0.5;
      z-index: 0;
      pointer-events: none;
    }

    .hero-content {
      max-width: 900px;
      margin: 2rem auto;
      position: relative;
      z-index: 1;
    }

    .hero-title {
      font-size: 4rem;
      margin-bottom: 1.5rem;
      line-height: 1.1;
      font-weight: 700;
      letter-spacing: -0.02em;
      opacity: 0;
      animation: fadeInUp 0.8s ease forwards;
    }

    .hero-subtitle {
      font-size: 1.35rem;
      color: var(--text-secondary);
      margin-bottom: 3rem;
      line-height: 1.6;
      opacity: 0;
      animation: fadeInUp 0.8s ease 0.2s forwards;
    }

    .cta-buttons {
      display: flex;
      gap: 1.5rem;
      justify-content: center;
      opacity: 0;
      animation: fadeInUp 0.8s ease 0.4s forwards;
    }

    .button {
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      padding: 1rem 2rem;
      border-radius: 30px;
      font-size: 1.1rem;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .button i {
      font-size: 1.2rem;
      transition: transform 0.3s ease;
    }

    .primary-button {
      background: linear-gradient(45deg, var(--primary), #2563eb);
      color: white;
      box-shadow: 0 4px 15px rgba(30, 58, 138, 0.2);
    }

    .primary-button:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(30, 58, 138, 0.3);
    }

    .primary-button:hover i {
      transform: translateX(3px);
    }

    .secondary-button {
      background: var(--bg-secondary);
      color: var(--text-primary);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .secondary-button:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .features {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2.5rem;
      max-width: 1200px;
      width: 100%;
      margin: 2rem auto;
      padding: 0 2rem;
      position: relative;
      z-index: 1;
      margin-bottom: 8rem;
    }

    .feature-card {
      background: var(--bg-secondary);
      padding: 2.5rem;
      border-radius: 24px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      text-align: center;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      min-height: 250px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      gap: 1rem;
    }

    .feature-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, var(--primary), #2563eb);
      opacity: 0;
      transition: opacity 0.3s ease;
      z-index: 0;
      border-radius: 24px;
    }

    .feature-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .feature-card:hover::before {
      opacity: 0.03;
    }

    .feature-icon {
      font-size: 3rem;
      color: var(--primary);
      margin-bottom: 0.5rem;
      position: relative;
      z-index: 1;
    }

    .feature-card h3 {
      font-size: 1.5rem;
      margin: 0;
      color: var(--text-primary);
      position: relative;
      z-index: 1;
    }

    .feature-card p {
      color: var(--text-secondary);
      line-height: 1.6;
      position: relative;
      z-index: 1;
      margin: 0;
    }

    footer {
      background: rgb(215, 215, 217);
      color: var(--text-secondary);
      padding: 1.5rem 2rem;
      width: 100%;
      box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.05);
      z-index: 10;
      position: fixed;
      bottom: 0;
      left: 0;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1400px;
      margin: 0 auto;
      height: 100%;
    }

    .social-icons {
      display: flex;
      gap: 1.5rem;
    }

    .social-icons a {
      color: var(--text-secondary);
      font-size: 1.5rem;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: var(--bg-primary);
      text-decoration: none;
    }

    .social-icons a:hover {
      color: var(--primary);
      transform: translateY(-3px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 1024px) {
      .features {
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin: 3rem auto;
      }
    }

    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .hero-subtitle {
        font-size: 1.1rem;
      }

      .features {
        grid-template-columns: 1fr;
        margin: 2rem auto;
        padding: 0 1rem;
      }
      
      .cta-buttons {
        flex-direction: column;
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
      }

      .button {
        width: 100%;
        justify-content: center;
      }
      
      .footer-content {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
        padding: 0.5rem 0;
      }

      main {
        padding: 6rem 1rem 6rem;
      }

      body {
        min-height: 100vh;
      }
    }

    @media (max-width: 480px) {
      .hero-title {
        font-size: 2rem;
      }

      .header-content {
        padding: 0 1rem;
      }

      nav {
        gap: 0.5rem;
      }

      nav a {
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
      }

      .logo span {
        font-size: 0.9rem;
      }

      .logo img {
        height: 40px;
      }

      main {
        padding: 6rem 1rem 6rem;
      }
    }
  </style>  
</head>
<body>
  <header>
    <div class="header-content">
      <a href="index.php" class="logo">
        <img src="img/logo.png" alt="Logo" />
        <span style="color:var(--accent-yellow);"><strong>ANYTHING</strong></span>
        <span style="color:var(--primary);"><strong>GOES</strong></span>
        <span style="color:var(--accent-red);"><strong>TAMBAYAN</strong></span>
      </a>
      <nav>
        <a href="login.php">Login</a>
        <a href="signup.php" style="background: var(--primary); color: white;">Sign Up</a>
      </nav>
    </div>
  </header>

  <main>
    <div class="hero-content">
      <h1 class="hero-title">
        <span style="color: var(--accent-yellow);">Share</span> 
        <span style="color: var(--primary);">Your Voice</span>
        <span style="color: var(--accent-red);">With The World</span>
      </h1>
      <p class="hero-subtitle">
        Join our vibrant community where stories come alive. Share your thoughts, listen to diverse perspectives, and connect with like-minded people in your favorite hangout spot.
      </p>
      <div class="cta-buttons">
        <a href="dashboard.php" class="button primary-button">
          <i class="fas fa-headphones"></i>
          Explore Popular Topics
        </a>
        <a href="signup.php" class="button secondary-button">
          <i class="fas fa-user-plus"></i>
          Join Now
        </a>
      </div>
    </div>

    <div class="features">
      <div class="feature-card">
        <i class="fas fa-microphone-alt feature-icon"></i>
        <h3>Share Your Story</h3>
        <p>Create and share your own podcasts with our easy-to-use platform</p>
      </div>
      <div class="feature-card">
        <i class="fas fa-users feature-icon"></i>
        <h3>Join Communities</h3>
        <p>Connect with people who share your interests and passions</p>
      </div>
      <div class="feature-card">
        <i class="fas fa-headphones feature-icon"></i>
        <h3>Listen Anywhere</h3>
        <p>Access your favorite content anytime, anywhere, on any device</p>
      </div>
    </div>
  </main>

  <footer>
    <div class="footer-content">
      <span>&copy; 2025 Anything Goes Tambayan. All rights reserved.</span>
      <div class="social-icons">
        <a href="https://facebook.com" target="_blank" title="Facebook">
          <i class="fab fa-facebook"></i>
        </a>
        <a href="https://twitter.com" target="_blank" title="Twitter">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="https://instagram.com" target="_blank" title="Instagram">
          <i class="fab fa-instagram"></i>
        </a>
      </div>
    </div>
  </footer>
</body>
</html>
