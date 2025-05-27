const admin = require("firebase-admin");
const serviceAccount = require("../firebase-key.json");

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount)
});

const db = admin.firestore();

async function addViewCountToAll() {
  const snapshot = await db.collection("podcasts").get();
  const batch = db.batch();
  snapshot.forEach(doc => {
    const data = doc.data();
    if (typeof data.viewCount !== "number") {
      batch.update(doc.ref, { viewCount: 0 });
    }
  });
  await batch.commit();
  console.log("Added viewCount to all podcast documents!");
}

addViewCountToAll();