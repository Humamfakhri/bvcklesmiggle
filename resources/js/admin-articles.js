// TRIX EDITOR
document.addEventListener('trix-file-accept', function (e) {
  e.preventDefault();
})

// CATEGORY
// const categoryBtn = document.querySelector('.categoryBtn');
// const categoryChevron = document.querySelector('.categoryChevron');
// const categoryContainer = document.querySelector('.categoryContainer');
// categoryBtn.addEventListener('click', () => {
//   categoryChevron.classList.toggle('-rotate-180');
//   categoryContainer.classList.toggle('h-0');
//   categoryContainer.classList.toggle("h-[316px]");
// });

const addCategoryBtn = document.querySelector('#addCategoryBtn');
const addCategoryModal = document.querySelector('.addCategoryModal');
const addCategoryModalContent = document.querySelector('.addCategoryModalContent');
addCategoryBtn.addEventListener('click', () => {
  if (document.querySelector('#name').value) {
    saveAddCategoryBtn.removeAttribute('disabled');
  } else {
    saveAddCategoryBtn.setAttribute('disabled', true);
  }

  document.body.classList.add('overflow-hidden');
  addCategoryModal.classList.remove('opacity-0');
  addCategoryModal.classList.add('opacity-100');
  addCategoryModal.classList.add('bg-black/50');
  addCategoryModal.classList.remove('-z-10');
  addCategoryModal.classList.add('z-50');
  addCategoryModalContent.classList.add('scale-100');
  addCategoryModalContent.classList.remove('scale-0');
});

addCategoryModal.addEventListener('click', () => {
  document.body.classList.remove('overflow-hidden');
  addCategoryModal.classList.remove('opacity-100');
  addCategoryModal.classList.remove('bg-black/50');
  addCategoryModal.classList.add('opacity-0');
  addCategoryModal.classList.remove('z-50');
  setTimeout(() => {
    addCategoryModal.classList.add('-z-10');
  }, 300);
  addCategoryModalContent.classList.add('scale-0');
  addCategoryModalContent.classList.remove('scale-100');
});

const inputName = document.querySelector('#name');
const closePopups = document.querySelectorAll('.closePopup');
closePopups.forEach(closePopup => {
  closePopup.addEventListener('click', () => {
    inputName.value = "";
    document.body.classList.remove('overflow-hidden');
    addCategoryModal.classList.remove('opacity-100');
    addCategoryModal.classList.remove('bg-black/50');
    addCategoryModal.classList.add('opacity-0');
    addCategoryModal.classList.remove('z-50');
    setTimeout(() => {
      addCategoryModal.classList.add('-z-10');
    }, 300);
    addCategoryModalContent.classList.add('scale-0');
    addCategoryModalContent.classList.remove('scale-100');
  });
});