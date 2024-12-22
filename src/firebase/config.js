//* Import the functions you need from the SDKs you need
import { initializeApp, getApps } from 'firebase/app';
import { getAuth, setPersistence, browserLocalPersistence } from 'firebase/auth';

//* Add the Web App's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyDxPEeMNnfAI1wkLQ1EfVaq6Amv1kq6XCI",
  authDomain: "uiicoin.firebaseapp.com",
  projectId: "uiicoin",
  storageBucket: "uiicoin.firebasestorage.app",
  messagingSenderId: "883473019172",
  appId: "1:883473019172:web:0c3b1eb75b049c7df5c3b1",
  measurementId: "G-RLMRK7EQHJ",
};

//* Initialize Firebase
let firebase_app = getApps().length === 0 ? initializeApp(firebaseConfig) : getApps()[0];

//* Initialize Firebase Auth and set persistence
const auth = getAuth(firebase_app);
setPersistence(auth, browserLocalPersistence)
  .then(() => {
    console.log("Session persistence set to LOCAL");
  })
  .catch((error) => {
    console.error("Failed to set session persistence:", error);
  });

export { auth };
export default firebase_app;
