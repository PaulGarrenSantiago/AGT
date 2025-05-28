<?php
  $settings_content = '
    <div class="main-content">
      <div class="account-title">
        <i class="fa fa-envelope"></i> Change Email Address
      </div>
      
      <div class="form-section">
        <p class="form-description">
          Enter your new email address and current password to update your email.
        </p>

        <form id="changeEmailForm" class="settings-form">
          <div class="form-group">
            <label for="newEmail">New Email Address</label>
            <input type="email" id="newEmail" name="newEmail" required placeholder="Enter your new email address">
          </div>
          <div class="form-group">
            <label for="emailPassword">Current Password</label>
            <div class="password-input">
              <input type="password" id="emailPassword" name="emailPassword" required placeholder="Enter your current password">
              <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility(\'emailPassword\')"></i>
            </div>
          </div>
          <button type="submit" class="submit-btn">
            <i class="fas fa-save"></i> Update Email
          </button>
        </form>
      </div>
    </div>
  ';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Change Email - Anything Goes Tambayan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    .form-section {
      background: #f8f9fa;
      border-radius: 12px;
      padding: 2rem;
      margin-bottom: 2rem;
      max-width: 600px;
    }

    .form-description {
      color: #666;
      margin-bottom: 2rem;
      line-height: 1.6;
    }

    .settings-form {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .form-group label {
      font-size: 1rem;
      font-weight: 600;
      color: #444;
    }

    .form-group input {
      padding: 0.8rem 1rem;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.2s;
    }

    .form-group input:focus {
      border-color: #1e3a8a;
      box-shadow: 0 0 0 2px rgba(30,58,138,0.1);
      outline: none;
    }

    .password-input {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #666;
      cursor: pointer;
      transition: color 0.2s;
    }

    .toggle-password:hover {
      color: #1e3a8a;
    }

    .submit-btn {
      background: #1e3a8a;
      color: white;
      border: none;
      padding: 1rem;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .submit-btn:hover {
      background: #1e40af;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(30,58,138,0.2);
    }

    .error-message {
      color: #dc2626;
      background: #fee2e2;
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: 1rem;
      display: none;
    }

    .success-message {
      color: #059669;
      background: #d1fae5;
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: 1rem;
      display: none;
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>
  <?php include 'settings_nav.php'; ?>

  <script>
    function togglePasswordVisibility(inputId) {
      const input = document.getElementById(inputId);
      const icon = input.nextElementSibling;
      
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }

    // Handle email change
    document.getElementById('changeEmailForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      
      const newEmail = document.getElementById('newEmail').value;
      const password = document.getElementById('emailPassword').value;
      const form = this;
      
      try {
        const user = firebase.auth().currentUser;
        
        // Re-authenticate user first
        const credential = firebase.auth.EmailAuthProvider.credential(user.email, password);
        await user.reauthenticateWithCredential(credential);

        // Update email in Firebase Auth
        await user.updateEmail(newEmail);
        
        // Update email in Firestore
        await firebase.firestore().collection('users').doc(user.uid).update({
          email: newEmail
        });
        
        // Show success message
        showMessage(form, 'Email updated successfully! Redirecting...', 'success');
        
        // Redirect after 2 seconds
        setTimeout(() => {
          window.location.href = 'settings.php';
        }, 2000);
        
      } catch (error) {
        console.error('Error updating email:', error);
        let errorMessage = error.message;
        
        // Provide more user-friendly error messages
        if (error.code === 'auth/requires-recent-login') {
          errorMessage = 'For security reasons, please log out and log back in before changing your email.';
        } else if (error.code === 'auth/email-already-in-use') {
          errorMessage = 'This email is already registered. Please use a different email address.';
        } else if (error.code === 'auth/invalid-email') {
          errorMessage = 'Please enter a valid email address.';
        } else if (error.code === 'auth/wrong-password') {
          errorMessage = 'Incorrect password. Please try again.';
        }
        
        showMessage(form, errorMessage, 'error');
      }
    });

    // Helper function to show messages
    function showMessage(container, message, type) {
      const messageDiv = document.createElement('div');
      messageDiv.className = type === 'error' ? 'error-message' : 'success-message';
      messageDiv.textContent = message;
      messageDiv.style.display = 'block';
      
      // Remove any existing messages
      const existingMessages = container.querySelectorAll('.error-message, .success-message');
      existingMessages.forEach(msg => msg.remove());
      
      // Add new message before the container
      container.parentNode.insertBefore(messageDiv, container);
      
      if (type === 'error') {
        // Remove error message after 3 seconds
        setTimeout(() => messageDiv.remove(), 3000);
      }
    }
  </script>
</body>
</html> 