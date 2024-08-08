<x-layout>
    <main class="max-container padding-container">
        {{-- <div class="cardPopup fixed inset-0 flex transition-opacity items-center justify-center bg-black/50"> --}}
        <div class="cardPopup fixed inset-0 flex opacity-100 -z-10 transition-opacity items-center justify-center">
            {{-- <div class="cardPopupContent transition ease-in-out duration-300 bg-white border-2 border-black w-[85%] max-h-[80%] p-3 mt-12" onclick="event.stopPropagation()"> --}}
            <div class="cardPopupContent transition ease-in-out duration-300 scale-0 bg-white border-2 border-black max-w-[85%] p-3" onclick="event.stopPropagation()">
                <div class="card-popup-header text-end border-b-2 border-black">
                    <button>
                        <i class="closePopup text-3xl text-black fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="card-popup-body">
                    <div class="grid grid-cols-10 items-end gap-4 mt-3">
                        <div class="col-end-11 col-span-3 border-b-2 border-black py-2">
                            <h1 class="font-bold text-2xl text-black font-segoe">//BLCK RUBY</h1>
                        </div>
                    </div>
                    <div class="grid grid-cols-10 gap-4">
                        <div id="product-image" class="col-span-7">
                            <div class="grid grid-cols-2 gap-4">
                                <img src="img/blckruby2.jpg" alt="" class="img-fluid border border-black">
                                <img src="img/blckruby3.jpg" alt="" class="img-fluid border border-black">
                            </div>
                        </div>
                        <div id="product-info" class="col-span-3 flex flex-col">
                            <div id="product-category">
                                <small class="block border-b border-black py-1 font-bold font-segoe">HandWear/<span
                                        class="color-primary">Armlet</span></small>
                            </div>
                            <div id="product-issue">
                                <small class="block font-bold mt-2">Issue #01</small>
                                <small class="block">"Never goin old"</small>
                                <small class="block">Year: 2024</small>
                                <small class="block">Collaborative:
                                    <a href="#" class="inline-flex items-start color-primary gap-1">
                                        StudsAddictive
                                        <i class="fa-solid fa-arrow-up-right-from-square color-primary text-[10px]"></i>
                                    </a>
                                </small>
                            </div>
                            <div id="product-details" class="grow overflow-auto">
                                <hr class="border-t-1 border-black border-dashed mt-2">
                                <small class="block font-bold mt-2">Details</small>
                                <small class="block">"Never goin old"</small>
                            </div>
                            <div id="product-footer">
                                <hr class="border-t-1 border-black border-dashed mt-2">
                                <div class="leading-none my-2">
                                    <small class="text-[10px] font-bold">All "Limited BvckleSmiggle Equipment" will be forever not be
                                        reproduced once it is sold out. Grab it fast!</small>
                                </div>
                                <div class="flex items-center justify-end gap-3">
                                    <small class="font-bold border-t border-[#ff00ff]">Order<br>here:</small>
                                    <div class="grid grid-cols-2 gap-3">
                                        <button class="bg-white p-1 border-2 border-black shadow-[-3px_3px_rgba(0,0,0,1)] hover:shadow-none hover:-translate-x-1 hover:translate-y-1 transition">
                                            <a href="#" class="flex items-center gap-1">
                                                <img src="/img/shopee.jpg" alt="" width="25">
                                                <small class="font-segoe font-bold text-xs">bvcklesmiggle</small>
                                            </a>
                                        </button>
                                        <button class="bg-white p-1 border-2 border-black shadow-[-3px_3px_rgba(0,0,0,1)] hover:shadow-none hover:-translate-x-1 hover:translate-y-1 transition">
                                            <a href="#" class="flex items-center gap-1">
                                                <img src="/img/tokopedia.png" alt="" width="25">
                                                <small class="font-segoe font-bold text-xs">bvcklesmiggle</small>
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section>
            <img src="/img/banner_products.jpg" alt="" class="img-fluid w-full my-4 border-2 border-gray-200">
            <div class="flex gap-8">
                <div class="sidebar flex flex-col max-h-screen sticky top-0 pt-16 -mt-16 pb-2">
                    {{-- max-h-[90vh] --}}
                    <ul class="flex flex-col items-start gap-2 grow">
                        <li><a class="font-bold font-segoe text-[#ff00ff]"
                                href="#">ALL</a>
                        </li>
                        <li>
                            <div class="flex">
                                <i class="text-gray-200 fa-solid fa-minus"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                            </div>
                        </li>
                        <li><a class="text-gray-200 font-semibold font-segoe hover:text-[#ff00ff]" href="products?category=head%20gear">Head
                                Gear</a></li>
                        <li><a class="text-gray-200 font-semibold font-segoe hover:text-[#ff00ff]" href="#">Body
                                Armor</a></li>
                        <li><a class="text-gray-200 font-semibold font-segoe hover:text-[#ff00ff]" href="#">Hand
                                Wear</a></li>
                        <li><a class="text-gray-200 font-semibold font-segoe hover:text-[#ff00ff]" href="#">Foot
                                Wear</a></li>
                        <li>
                            <div class="flex">
                                <i class="text-gray-200 fa-solid fa-minus"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                                <i class="text-gray-200 fa-solid fa-minus ms-1"></i>
                            </div>
                        </li>
                        <li><a class="text-gray-200 font-semibold font-segoe hover:text-[#ff00ff]"
                                href="#">Storage</a></li>
                        <li><a class="text-gray-200 font-semibold font-segoe hover:text-[#ff00ff]"
                                href="#">Extended</a></li>
                        <li><a class="text-gray-200 font-semibold font-segoe hover:text-[#ff00ff]"
                                href="#">Items</a></li>
                    </ul>
                    <div>
                        <h5 class="font-bold font-segoe text-gray-200 text-xs text-center">CHECK OUT AT<br>OUR OFFICIAL
                            eCOMMERCE:</h5>
                        <div class="grid grid-cols-2 gap-3 mt-2">
                            <button class="bg-white p-1">
                                <a href="#" class="flex items-center gap-1">
                                    <img src="/img/shopee.jpg" alt="" width="25">
                                    <small class="font-semibold text-[10px]">bvcklesmiggle</small>
                                </a>
                            </button>
                            <button class="bg-white p-1">
                                <a href="#" class="flex items-center gap-1">
                                    <img src="/img/tokopedia.png" alt="" width="25">
                                    <small class="font-semibold text-[10px]">bvcklesmiggle</small>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="products">
                    <div class="grid grid-cols-4 gap-4">
                    @for ($i = 0; $i < 20; $i++)
                    <div class="card hover:brightness-50 hover:cursor-pointer">
                        <img src="img/blckruby3.jpg" alt="" class="img-fluid rounded-2xl">
                    </div>
                    @endfor
                    </div>
                    <div class="pagination flex gap-3 justify-center mt-7">
                        <div class="font-bold text-gray-200">PAGE:  </div>
                        <a href="#" class="font-bold text-[#ff00ff]">1  </a>
                        <a href="#" class="font-bold text-gray-200">2  </a>
                        <a href="#" class="font-bold text-gray-200">3  </a>
                        <div class="font-bold text-gray-200">...  </div>
                        <a href="#" class="font-bold text-gray-200">last page</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="max-container padding-container">
        <div class="py-1 border-t-2 border-gray-200 mt-5">
            <p class="text-end text-xs text-gray-200 font-segoe font-semibold">COPYRIGHT ©2024<br>BVCKLESMIGGLE, ALL
                RIGHT RESERVED</p>
        </div>
    </footer>
    <script>
        const cardPopup = document.querySelector('.cardPopup');
        const cardPopupContent = document.querySelector('.cardPopupContent');
        const closePopup = document.querySelector('.closePopup');
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('click', () => {
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
    </script>
</x-layout>
