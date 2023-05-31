// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyCh5o1g3i_i0cGN5Lr1zNDUbMhDJUZsm4E",
  authDomain: "topnotchtransit-demo.firebaseapp.com",
  projectId: "topnotchtransit-demo",
  storageBucket: "topnotchtransit-demo.appspot.com",
  messagingSenderId: "518214964263",
  appId: "1:518214964263:web:81bf2206c2fb53aa8f2a02",
  measurementId: "G-Z3B88ZFFN1"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);