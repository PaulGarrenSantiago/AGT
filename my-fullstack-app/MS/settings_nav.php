<?php
  // No need to include header.php here as it's included in the main file
?>

<style>
  .settings-grid {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 2rem;
    min-height: calc(100vh - 180px);
  }

  .sidebar {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    height: fit-content;
  }

  .sidebar h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #222;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
  }

  .nav-item {
    display: flex;
    align-items: center;
    padding: 0.8rem 1rem;
    font-size: 1rem;
    color: #444;
    cursor: pointer;
    transition: all 0.2s;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    text-decoration: none;
  }

  .nav-item i {
    margin-right: 1rem;
    font-size: 1.2rem;
    width: 24px;
    text-align: center;
  }

  .nav-item:hover {
    background: #f5f5f5;
    color: #1e3a8a;
  }

  .nav-item.selected {
    background: #1e3a8a;
    color: white;
  }

  .main-content {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  }

  .back-btn {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    padding: 0.8rem 1.5rem;
    background: #1e3a8a;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    text-decoration: none;
  }

  .back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  }

  @media (max-width: 768px) {
    .settings-grid {
      grid-template-columns: 1fr;
    }

    .container {
      padding: 1rem;
    }

    .back-btn {
      position: static;
      margin-top: 2rem;
      width: 100%;
      justify-content: center;
    }
  }
</style>

<div class="container" style="margin-top: 90px; max-width: 1400px; margin-left: auto; margin-right: auto; padding: 2rem;">
  <div class="settings-grid">
    <div class="sidebar">
      <h2>Settings</h2>
      <div class="nav">
        <a href="settings.php" class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'selected' : ''; ?>">
          <i class="fa fa-user"></i> Account
        </a>
        <a href="aboutus.php" class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'aboutus.php' ? 'selected' : ''; ?>">
          <i class="fa fa-info-circle"></i> About Us
        </a>
        <a href="contactus.php" class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'contactus.php' ? 'selected' : ''; ?>">
          <i class="fa fa-phone"></i> Contact Us
        </a>
      </div>
    </div>
    <!-- Content will be injected here by individual pages -->
    <?php echo $settings_content; ?>
  </div>
  <a href="dashboard.php" class="back-btn"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
</div> 