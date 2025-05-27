// Function to create star rating HTML
function createStarRating(rating, isInteractive = false, onRatingChange = null) {
  const container = document.createElement('div');
  container.className = 'star-rating';
  
  for (let i = 1; i <= 5; i++) {
    const star = document.createElement('i');
    star.className = `fas fa-star ${i <= rating ? 'active' : ''}`;
    
    if (isInteractive) {
      star.style.cursor = 'pointer';
      star.addEventListener('click', () => onRatingChange && onRatingChange(i));
    }
    
    container.appendChild(star);
  }
  
  return container;
}

// Function to create comment form
function createCommentForm(onSubmit) {
  const form = document.createElement('form');
  form.className = 'comment-form';
  
  const textarea = document.createElement('textarea');
  textarea.placeholder = 'Write a comment...';
  textarea.required = true;
  
  const button = document.createElement('button');
  button.type = 'submit';
  button.textContent = 'Post Comment';
  
  form.appendChild(textarea);
  form.appendChild(button);
  
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    onSubmit && onSubmit(textarea.value);
    textarea.value = '';
  });
  
  return form;
}

// Function to create comment element
function createCommentElement(comment) {
  const container = document.createElement('div');
  container.className = 'comment';
  
  const header = document.createElement('div');
  header.className = 'comment-header';
  
  const userAvatar = document.createElement('img');
  userAvatar.className = 'comment-user-avatar';
  userAvatar.src = comment.userPhotoURL || 'img/default-avatar.png';
  userAvatar.alt = comment.username;
  
  const username = document.createElement('span');
  username.className = 'comment-user-name';
  username.textContent = comment.username;
  
  const time = document.createElement('span');
  time.className = 'comment-time';
  time.textContent = new Date(comment.createdAt).toLocaleString();
  
  const content = document.createElement('div');
  content.className = 'comment-content';
  content.textContent = comment.comment;
  
  header.appendChild(userAvatar);
  header.appendChild(username);
  header.appendChild(time);
  container.appendChild(header);
  container.appendChild(content);
  
  return container;
}

// Function to initialize podcast interaction UI
async function initPodcastInteractions(podcastId, container) {
  const user = firebase.auth().currentUser;
  if (!user) return;

  // Create container for ratings
  const ratingContainer = document.createElement('div');
  ratingContainer.className = 'podcast-rating';
  
  // Get current user's rating
  const userRating = await getUserRating(podcastId, user.uid);
  
  // Create star rating UI
  const starRating = createStarRating(userRating || 0, true, async (newRating) => {
    const success = await ratePodcast(podcastId, user.uid, newRating);
    if (success) {
      // Update the UI
      const stars = starRating.querySelectorAll('.fa-star');
      stars.forEach((star, index) => {
        star.classList.toggle('active', index < newRating);
      });
      
      // Update the rating display in the podcast meta section
      const ratingSpan = document.querySelector('.podcast-meta span:last-child');
      if (ratingSpan) {
        const podcastDoc = await firebase.firestore().collection('podcasts').doc(podcastId).get();
        const data = podcastDoc.data();
        ratingSpan.textContent = `${data.averageRating.toFixed(1)} ★ (${data.ratingCount})`;
      }
    }
  });
  
  ratingContainer.appendChild(starRating);
  
  // Create comments section
  const commentsSection = document.createElement('div');
  commentsSection.className = 'comments-section';
  
  const commentsTitle = document.createElement('h3');
  commentsTitle.textContent = 'Comments';
  
  const commentForm = createCommentForm(async (comment) => {
    const success = await addComment(podcastId, user.uid, comment);
    if (success) {
      // Refresh comments
      await loadComments();
    }
  });
  
  const commentsContainer = document.createElement('div');
  commentsContainer.className = 'comments-container';
  
  async function loadComments() {
    const comments = await getComments(podcastId);
    commentsContainer.innerHTML = '';
    comments.forEach(comment => {
      commentsContainer.appendChild(createCommentElement(comment));
    });
  }
  
  commentsSection.appendChild(commentsTitle);
  commentsSection.appendChild(commentForm);
  commentsSection.appendChild(commentsContainer);
  
  // Add everything to the main container
  container.appendChild(ratingContainer);
  container.appendChild(commentsSection);
  
  // Load initial comments
  await loadComments();
  
  // Increment listen count when audio starts playing
  const audioElement = container.querySelector('audio');
  if (audioElement) {
    let hasStartedPlaying = false;
    audioElement.addEventListener('play', async () => {
      if (!hasStartedPlaying) {
        await incrementListenCount(podcastId);
        hasStartedPlaying = true;
      }
    });
  }
} 