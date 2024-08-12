document.addEventListener("DOMContentLoaded", function() {
  const partnershipFeatures = document.querySelector(".partnershipFeatures");
  const sponsors = document.querySelector(".sponsors");
  const sponsorsTitle = document.querySelector(".sponsorsTitle");
  const height = (partnershipFeatures.clientHeight - sponsorsTitle.clientHeight).toString()
  console.log(height);
  //   MOBILE ABLE
  //   sponsors.classList.add('lg:max-h-[' + height + 'px]');
  //   sponsors.classList.add('lg:max-h-[496px]');
  //   DESKTOP
  sponsors.style.maxHeight = (partnershipFeatures.clientHeight - sponsorsTitle.clientHeight) + 'px';
});