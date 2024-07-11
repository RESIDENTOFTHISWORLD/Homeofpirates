// check ob user mit Tab Taste navigiert
function handleFirstTab(e) {
  if (e.keyCode === 9) { // keyCode === 9 = Tab Taste
    document.body.classList.add('userTab');
    window.removeEventListener('keydown', handleFirstTab);
  }
}
window.addEventListener('keydown', handleFirstTab);

// ***** Navigation *****
function openNav() {
  let navbar = document.getElementById('navbar');
  let content = document.querySelector('.content');
  let navbarSpace = document.querySelector('.navbarSpace');
  if (navbar.style.transform === "translateX(0px)") { // if nav already open -> function "closeNav"
  closeNav();
  }
  else {
    navbar.style.transform = "translateX(0px)"; // open Navbar
    content.style.transform = "translateX(250px)"; // move main content
    content.style.overflow = "hidden";
    navbarSpace.style.display = "block";
  }
}

function closeNav() {
  let navbar = document.getElementById('navbar');
  let content = document.querySelector('.content');
  let navbarSpace = document.querySelector('.navbarSpace');
  navbar.style.transform = "translateX(-250px)"; // move navbar back left
  content.style.transform = "translateX(0px)"; //
  content.style.overflow = "auto";
  navbarSpace.style.display = "none";
}

function showMore(toggleButton) {
  let content = toggleButton.nextElementSibling;
  if (content.style.maxHeight) { // if any value in content
    content.style.maxHeight = null; // overwrite value with "null"
    toggleButton.textContent = "ältere Einträge ↓";
  } else {
    content.style.maxHeight = content.scrollHeight + "px"; // if its closed, open to the needed hight
    toggleButton.textContent = "weniger anzeigen ↑";
  }
}
