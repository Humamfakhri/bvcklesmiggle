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

// POPUP PROFILE
if (document.querySelector('#profileBtnMobile')) {
  const profileBtn = document.querySelector('#profileBtnMobile');
  const profileModal = document.querySelector('#profileModalMobile');
  profileBtn.addEventListener('click', () => {
    profileModal.classList.toggle('scale-100');
  })

  // Close modal when clicking outside the modal content
  document.addEventListener('click', (event) => {
    if (!profileModal.contains(event.target) && !profileBtn.contains(event.target)) {
      profileModal.classList.remove('scale-100');
      profileModal.classList.add('scale-0');
    }
  });
}
