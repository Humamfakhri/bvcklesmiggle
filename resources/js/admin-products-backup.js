// ============================== ADD ============================== //
const addModal = document.querySelector('.addModal');
const addModalContent = document.querySelector('.addModalContent');
const addProductBtn = document.querySelector('#addProductBtn');

const inputName = document.querySelector('#name');
const inputCategory = document.querySelector('#category');
const inputLinkShopee = document.querySelector('#linkShopee');
const inputLinkTokopedia = document.querySelector('#linkTokopedia');
const inputProductImage = document.querySelector('#productImage');
// const inputDetailImage = document.querySelector('#detailImage');
const productImagesPreview = document.querySelector('#productImagesPreview');
// const detailImagePreview = document.querySelector('#detailImagePreview');

addProductBtn.addEventListener('click', () => {
  document.body.classList.add('overflow-hidden');
  addModal.classList.remove('opacity-0');
  addModal.classList.add('opacity-100');
  addModal.classList.add('bg-black/50');
  addModal.classList.remove('-z-10');
  addModal.classList.add('z-50');
  addModalContent.classList.add('scale-100');
  addModalContent.classList.remove('scale-0');
});

addModal.addEventListener('click', () => {
  document.body.classList.remove('overflow-hidden');
  addModal.classList.remove('opacity-100');
  addModal.classList.remove('bg-black/50');
  addModal.classList.add('opacity-0');
  addModal.classList.remove('z-50');
  setTimeout(() => {
    addModal.classList.add('-z-10');
  }, 300);
  addModalContent.classList.add('scale-0');
  addModalContent.classList.remove('scale-100');
});


// ============================== EDIT ============================== //
const editBtns = document.querySelectorAll('.editBtn');
const editModal = document.querySelector('.editModal');
const editModalContent = document.querySelector('.editModalContent');

const editProductForm = document.querySelector('#editProductForm');
const inputNameEdit = document.querySelector('#nameEdit');
const inputCategoryEdit = document.querySelector('#categoryEdit');
const inputLinkShopeeEdit = document.querySelector('#linkShopeeEdit');
const inputLinkTokopediaEdit = document.querySelector('#linkTokopediaEdit');
const inputProductImageEdit = document.querySelector('#productImageEdit');
// const inputDetailImageEdit = document.querySelector('#detailImageEdit');
const productImagesPreviewEdit = document.querySelector('#productImagesPreviewEdit');
// // const detailImagePreviewEdit = document.querySelector('#detailImagePreviewEdit');

editBtns.forEach(editBtn => {
  const tr = editBtn.parentElement.parentElement.parentElement.parentElement.parentElement
  editBtn.addEventListener('click', () => {
    const rowId = tr.querySelector('#rowId').value;
    const rowName = tr.querySelector('#rowName').innerHTML;
    const rowCategory = tr.querySelector('#rowCategory').innerHTML;
    const rowProductImages = tr.querySelectorAll('.rowProductImage');
    // const rowDetailImage = tr.querySelector('#rowDetailImage').src;
    const rowLinkShopee = tr.querySelector('#rowLinkShopee').href;
    const rowLinkTokopedia = tr.querySelector('#rowLinkTokopedia').href;

    editProductForm.action = "/sipalingadminB$/products/" + rowId;

    clearEditFields();
    document.body.classList.add('overflow-hidden');
    editModal.classList.remove('opacity-0');
    editModal.classList.add('opacity-100');
    editModal.classList.add('bg-black/50');
    editModal.classList.remove('-z-10');
    editModal.classList.add('z-50');
    editModalContent.classList.add('scale-100');
    editModalContent.classList.remove('scale-0');

    // console.log('#rowName');
    // console.log(rowName);
    inputNameEdit.value = rowName;

    // console.log('#rowCategory');
    // console.log(rowCategory);
    inputCategoryEdit.value = rowCategory;

    // console.log('.rowProductImage');
    rowProductImages.forEach(rowProductImage => {
      // console.log(rowProductImage.src);
      const tagImgProduct = document.createElement('img');
      tagImgProduct.src = rowProductImage.src;
      // console.log(tagImgProduct.src);
      tagImgProduct.classList.add('mt-3');
      tagImgProduct.classList.add('img-fluid');
      tagImgProduct.classList.add('border');
      tagImgProduct.classList.add('border-gray-200');
      tagImgProduct.style.maxWidth = '100%';
      // console.log(productImagesPreviewEdit);
      productImagesPreviewEdit.appendChild(tagImgProduct);
    })

    // console.log('#rowDetailImage');
    // console.log(rowDetailImage);
    // const tagImgDetail = document.createElement('img');
    // tagImgDetail.src = rowDetailImage;
    // tagImgDetail.classList.add('mt-3');
    // tagImgDetail.classList.add('img-fluid');
    // tagImgDetail.classList.add('border');
    // tagImgDetail.classList.add('border-gray-200');
    // tagImgDetail.style.maxWidth = '100%';
    // detailImagePreviewEdit.appendChild(tagImgDetail);

    // console.log('#rowLinkShopee');
    // console.log(rowLinkShopee);
    inputLinkShopeeEdit.value = rowLinkShopee;

    // console.log('#rowLinkTokopedia');
    // console.log(rowLinkTokopedia);
    inputLinkTokopediaEdit.value = rowLinkTokopedia;
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


// ============================== CLOSE ============================== //
const closePopups = document.querySelectorAll('.closePopup');
closePopups.forEach(closePopup => {
  closePopup.addEventListener('click', () => {
    document.body.classList.remove('overflow-hidden');

    if (addModal) {
      clearAddFields();
      addModal.classList.remove('opacity-100');
      addModal.classList.remove('bg-black/50');
      addModal.classList.add('opacity-0');
      addModal.classList.remove('z-50');
      setTimeout(() => {
        addModal.classList.add('-z-10');
      }, 300);
      addModalContent.classList.add('scale-0');
      addModalContent.classList.remove('scale-100');
    }

    if (editModal) {
      clearEditFields();
      editModal.classList.remove('opacity-100');
      editModal.classList.remove('bg-black/50');
      editModal.classList.add('opacity-0');
      editModal.classList.remove('z-50');
      setTimeout(() => {
        editModal.classList.add('-z-10');
      }, 300);
      editModalContent.classList.add('scale-0');
      editModalContent.classList.remove('scale-100');
    }
  });

});

function clearAddFields() {
  inputName.value = "";
  inputCategory.value = "";
  inputLinkShopee.value = "";
  inputLinkTokopedia.value = "";
  // inputDetailImage.value = "";
  inputProductImage.value = "";
  // if (detailImagePreview.querySelector('img')) {
    // detailImagePreview.querySelector('img').remove();
  // }
  while (productImagesPreview.querySelector('img')) {
    productImagesPreview.querySelector('img').remove();
  }
}
function clearEditFields() {
  inputNameEdit.value = "";
  inputCategoryEdit.value = "";
  inputLinkShopeeEdit.value = "";
  inputLinkTokopediaEdit.value = "";
  inputProductImageEdit.value = "";
  // inputDetailImageEdit.value = "";
  // if (detailImagePreviewEdit.querySelector('img')) {
    // detailImagePreviewEdit.querySelector('img').remove();
  // }
  while (productImagesPreviewEdit.querySelector('img')) {
    productImagesPreviewEdit.querySelector('img').remove();
  }
}