<?php
  include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Podcasts - Anything Goes Tambayan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            min-height: 100vh;
        }
        .container {
            padding: 2rem;
            margin-top: 90px;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 2rem;
            align-items: start;
        }
        .user-sidebar {
            background: rgb(191, 223, 233);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            text-align: center;
            position: sticky;
            top: 90px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .user-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            border: 3px solid #f5f5f5;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .user-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: #222;
            margin-bottom: 0.5rem;
            width: 100%;
        }
        .user-role {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 2rem;
            width: 100%;
        }
        .upload-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: #1e3a8a;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            border: none;
            width: calc(100% - 3rem);
            font-size: 1rem;
            cursor: pointer;
            margin: 0 1.5rem;
        }
        .upload-button:hover {
            background: #1e40af;
            transform: translateY(-2px);
        }
        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #222;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .section-title i {
            color: #1e3a8a;
            font-size: 1.6rem;
        }
        .uploads-table {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
            border: 1px solid #eee;
        }
        .uploads-table-header {
            display: grid;
            grid-template-columns: 90px 220px 180px 120px 100px 120px auto;
            align-items: center;
            font-size: 0.95rem;
            font-weight: 600;
            color: #555;
            padding: 1rem;
            background: #f8f9fa;
            border-bottom: 1px solid #eee;
            gap: 0.75rem;
        }
        .uploads-table-header > div {
            padding: 0.5rem;
        }
        .uploaded-row {
            display: grid;
            grid-template-columns: 90px 220px 180px 120px 100px 120px auto;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #eee;
            transition: background 0.2s;
            gap: 0.75rem;
        }
        .uploaded-row:hover {
            background: #f8f9fa;
        }
        .uploaded-thumb {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            object-fit: cover;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            border: 1px solid #eee;
        }
        .uploaded-info {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .uploaded-title {
            font-size: 1rem;
            font-weight: 600;
            color: #222;
            line-height: 1.4;
        }
        .uploaded-desc {
            font-size: 0.9rem;
            color: #666;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .uploaded-category {
            text-align: center;
            font-size: 0.9rem;
            color: #555;
            background: #f3f4f6;
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            font-weight: 500;
        }
        .uploaded-listens {
            text-align: center;
            font-size: 0.95rem;
            color: #555;
            font-weight: 500;
        }
        .uploaded-ratings {
            text-align: center;
            color: #4f8cff;
            font-size: 1rem;
        }
        .delete-btn {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
            border-radius: 6px;
            padding: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            margin: 0 auto;
            width: 80px;
            display: block;
        }
        .delete-btn:hover {
            background: #dc2626;
            color: white;
            border-color: #dc2626;
            transform: translateY(-1px);
        }
        @media (max-width: 1024px) {
            .container { padding: 1rem; }
            .content-grid {
                grid-template-columns: 1fr;
            }
            .user-sidebar {
                order: -1;
                position: static;
            }
            .uploads-table-header, .uploaded-row {
                grid-template-columns: 80px 180px 130px 100px 90px 100px auto;
                padding: 0.75rem;
                gap: 0.5rem;
            }
        }
        @media (max-width: 768px) {
            .uploads-table-header {
                display: none;
            }
            .uploaded-row {
                display: flex;
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }
            .uploaded-thumb {
                margin: 0;
            }
            .uploaded-info {
                width: 100%;
            }
            .uploaded-category, .uploaded-listens, .uploaded-ratings {
                text-align: left;
                margin: 0.2rem 0;
            }
            .delete-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content-grid">
            <div>
                <div class="section-title">
                    <i class="fas fa-tasks"></i>
                    Manage Your Podcasts
                </div>
                <div class="uploads-table">
                    <div class="uploads-table-header">
                        <div>Thumbnail</div>
                        <div>Title</div>
                        <div>Description</div>
                        <div>Category</div>
                        <div>Listens</div>
                        <div>Rating</div>
                        <div>Actions</div>
                    </div>
                    <div id="uploads-list">
                        <!-- Podcasts will be loaded here -->
                    </div>
                </div>
            </div>
            <div class="user-sidebar">
                <div class="user-avatar">
                    <img src="<?php echo isset($_SESSION['photoURL']) ? $_SESSION['photoURL'] : 'img/default-avatar.png'; ?>" alt="Profile Picture">
                </div>
                <div class="user-name"><?php echo isset($_SESSION['displayName']) ? $_SESSION['displayName'] : 'User'; ?></div>
                <div class="user-role"><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></div>
                <a href="upload.php" class="upload-button">
                    <i class="fas fa-upload"></i>
                    Upload New Podcast
                </a>
            </div>
        </div>
    </div>

    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-auth.js"></script>
    <script src="../firebase-config.js"></script>
    
    <script>
        // Function to format numbers (e.g., 1.2k, 1.5M)
        function formatNumber(num) {
            if (num >= 1000000) return (num/1000000).toFixed(1) + 'M';
            if (num >= 1000) return (num/1000).toFixed(1) + 'k';
            return num.toString();
        }

        // Function to format rating stars
        function formatRating(rating) {
            const stars = [];
            const fullStars = Math.floor(rating);
            const hasHalfStar = rating % 1 >= 0.5;
            
            for (let i = 0; i < 5; i++) {
                if (i < fullStars) {
                    stars.push('<i class="fas fa-star"></i>');
                } else if (i === fullStars && hasHalfStar) {
                    stars.push('<i class="fas fa-star-half-alt"></i>');
                } else {
                    stars.push('<i class="far fa-star"></i>');
                }
            }
            
            return stars.join('');
        }

        // Function to delete a podcast
        async function deletePodcast(podcastId) {
            if (confirm('Are you sure you want to delete this podcast? This action cannot be undone.')) {
                try {
                    const db = firebase.firestore();
                    await db.collection('podcasts').doc(podcastId).delete();
                    alert('Podcast deleted successfully!');
                    loadPodcasts(); // Reload the list after deletion
                } catch (error) {
                    console.error('Error deleting podcast:', error);
                    alert('Error deleting podcast. Please try again.');
                }
            }
        }

        // Function to load user's podcasts
        async function loadPodcasts(userId) {
            const uploadsList = document.getElementById('uploads-list');
            uploadsList.innerHTML = '<div style="text-align: center; padding: 2rem;">Loading...</div>';

            try {
                const db = firebase.firestore();
                const snapshot = await db.collection('podcasts')
                    .where('userId', '==', userId)
                    .orderBy('createdAt', 'desc')
                    .get();

                if (snapshot.empty) {
                    uploadsList.innerHTML = `
                        <div style="text-align: center; padding: 2rem; color: #666;">
                            <h3>No podcasts yet</h3>
                            <p>Start creating your first podcast!</p>
                            <a href="upload.php" class="upload-button" style="display: inline-block; margin-top: 1rem; max-width: 200px;">
                                <i class="fas fa-upload"></i> Upload Your First Podcast
                            </a>
                        </div>`;
                    return;
                }

                let html = '';
                snapshot.forEach(doc => {
                    const data = doc.data();
                    const date = data.createdAt.toDate().toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric'
                    });

                    html += `
                        <div class="uploaded-row">
                            <img src="${data.imageURL || 'img/default-podcast.jpg'}" alt="${data.title}" class="uploaded-thumb">
                            <div class="uploaded-info">
                                <div class="uploaded-title">${data.title}</div>
                                <div style="color: #666; font-size: 0.9rem;"><i class="far fa-calendar"></i> ${date}</div>
                            </div>
                            <div class="uploaded-desc">${data.description || ''}</div>
                            <div class="uploaded-category">${data.category || 'Uncategorized'}</div>
                            <div class="uploaded-listens">
                                <i class="fas fa-headphones"></i> ${formatNumber(data.listenCount || 0)}
                            </div>
                            <div class="uploaded-ratings">
                                ${formatRating(data.averageRating || 0)}
                                <div style="font-size: 0.8rem; color: #666; margin-top: 4px;">
                                    ${data.averageRating ? data.averageRating.toFixed(1) : '0.0'} / 5.0
                                </div>
                            </div>
                            <button class="delete-btn" onclick="deletePodcast('${doc.id}')">Delete</button>
                        </div>
                    `;
                });

                uploadsList.innerHTML = html;
            } catch (error) {
                console.error('Error loading podcasts:', error);
                uploadsList.innerHTML = '<div style="text-align: center; padding: 2rem; color: #dc2626;">Error loading podcasts. Please try again later.</div>';
            }
        }

        // Initialize Firebase and load user data
        document.addEventListener('DOMContentLoaded', function() {
            firebase.auth().onAuthStateChanged(function(user) {
                if (user) {
                    // Get user data from Firestore
                    firebase.firestore().collection("users").doc(user.uid).get().then(function(doc) {
                        if (doc.exists) {
                            const data = doc.data();
                            // Update profile image
                            const profileImage = document.querySelector(".user-avatar img");
                            profileImage.src = data.photoURL || user.photoURL || "img/default-avatar.png";
                            
                            // Update username and email
                            document.querySelector(".user-name").textContent = data.username || user.displayName || "Username";
                            document.querySelector(".user-role").textContent = user.email || "";

                            // Load user's podcasts
                            loadPodcasts(user.uid);
                        } else {
                            // Create user document if it doesn't exist
                            firebase.firestore().collection("users").doc(user.uid).set({
                                email: user.email,
                                username: user.displayName || "Username",
                                photoURL: user.photoURL || "img/default-avatar.png",
                                createdAt: firebase.firestore.FieldValue.serverTimestamp()
                            }).then(() => {
                                loadPodcasts(user.uid);
                            });
                        }
                    }).catch(function(error) {
                        console.error("Error getting user data:", error);
                        document.querySelector(".user-name").textContent = "Error loading profile";
                    });
                } else {
                    window.location.href = 'login.php';
                }
            });
        });
    </script>
</body>
</html> 