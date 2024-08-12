const cardPopup = document.querySelector('.cardPopup');
const cardPopupContent = document.querySelector('.cardPopupContent');
const closePopup = document.querySelector('.closePopup');
const cards = document.querySelectorAll('.card');
cards.forEach(card => {
  card.addEventListener('click', () => {
    document.body.classList.add('overflow-hidden');
    cardPopup.classList.remove('opacity-0');
    cardPopup.classList.add('opacity-100');
    cardPopup.classList.add('bg-black/50');
    cardPopup.classList.remove('-z-10');
    cardPopup.classList.add('z-50');
    cardPopupContent.classList.add('scale-100');
    cardPopupContent.classList.remove('scale-0');
  });
});
closePopup.addEventListener('click', () => {
  document.body.classList.remove('overflow-hidden');
  cardPopup.classList.remove('opacity-100');
  cardPopup.classList.remove('bg-black/50');
  cardPopup.classList.add('opacity-0');
  cardPopup.classList.remove('z-50');
  setTimeout(() => {
    cardPopup.classList.add('-z-10');
  }, 300);
  cardPopupContent.classList.add('scale-0');
  cardPopupContent.classList.remove('scale-100');
});
cardPopup.addEventListener('click', () => {
  document.body.classList.remove('overflow-hidden');
  cardPopup.classList.remove('opacity-100');
  cardPopup.classList.remove('bg-black/50');
  cardPopup.classList.add('opacity-0');
  cardPopup.classList.remove('z-50');
  setTimeout(() => {
    cardPopup.classList.add('-z-10');
  }, 300);
  cardPopupContent.classList.add('scale-0');
  cardPopupContent.classList.remove('scale-100');
});

if (document.querySelector('.categoryBtn')) {
  const categoryBtn = document.querySelector('.categoryBtn');
  const categoryChevron = document.querySelector('.categoryChevron');
  const categoryContainer = document.querySelector('.categoryContainer');
  categoryBtn.addEventListener('click', () => {
    categoryChevron.classList.toggle('-rotate-180');
    categoryContainer.classList.toggle('h-0');
    categoryContainer.classList.toggle("h-[316px]");
  });
}