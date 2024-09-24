// TRIX EDITOR
document.addEventListener('trix-file-accept', function (e) {
  e.preventDefault();
})

// ============================== ADD CATEGORY ============================== //
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
const closePopupCategorys = document.querySelectorAll('.closePopupCategory');
closePopupCategorys.forEach(closePopupCategory => {
  closePopupCategory.addEventListener('click', () => {
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
})

// ============================== VIEW COMMENT ARTICLE ============================== //
const viewCommentBtns = document.querySelectorAll('.viewCommentBtn');
const viewCommentModal = document.querySelector('.viewCommentModal');
const viewCommentModalContent = document.querySelector('.viewCommentModalContent');
viewCommentBtns.forEach(viewCommentBtn => {
  viewCommentBtn.addEventListener('click', () => {
    document.body.classList.add('overflow-hidden');
    viewCommentModal.classList.remove('opacity-0');
    viewCommentModal.classList.add('opacity-100');
    viewCommentModal.classList.add('bg-black/50');
    viewCommentModal.classList.remove('-z-10');
    viewCommentModal.classList.add('z-50');
    viewCommentModalContent.classList.add('scale-100');
    viewCommentModalContent.classList.remove('scale-0');
  });
})

viewCommentModal.addEventListener('click', () => {
  document.body.classList.remove('overflow-hidden');
  viewCommentModal.classList.remove('opacity-100');
  viewCommentModal.classList.remove('bg-black/50');
  viewCommentModal.classList.add('opacity-0');
  viewCommentModal.classList.remove('z-50');
  setTimeout(() => {
    viewCommentModal.classList.add('-z-10');
  }, 300);
  viewCommentModalContent.classList.add('scale-0');
  viewCommentModalContent.classList.remove('scale-100');
});


// ============================== EDIT ARTICLE ============================== //

const editBtns = document.querySelectorAll('.editBtn');
const editModal = document.querySelector('.editModal');
const editModalContent = document.querySelector('.editModalContent');

const editArticleForm = document.querySelector('#editArticleForm');
const inputTitleEdit = document.querySelector('#titleEdit');
const inputAuthorEdit = document.querySelector('#authorEdit');
const inputCategoryEdit = document.querySelector('#categoryEdit');
const inputArticleImageEdit = document.querySelector('#articleImageEdit');
const inputBodyEdit = document.querySelector('#bodyEditTrix');
  
editBtns.forEach(editBtn => {
  const tr = editBtn.parentElement.parentElement.parentElement.parentElement.parentElement
  editBtn.addEventListener('click', () => {
    const rowId = tr.querySelector('#rowId').value;
    const rowTitle = tr.querySelector('#rowTitle').innerHTML;
    const rowAuthor = tr.querySelector('#rowAuthor').innerHTML;
    const rowCategory = tr.querySelector('#rowCategory').innerHTML;
    const rowArticleImages = tr.querySelector('.rowArticleImage');
    const rowBody = tr.querySelector('#rowBody').innerHTML;
    console.log(rowBody);
    

    editArticleForm.action = "/sipalingadminB$/articles/" + rowId;

    document.body.classList.add('overflow-hidden');
    editModal.classList.remove('opacity-0');
    editModal.classList.add('opacity-100');
    editModal.classList.add('bg-black/50');
    editModal.classList.remove('-z-10');
    editModal.classList.add('z-50');
    editModalContent.classList.add('scale-100');
    editModalContent.classList.remove('scale-0');

    console.log('#rowTitle');
    inputTitleEdit.value = rowTitle;

    console.log('#rowAuthor');
    inputAuthorEdit.value = rowAuthor;

    console.log('#rowCategory');
    inputCategoryEdit.value = rowCategory;

    console.log('#rowBody');
    inputBodyEdit.value = rowBody;
  });
});

editModal.addEventListener('click', () => {
  document.body.classList.remove('overflow-hidden');
  editModal.classList.remove('opacity-100');
  editModal.classList.remove('bg-black/50');
  editModal.classList.add('opacity-0');
  editModal.classList.remove('z-50');
  setTimeout(() => {
    editModal.classList.add('-z-10');
  }, 300);
  editModalContent.classList.add('scale-0');
  editModalContent.classList.remove('scale-100');
});

const closePopupArticles = document.querySelectorAll('.closePopupArticle');
closePopupArticles.forEach(closePopupArticle => {
  closePopupArticle.addEventListener('click', () => {
    document.body.classList.remove('overflow-hidden');
    editModal.classList.remove('opacity-100');
    editModal.classList.remove('bg-black/50');
    editModal.classList.add('opacity-0');
    editModal.classList.remove('z-50');
    setTimeout(() => {
      editModal.classList.add('-z-10');
    }, 300);
    editModalContent.classList.add('scale-0');
    editModalContent.classList.remove('scale-100');
  });
})

// function clearEditFields() {
//   inputNameEdit.value = "";
//   inputCategoryEdit.value = "";
//   if (detailImagePreviewEdit.querySelector('img')) {
//     detailImagePreviewEdit.querySelector('img').remove();
//   }
//   while (productImagesPreviewEdit.querySelector('img')) {
//     productImagesPreviewEdit.querySelector('img').remove();
//   }
// }