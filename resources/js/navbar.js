window.addEventListener("scroll", function () {
  const header = document.getElementById("navbar");
  const navBg = header.querySelector(".navBg");
  const navContent = header.querySelector(".navContent");
  let windowPosition = window.scrollY > 0;
  if (window.scrollY > 83) {
    // header.classList.add("nav-scrolled", windowPosition);
    header.classList.add("nav-scrolled", windowPosition);
    navBg.classList.add("bg-dark");
    navBg.classList.add("border-y-2");
    navBg.classList.add("border-gray-200");
    navContent.classList.remove("border-gray-200");
    navContent.classList.remove("border-y-2");
    // border-y-2 border-gray-200
  } else {
    // header.classList.remove("nav-scrolled", windowPosition);
    navBg.classList.remove("bg-dark");
    navBg.classList.remove("border-y-2");
    navBg.classList.remove("border-gray-200");
    navContent.classList.add("border-gray-200");
    navContent.classList.add("border-y-2");
  }
});