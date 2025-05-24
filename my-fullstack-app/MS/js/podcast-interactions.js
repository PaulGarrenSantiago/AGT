// Function to increment listen count
async function incrementListenCount(podcastId) {
  try {
    const db = firebase.firestore();
    const podcastRef = db.collection('podcasts').doc(podcastId);
    
    // Use transaction to ensure atomic update
    await db.runTransaction(async (transaction) => {
      const doc = await transaction.get(podcastRef);
      if (!doc.exists) {
        throw new Error('Podcast does not exist!');
      }
      
      const newListenCount = (doc.data().listenCount || 0) + 1;
      transaction.update(podcastRef, { listenCount: newListenCount });
    });
    
    return true;
  } catch (error) {
    console.error('Error incrementing listen count:', error);
    return false;
  }
}

// Function to add or update a rating
async function ratePodcast(podcastId, userId, rating) {
  try {
    if (rating < 1 || rating > 5) {
      throw new Error('Rating must be between 1 and 5');
    }

    const db = firebase.firestore();
    const podcastRef = db.collection('podcasts').doc(podcastId);
    const userRatingRef = podcastRef.collection('ratings').doc(userId);

    // Use transaction to ensure atomic updates
    await db.runTransaction(async (transaction) => {
      const podcastDoc = await transaction.get(podcastRef);
      const userRatingDoc = await transaction.get(userRatingRef);

      if (!podcastDoc.exists) {
        throw new Error('Podcast does not exist!');
      }

      const podcastData = podcastDoc.data();
      const oldRating = userRatingDoc.exists ? userRatingDoc.data().rating : 0;
      
      // Calculate new rating totals
      const newTotalRating = (podcastData.totalRating || 0) - oldRating + rating;
      const newRatingCount = userRatingDoc.exists ? 
        podcastData.ratingCount : 
        (podcastData.ratingCount || 0) + 1;
      const newAverageRating = newTotalRating / newRatingCount;

      // Update the podcast document
      transaction.update(podcastRef, {
        totalRating: newTotalRating,
        ratingCount: newRatingCount,
        averageRating: newAverageRating
      });

      // Store the user's rating
      transaction.set(userRatingRef, {
        rating: rating,
        userId: userId,
        updatedAt: firebase.firestore.Timestamp.now()
      });
    });

    return true;
  } catch (error) {
    console.error('Error rating podcast:', error);
    return false;
  }
}

// Function to add a comment
async function addComment(podcastId, userId, comment) {
  try {
    const db = firebase.firestore();
    const podcastRef = db.collection('podcasts').doc(podcastId);
    
    // First get the user's information
    const userDoc = await db.collection('users').doc(userId).get();
    if (!userDoc.exists) {
      throw new Error('User not found');
    }
    
    const userData = userDoc.data();
    const username = userData.username || 'Anonymous';
    const userPhotoURL = userData.photoURL || 'img/default-avatar.png';

    // Add the comment to the comments subcollection
    await podcastRef.collection('comments').add({
      userId: userId,
      username: username,
      userPhotoURL: userPhotoURL,
      comment: comment,
      createdAt: firebase.firestore.Timestamp.now()
    });

    return true;
  } catch (error) {
    console.error('Error adding comment:', error);
    return false;
  }
}

// Function to get comments for a podcast
async function getComments(podcastId) {
  try {
    const db = firebase.firestore();
    const commentsRef = db.collection('podcasts').doc(podcastId).collection('comments');
    
    // Get comments ordered by creation time (most recent first)
    const snapshot = await commentsRef.orderBy('createdAt', 'desc').get();
    
    return snapshot.docs.map(doc => ({
      id: doc.id,
      ...doc.data(),
      createdAt: doc.data().createdAt.toDate() // Convert timestamp to Date
    }));
  } catch (error) {
    console.error('Error getting comments:', error);
    return [];
  }
}

// Function to get user's rating for a podcast
async function getUserRating(podcastId, userId) {
  try {
    const db = firebase.firestore();
    const ratingDoc = await db.collection('podcasts')
      .doc(podcastId)
      .collection('ratings')
      .doc(userId)
      .get();
    
    return ratingDoc.exists ? ratingDoc.data().rating : null;
  } catch (error) {
    console.error('Error getting user rating:', error);
    return null;
  }
} 