// loading.js

document.addEventListener("DOMContentLoaded", function () {
  // Show the loading screen
  const loadingScreen = document.querySelector(".loading-screen");

  setTimeout(() => {
    // Hide the loading screen after 3 seconds
    loadingScreen.style.display = "none";
    // Show the actual content
    document.body.style.overflow = "auto";
  }, 2000);
});
