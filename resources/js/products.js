const cardPopup = document.querySelector('.cardPopup');
const cardPopupContent = document.querySelector('.cardPopupContent');
const closePopup = document.querySelector('.closePopup');
const cards = document.querySelectorAll('.card');

// ASAL
const productName = document.querySelector('#productName');
const productCategory = document.querySelector('#productCategory');

// TUJUAN
const productNameModal = document.querySelector('#productNameModal');
const productCategoryModal = document.querySelector('#productCategoryModal');
const linkShopeeModal = document.querySelector('#linkShopeeModal');
const linkTokopediaModal = document.querySelector('#linkTokopediaModal');

cards.forEach(card => {
  card.addEventListener('click', () => {
    // Gantilah dengan ID yang sesuai
    const productId = 1; // Misalnya, ID produk yang ingin Anda ambil

    // Tampilkan loading spinner
    const loadingSpinner = document.getElementById('loadingSpinner');
    const cardPopupBody = document.getElementById('cardPopupBody');
    loadingSpinner.style.display = 'flex';
    cardPopupBody.style.display = 'none'; 

    // Fetch data
    fetch(`/get-product?id=${productId}`)
        .then(response => response.json())
        .then(data => {
            // Sembunyikan loading spinner dan tampilkan detail produk
            loadingSpinner.style.display = 'none';
            cardPopupBody.style.display = 'block';

            productNameModal.textContent = data.name;
            productCategoryModal.textContent = data.category;
            linkShopeeModal.href = data.link_shopee;
            linkTokopediaModal.href = data.link_tokopedia;
        })
        .catch(error => {
            console.error('Error:', error);
            // Sembunyikan loading spinner dan tampilkan pesan error
            loadingSpinner.style.display = 'none';
            cardPopupBody.innerHTML = `<p>Error loading product details.</p>`;
        });

    // fetch(`/get-product?id=${productId}`)
    //   .then(response => response.json())
    //   .then(data => {
    //     console.log(data.name);
    //     productNameModal.textContent = data.name;
    //   })
    //   .catch(error => {
    //     console.error('Error fetching product name:', error);
    //   });

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