<?php
  $settings_content = '
    <div class="main-content">
      <h1 class="settings-header">
        <i class="fa fa-info-circle"></i>
        About Us
      </h1>

      <div class="about-intro">
        <h2>Welcome to Anything Goes Tambayan!</h2>
        <p>Your ultimate virtual tambayan where conversations flow freely, stories come alive, and connections are made. Join us in creating a space where every voice matters and every story finds its audience.</p>
      </div>

      <div class="about-grid">
        <div class="about-card">
          <div class="about-img">
            <img src="img/podcast-studio.png" alt="Podcast Studio">
          </div>
          <div class="about-content">
            <h3>Your Digital Barkada</h3>
            <p>We\'re not just a podcast – we\'re your barkada in the digital world. Whether you\'re chilling after a long day, looking for good vibes, or just want someone to talk to (or listen to), you\'re in the right place.</p>
          </div>
        </div>

        <div class="about-card">
          <div class="about-img">
            <img src="img/podcast-goal.jpg" alt="Podcast Goal">
          </div>
          <div class="about-content">
            <h3>Our Mission</h3>
            <p>To keep things real, relatable, and ridiculously fun. We created this space for laughs, meaningful conversations, and good company. It\'s an open mic for everyone!</p>
          </div>
        </div>
      </div>

      <div class="about-features">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-microphone"></i>
          </div>
          <div class="feature-title">Open Platform</div>
          <div class="feature-desc">Share your stories, thoughts, and experiences with a community that listens.</div>
        </div>

        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-users"></i>
          </div>
          <div class="feature-title">Vibrant Community</div>
          <div class="feature-desc">Connect with like-minded individuals who share your interests and passions.</div>
        </div>

        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-heart"></i>
          </div>
          <div class="feature-title">Authentic Content</div>
          <div class="feature-desc">Real conversations and genuine interactions, no filters needed.</div>
        </div>
      </div>
    </div>
  ';
?>

<style>
  .settings-header {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 28px;
    color: #1a1a1a;
    margin-bottom: 32px;
    font-weight: 600;
  }

  .settings-header i {
    color: #1e3a8a;
    font-size: 28px;
  }

  .about-intro {
    text-align: center;
    margin-bottom: 3rem;
    padding: 2rem;
    background: linear-gradient(135deg, #1e3a8a08 0%, #1e3a8a15 100%);
    border-radius: 12px;
  }

  .about-intro h2 {
    color: #1e3a8a;
    font-size: 2rem;
    margin-bottom: 1rem;
    font-weight: 700;
  }

  .about-intro p {
    color: #666;
    font-size: 1.1rem;
    line-height: 1.6;
    max-width: 800px;
    margin: 0 auto;
  }

  .about-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    margin-bottom: 3rem;
  }

  .about-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .about-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
  }

  .about-img {
    width: 100%;
    height: 240px;
    overflow: hidden;
  }

  .about-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .about-card:hover .about-img img {
    transform: scale(1.05);
  }

  .about-content {
    padding: 1.5rem;
  }

  .about-content h3 {
    color: #1e3a8a;
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 1rem;
  }

  .about-content p {
    color: #555;
    font-size: 1.05rem;
    line-height: 1.6;
    margin: 0;
  }

  .about-features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-top: 3rem;
  }

  .feature-card {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 12px;
    text-align: center;
    transition: transform 0.3s ease;
  }

  .feature-card:hover {
    transform: translateY(-5px);
  }

  .feature-icon {
    font-size: 2rem;
    color: #1e3a8a;
    margin-bottom: 1rem;
  }

  .feature-title {
    color: #222;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  .feature-desc {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.5;
  }

  @media (max-width: 768px) {
    .about-grid {
      grid-template-columns: 1fr;
    }

    .about-features {
      grid-template-columns: 1fr;
    }

    .about-intro {
      padding: 1.5rem;
    }

    .about-intro h2 {
      font-size: 1.6rem;
    }

    .about-img {
      height: 200px;
    }
  }
</style>

<?php include 'header.php'; ?>
<?php include 'settings_nav.php'; ?> 