const header = document.getElementById("header");
window.addEventListener("scroll", function () {
  if (window.scrollY > 0) {
    header.classList.add("bg-dark");
  } else {
    header.classList.remove("bg-dark");
  }
});

const toggleNavbar = document.querySelector('.toggleNavbar');
const navbarContent = document.querySelector('.navbar-content');
const barIcon = document.querySelector('.barIcon');
const xIcon = document.querySelector('.xIcon');
toggleNavbar.onclick = function () {
  navbarContent.classList.toggle("h-0");
  navbarContent.classList.toggle("h-[262px]");
  navbarContent.classList.toggle("border-t-2");
  if (navbarContent.classList.contains("h-[262px]")) {
    header.classList.add("bg-dark");
  } else {
    header.classList.remove("bg-dark");
  }
  barIcon.classList.toggle("hidden");
  xIcon.classList.toggle("hidden");
  barIcon.classList.toggle("flexCenter");
  xIcon.classList.toggle("flexCenter");
};
