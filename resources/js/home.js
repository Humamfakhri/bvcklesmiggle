const backToTopBtn = document.querySelector(".backToTopBtn");
backToTopBtn.onclick = function () {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
};