<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
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
      width: 130%;
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
</head>
<!-- Add Firebase SDKs -->
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-auth-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore-compat.js"></script>
<script src="../firebase-config.js"></script>
<body>
  <div class="container">
    <div class="left">
      <div class="image-container">
        <img src="img/dashh.png" alt="Image" />
      </div>
    </div>
    <div class="right">
      <form id="login-form">
        <h2>Login</h2>
        <input type="email" id="login-email" placeholder="Email Address" required />
        <input type="password" id="login-password" placeholder="Password" required />
        <label><input type="checkbox" /> Remember Me</label>
        
        <!-- Social Login Buttons Side by Side -->
        <div style="display:flex; gap:10px; margin-bottom:1rem;">
          <button type="button" id="google-login-btn" style="flex:1;background:#fff;color:#444;border:1px solid #ccc;padding:0.6rem 1.2rem;border-radius:4px;display:flex;align-items:center;justify-content:center;gap:8px;cursor:pointer;">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" style="width:20px;height:20px;"> Login with Google
          </button>
          <button type="button" style="flex:1;background:#000;color:#fff;border:1px solid #000;padding:0.6rem 1.2rem;border-radius:4px;display:flex;align-items:center;justify-content:center;gap:8px;cursor:pointer;">
            <img src="https://www.svgrepo.com/show/303128/apple-logo.svg" alt="Apple" style="width:20px;height:20px;filter:invert(1);"> Login with Apple
          </button>
        </div>

        <button type="submit" class="button">Log In</button>
        <div id="login-error" style="color:red; margin-top:1rem; text-align:center;"></div>
        <hr>
        <p>No account yet? <a href="signup.php">Sign Up</a></p>
      </form>
    </div>
  </div>
  <script>
    // Email/Password Login
    document.getElementById('login-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const email = document.getElementById('login-email').value;
      const password = document.getElementById('login-password').value;
      firebase.auth().signInWithEmailAndPassword(email, password)
        .then((userCredential) => {
          // Redirect to dashboard on success
          window.location.href = "dashboard.php";
        })
        .catch((error) => {
          document.getElementById('login-error').textContent = error.message;
        });
    });

    // Google Login
    document.getElementById('google-login-btn').addEventListener('click', function() {
      const provider = new firebase.auth.GoogleAuthProvider();
      firebase.auth().signInWithPopup(provider)
        .then((result) => {
          const user = result.user;
          const db = firebase.firestore();
          // Check if user profile exists in Firestore
          return db.collection("users").doc(user.uid).get().then((doc) => {
            if (!doc.exists) {
              // Prompt for username if not set
              const username = prompt("Please enter a username:");
              let firstName = "";
              let lastName = "";
              if (user.displayName) {
                const parts = user.displayName.split(" ");
                firstName = parts[0];
                lastName = parts.slice(1).join(" ");
              }
              // Save profile to Firestore
              return db.collection("users").doc(user.uid).set({
                firstName: firstName,
                lastName: lastName,
                username: username,
                email: user.email
              });
            }
          });
        })
        .then(() => {
          window.location.href = "dashboard.php";
        })
        .catch((error) => {
          document.getElementById('login-error').textContent = error.message;
        });
    });
  </script>
</body>
</html>
