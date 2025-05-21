// Initialize Firebase using the global firebase object from the CDN scripts

const firebaseConfig = {
  apiKey: "AIzaSyCdAcwYEXvvImFJigYvHemdX-8yS8tgoR4",
  authDomain: "anything-goes-tambayan.firebaseapp.com", // <-- use your Firebase project's domain
  projectId: "anything-goes-tambayan",
  storageBucket: "anything-goes-tambayan.firebasestorage.app",
  messagingSenderId: "1035359032662",
  appId: "1:1035359032662:web:03ea03425fbe99e90fb2f7",
  measurementId: "G-32VD047H52"
};

// Only initialize if not already initialized
if (!firebase.apps.length) {
  firebase.initializeApp(firebaseConfig);
  if (firebase.analytics) {
    firebase.analytics();
  }
}