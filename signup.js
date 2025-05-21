// After user.updateProfile(...)
const db = firebase.firestore();
db.collection("users").doc(user.uid).set({
  firstName: firstName,
  lastName: lastName,
  username: username,
  email: email
});