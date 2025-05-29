<?php
  $settings_content = '
    <div class="main-content">
      <h1 class="settings-header">
        <i class="fa fa-envelope"></i>
        Contact Us
      </h1>

      <div class="contact-section">
        <div class="contact-info">
          <h2>Get in Touch</h2>
          <p>We\'d love to hear from you! Reach out to us through any of these channels:</p>
          <p>
            <i class="fa fa-envelope"></i> agt@gmail.com<br>
            <i class="fa fa-phone"></i> 23772 9229 9292<br>
            <i class="fa fa-globe"></i> 09999999999
          </p>
          <p style="margin-top: 2rem; font-style: italic; opacity: 0.9;">
            Or fill out the form and we\'ll get back to you as soon as possible.
          </p>
        </div>
        <form class="contact-form" id="contactForm">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required placeholder="Your name">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Your email address">
          </div>
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" required placeholder="What is this about?">
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" required placeholder="Tell us more about your concern..."></textarea>
          </div>
          <button type="submit">
            <i class="fas fa-paper-plane"></i> Send Message
          </button>
          <div id="formMessage" class="form-message"></div>
        </form>
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

  .contact-section {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 2rem;
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 12px;
  }

  .contact-info {
    padding: 2rem;
    background: #1e3a8a;
    color: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(30,58,138,0.2);
  }

  .contact-info h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: #fff;
  }

  .contact-info p {
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 1rem;
  }

  .contact-info i {
    width: 24px;
    color: #ffe85c;
    margin-right: 0.8rem;
  }

  .contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }

  .contact-form label {
    font-size: 1rem;
    font-weight: 600;
    color: #444;
  }

  .contact-form input,
  .contact-form textarea {
    padding: 0.8rem 1rem;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.2s;
    background: white;
  }

  .contact-form input:focus,
  .contact-form textarea:focus {
    border-color: #1e3a8a;
    outline: none;
    box-shadow: 0 0 0 3px rgba(30,58,138,0.1);
  }

  .contact-form textarea {
    resize: vertical;
    min-height: 120px;
  }

  .contact-form button {
    padding: 1rem;
    background: #1e3a8a;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    margin-top: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
  }

  .contact-form button:hover {
    background: #1e4a9a;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(30,58,138,0.2);
  }

  .form-message {
    padding: 1rem;
    border-radius: 8px;
    margin-top: 1rem;
    display: none;
  }

  .form-message.success {
    background: #d1fae5;
    color: #059669;
    border: 1px solid #059669;
    display: block;
  }

  .form-message.error {
    background: #fee2e2;
    color: #dc2626;
    border: 1px solid #dc2626;
    display: block;
  }

  @media (max-width: 768px) {
    .contact-section {
      grid-template-columns: 1fr;
      padding: 1rem;
    }

    .contact-info {
      padding: 1.5rem;
    }

    .contact-info h2 {
      font-size: 1.5rem;
    }
  }
</style>

<?php include 'header.php'; ?>
<?php include 'settings_nav.php'; ?>

<script>
document.getElementById('contactForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  
  const formMessage = document.getElementById('formMessage');
  const submitButton = this.querySelector('button[type="submit"]');
  const originalButtonText = submitButton.innerHTML;
  
  // Get form data
  const formData = {
    name: document.getElementById('name').value,
    email: document.getElementById('email').value,
    subject: document.getElementById('subject').value,
    message: document.getElementById('message').value,
    timestamp: new Date().toISOString(),
    status: 'new'
  };

  try {
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
    submitButton.disabled = true;

    // Get current user
    const user = firebase.auth().currentUser;
    if (!user) {
      throw new Error('You must be logged in to send a message');
    }

    // Add the user ID to the form data
    formData.userId = user.uid;

    // Save to Firestore
    await firebase.firestore().collection('contact_messages').add(formData);

    // Show success message
    formMessage.className = 'form-message success';
    formMessage.textContent = 'Message sent successfully! We\'ll get back to you soon.';
    
    // Clear form
    this.reset();

  } catch (error) {
    console.error('Error sending message:', error);
    formMessage.className = 'form-message error';
    formMessage.textContent = error.message || 'An error occurred while sending your message. Please try again.';
  } finally {
    submitButton.innerHTML = originalButtonText;
    submitButton.disabled = false;
  }
});
</script> 