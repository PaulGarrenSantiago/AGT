<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Sign Up</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: white;
      min-height: 100vh;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .container {
      display: flex;
      width: 800px;
      min-height: 500px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.2);
      border-radius: 10px;
      overflow: hidden;
      background: #656363;
      border: 1px solid #d3d7da;
    }
    .left {
      background: white;
      width: 110%;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }
    .image-container {
      width: 100%;
      height: 600px;
      background: white;
      border-radius: 8px;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }
    .image-container img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }
    .right {
      width: 110%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #eee;
    }
    form {
      background: #eee;
      padding: 2rem;
      border-radius: 8px;
      max-width: 600px;
      width: 100%;
      box-shadow: none;
    }
    input[type="email"] {
      width: 94%;
      padding: 0.7rem;
      margin: 0.5rem 0 0.6rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    input[type="password"] {
      width: 92%;
      padding: 0.9rem;
      margin: 0 0 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    label {
      display: block;
      margin-bottom: 1rem;
    }
    .button {
      display: block;
      background: linear-gradient(90deg,rgba(28, 190, 230, 0.76) 0%, rgba(0, 8, 255, 0.72) 100%, rgba(204, 35, 35, 0.79) 0%);
      color: white;
      padding: 0.6rem 1.2rem;
      text-align: center;
      border-radius: 4px;
      text-decoration: none;
      margin-top: 1rem;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    .button:hover {
      opacity: 0.9;
    }
    p {
      text-align: center;
      margin-top: 1rem;
    }
    .name-fields {
      display: flex;
      gap: 10px;
      margin-bottom: 0.7rem;
    }
    .name-fields input[type="text"] {
      padding: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .first-name {
      flex: 1;
    }
    .last-name {
      flex: 3;
    }
    .social-login {
      display: flex;
      gap: 10px;
      margin-bottom: 1rem;
    }
    .social-login button {
      flex: 1;
      padding: 0.6rem 1.2rem;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      cursor: pointer;
      border: 1px solid #ccc;
      background: #fff;
      color: #444;
    }
    .social-login button.apple {
      background: #000;
      color: #fff;
      border: 1px solid #000;
    }
    .social-login img {
      width: 20px;
      height: 20px;
    }
    .social-login button.apple img {
      filter: invert(1);
    }
    @media (max-width: 800px) {
      .container {
        flex-direction: column;
        width: 100%;
        min-height: unset;
      }
      .left, .right {
        width: 100%;
        min-height: 250px;
      }
      .image-container {
        height: 200px;
      }
    }
  </style>
  <!-- Add Firebase SDKs -->
  <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-auth-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore-compat.js"></script>
  <script src="../firebase-config.js"></script>
</head>
<body>
  <div class="container">
    <div class="left">
      <div class="image-container">
        <img src="img/dashh.png" alt="Image" />
      </div>
    </div>
    <div class="right">
      <form id="signup-form">
        <h2>Sign Up</h2>
        <!-- Name Fields Container -->
        <div class="name-fields">
          <input type="text" class="first-name" id="first-name" placeholder="First Name" required>
          <input type="text" class="last-name" id="last-name" placeholder="Last Name" required>
        </div>
        <input type="text" id="username" placeholder="Username" required style="width: 94%; padding: 0.7rem; margin: 0.5rem 0 0.6rem; border: 1px solid #ccc; border-radius: 4px;">
        <input type="email" id="signup-email" placeholder="Email Address" required />
        <input type="password" id="signup-password" placeholder="Password" required />
        <label><input type="checkbox" /> Remember Me</label>
        
        <!-- Social Login Buttons Side by Side -->
        <div class="social-login">
          <button type="button" id="google-signup-btn">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google"> Sign Up with Google
          </button>
          <button type="button" class="apple">
            <img src="https://www.svgrepo.com/show/303128/apple-logo.svg" alt="Apple"> Sign Up with Apple
          </button>
        </div>

        <button type="submit" class="button">Sign Up</button>
        <div id="signup-error" style="color:red; margin-top:1rem; text-align:center;"></div>
        <hr>
        <p>Already have an account? <a href="login.php">Login</a></p>
      </form>
    </div>
  </div>

<script>
  // Function to generate a unique userId
  function generateUserId() {
    const timestamp = new Date().getTime();
    const random = Math.floor(Math.random() * 10000);
    return `USER${timestamp}${random}`;
  }

  // Email/Password Signup
  document.getElementById('signup-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const email = document.getElementById('signup-email').value;
    const password = document.getElementById('signup-password').value;
    const username = document.getElementById('username').value;
    const firstName = document.getElementById('first-name').value;
    const lastName = document.getElementById('last-name').value;

    try {
      // Create user in Firebase Auth
      const userCredential = await firebase.auth().createUserWithEmailAndPassword(email, password);
      const user = userCredential.user;

      // Create user profile in Firestore
      const db = firebase.firestore();
      await db.collection('users').doc(user.uid).set({
        email: email,
        username: username,
        firstName: firstName,
        lastName: lastName,
        photoURL: 'img/default-avatar.png', // Default avatar
        createdAt: firebase.firestore.Timestamp.now()
      });

      // Update the user's display name in Firebase Auth
      await user.updateProfile({
        displayName: username
      });

      // Redirect to dashboard after successful signup
      window.location.href = 'dashboard.php';
    } catch (error) {
      console.error('Error:', error);
      document.getElementById('signup-error').textContent = error.message;
    }
  });

  // Google Signup/Login
  document.getElementById('google-signup-btn').addEventListener('click', function() {
    const provider = new firebase.auth.GoogleAuthProvider();
    const userId = generateUserId();

    firebase.auth().signInWithPopup(provider)
      .then((result) => {
        const user = result.user;
        const db = firebase.firestore();

        // Split displayName into first and last name if possible
        let firstName = "";
        let lastName = "";
        if (user.displayName) {
          const parts = user.displayName.split(" ");
          firstName = parts[0];
          lastName = parts.slice(1).join(" ");
        }

        // Use the part before @ in email as username
        let username = "";
        if (user.email) {
          username = user.email.split('@')[0];
        }

        // Use Google photoURL or default image
        let photoURL = user.photoURL ? user.photoURL : "img/default-image.jpg";

        return db.collection("users").doc(user.uid).set({
          userId: userId,
          firstName: firstName,
          lastName: lastName,
          username: username,
          email: user.email,
          photoURL: photoURL
        });
      })
      .then(() => {
        window.location.href = "dashboard.php";
      })
      .catch((error) => {
        document.getElementById('signup-error').textContent = error.message;
      });
  });
</script>

</body>
</html>
