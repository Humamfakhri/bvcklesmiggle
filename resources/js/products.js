const cardPopup = document.querySelector('.cardPopup');
const cardPopupContent = document.querySelector('.cardPopupContent');
const closePopup = document.querySelector('.closePopup');
const cards = document.querySelectorAll('.card');

// ASAL
// const productName = document.querySelector('#productName');
// const productCategory = document.querySelector('#productCategory');

// TUJUAN
const productNameModal = document.querySelector('#productNameModal');
const productCategoryModal = document.querySelector('#productCategoryModal');
const productIssueModal = document.querySelector('#productIssueModal');
const productDetailsModal = document.querySelector('#productDetailsModal');
const linkShopeeModal = document.querySelector('#linkShopeeModal');
const linkTokopediaModal = document.querySelector('#linkTokopediaModal');

// CAROUSEL
const carousel = document.getElementById('carousel');
const prevButton = document.getElementById('prevButton');
const nextButton = document.getElementById('nextButton');
const dotsContainer = document.getElementById('dotsContainer');
const currentImage = document.getElementById('currentImage');
const totalImages = document.getElementById('totalImages');
let currentIndex = 0;
let images = [];

cards.forEach(card => {
  card.addEventListener('click', () => {
    currentIndex = 0;
    // Gantilah dengan ID yang sesuai
    const productId = card.querySelector('img').getAttribute('data-id');
    // console.log(card.querySelector('img').getAttribute('data-id'));


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
        console.log(Array.isArray(data.product_images));
        images = data.product_images; // Assuming the response contains an array of image URLs
        images = images.slice(1);
        console.log(images);

        const url = new URL(window.location.href); // Mengambil URL saat ini
        const domain = url.hostname; // Mengambil nama domain

        const fullDomain = `${url.protocol}//${url.hostname}`; // Menggabungkan protokol dan nama domain
        console.log(fullDomain);
        


        // Update total images count
        totalImages.textContent = images.length;
        if (images.length == 1) {
          nextButton.classList.add('hidden');
          prevButton.classList.add('hidden');
          dotsContainer.classList.add('hidden');
          dotsContainer.classList.remove('flexCenter');
        } else {
          nextButton.classList.remove('hidden');
          prevButton.classList.remove('hidden');
          dotsContainer.classList.remove('hidden');
          dotsContainer.classList.add('flexCenter');
        }

        // Clear existing content
        carousel.innerHTML = '';
        dotsContainer.innerHTML = '';

        // Add new images to carousel
        images.forEach((image, index) => {
          const imgDiv = document.createElement('div');
          imgDiv.className = 'w-full flexCenter flex-shrink-0';
          imgDiv.innerHTML = `<img src="${fullDomain}/storage/${image}" class="max-h-[400px] border border-black" alt="Product Image">`;
          carousel.appendChild(imgDiv);

          const dot = document.createElement('div');
          dot.className = 'dot w-3 h-3 rounded-full bg-gray-300';
          dotsContainer.appendChild(dot);
        });

        // Show modal
        updateCarouselPosition();

        productNameModal.innerHTML = `//${data.name}`;
        productCategoryModal.innerHTML = data.category;
        productCategoryModal.href = data.category;
        productIssueModal.innerHTML = data.issue;
        productDetailsModal.innerHTML = data.details;
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

// Update the carousel position and indicators
function updateCarouselPosition() {
  const offset = -currentIndex * 100;
  carousel.style.transform = `translateX(${offset}%)`;
  if (currentIndex == images.length - 1) {
    nextButton.classList.add('hidden')
  } else if (currentIndex == 0) {
    prevButton.classList.add('hidden')
  }
  else {
    nextButton.classList.remove('hidden')
    prevButton.classList.remove('hidden')
  }
  updateIndicators();
}

function updateIndicators() {
  const dots = dotsContainer.children;
  for (let i = 0; i < dots.length; i++) {
    dots[i].classList.toggle('bg-primary', i === currentIndex);
    dots[i].classList.toggle('bg-gray-300', i !== currentIndex);
  }
  currentImage.textContent = currentIndex + 1;
}

// Navigation buttons
prevButton.addEventListener('click', function () {
  if (currentIndex > 0) {
    currentIndex--;
    updateCarouselPosition();
  }
});

nextButton.addEventListener('click', function () {
  if (currentIndex < images.length - 1) {
    currentIndex++;
    updateCarouselPosition();
  }
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