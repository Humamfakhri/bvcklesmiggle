<x-layout>
    <main class="max-container padding-container">
        {{-- <div class="cardPopup fixed inset-0 flex transition-opacity items-center justify-center bg-black/50"> --}}
        <div class="cardPopup fixed inset-0 flex opacity-100 -z-10 transition-opacity items-center justify-center">
            {{-- <div class="cardPopupContent transition ease-in-out duration-300 bg-white border-2 border-black w-[85%] max-h-[80%] p-3 mt-12" onclick="event.stopPropagation()"> --}}
            <div class="cardPopupContent transition ease-in-out duration-300 scale-0 bg-white border-2 border-black max-w-[85%] max-h-[85%] px-3 overflow-y-auto"
                onclick="event.stopPropagation()">
                <div class="card-popup-header text-end border-b-2 border-black sticky top-0 pt-3 bg-white">
                    <button>
                        <i class="closePopup text-3xl text-black fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div id="loadingSpinner" class="loading-spinner p-20"></div>
                <div id="cardPopupBody" class="card-popup-body">
                    <div class="hidden lg:grid grid-cols-10 items-end gap-4 mt-3">
                        <div class="col-end-11 col-span-3 border-b-2 border-black py-2">
                            <h1 id="productNameModal" class="font-bold text-2xl text-black font-segoe">//[JUDUL]</h1>
                        </div>
                    </div>
                    <div class="flex flex-col lg:grid lg:grid-cols-10 lg:gap-4">
                        <div id="product-image" class="col-span-7 pb-3">
                            <div class="md:grid grid-cols-2 gap-4 px-[1px]">
                                <img src="/img/blckruby2.jpg" alt=""
                                    class="img-fluid border border-black hidden md:block">
                                <img src="/img/blckruby3.jpg" alt="" class="img-fluid border border-black">
                            </div>
                        </div>
                        <div id="product-info" class="col-span-3 flex flex-col">
                            <div id="product-category">
                                <a href="#" id="productCategoryModal"
                                    class="block border-b border-black py-1 font-bold font-segoe color-primary">[Category]</a>
                            </div>
                            <div id="productIssueModal" class="text-sm mt-2">
                                [Issue]
                                {{-- <small class="block font-bold mt-2">Issue #01</small>
                                <small class="block">"Never goin old"</small>
                                <small class="block">Year: 2024</small>
                                <small class="block">Collaborative:
                                    <a href="#" class="inline-flex items-start color-primary gap-1">
                                        StudsAddictive
                                        <i class="fa-solid fa-arrow-up-right-from-square color-primary text-[10px]"></i>
                                    </a>
                                </small> --}}
                            </div>
                            <div class="grow overflow-auto">
                                <hr class="border-t-1 border-black border-dashed mt-2">
                                <div id="productDetailsModal" class="text-sm mt-2">
                                    [Details]
                                </div>
                                {{-- <small class="block font-bold mt-2">Details</small>
                                <div class="description">
                                    <div class="flex items-start gap-1">
                                        <div class="label text-xs w-12">Material</div>
                                        <div class="text-xs">:</div>
                                        <div class="value text-xs">Leather (inner),<br>Flannel (outer)</div>
                                    </div>
                                    <div class="flex items-start gap-1">
                                        <div class="label text-xs w-12">Metal</div>
                                        <div class="text-xs">:</div>
                                        <div class="value text-xs">Stainless steel studs</div>
                                    </div>
                                    <div class="flex items-start gap-1">
                                        <div class="label text-xs w-12">Variant</div>
                                        <div class="text-xs">:</div>
                                        <div class="value text-xs">Red</div>
                                    </div> --}}
                                {{-- </div> --}}
                                <hr class="border-t-1 border-black border-dashed mt-2">
                                <div class="leading-none my-2">
                                    <small class="text-[10px] font-bold">All "Limited BvckleSmiggle Equipment" will be
                                        forever not be
                                        reproduced once it is sold out. Grab it fast!</small>
                                </div>
                            </div>
                            <div id="product-footer" class="sticky bottom-0 bg-white pb-3">
                                <div class="flex flex-col lg:flex-row items-center justify-between gap-3">
                                    <small class="font-bold border-t border-primary pt-2">Order<br
                                            class="hidden lg:block"> here:</small>
                                    <div class="grid grid-cols-2 gap-3">
                                        <button
                                            class="bg-white p-1 border-2 border-black shadow-[-3px_3px_rgba(0,0,0,1)] hover:shadow-none hover:-translate-x-1 hover:translate-y-1 transition">
                                            <a id="linkShopeeModal" target="_blank" href="#" class="flex items-center gap-1">
                                                <img src="/img/shopee.jpg" alt="" width="25">
                                                <small class="font-segoe font-bold text-xs">bvcklesmiggle</small>
                                            </a>
                                        </button>
                                        <button
                                            class="bg-white p-1 border-2 border-black shadow-[-3px_3px_rgba(0,0,0,1)] hover:shadow-none hover:-translate-x-1 hover:translate-y-1 transition">
                                            <a id="linkTokopediaModal" target="_blank" href="#"
                                                class="flex items-center gap-1">
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
            <img src="/img/banner_products_mob.jpg" alt=""
                class="lg:hidden img-fluid w-full mt-2 mb-4 border-2 border-gray-200">
            <img src="/img/banner_products.jpg" alt=""
                class="hidden lg:block img-fluid w-full my-4 border-2 border-gray-200">
            <div class="flex gap-8">
                <div class="sidebar hidden lg:flex flex-col max-h-screen sticky top-0 pt-16 -mt-16 pb-2">
                    {{-- max-h-[90vh] --}}
                    <ul class="flex flex-col items-start gap-2 grow">
                        <li><a class="font-bold font-segoe color-primary" href="#">ALL</a>
                        </li>
                        <li>
                            <div class="flex">
                                <i class="text-light fa-solid fa-minus"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                            </div>
                        </li>
                        @foreach ($categories as $category)
                            <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                    href="products?category={{ $category }}">{{ $category }}</a>
                            </li>
                        @endforeach
                        {{-- <li><a class="text-light font-semibold font-segoe hover:color-primary" href="#">Body
                                Armor</a></li>
                        <li><a class="text-light font-semibold font-segoe hover:color-primary" href="#">Hand
                                Wear</a></li>
                        <li><a class="text-light font-semibold font-segoe hover:color-primary" href="#">Foot
                                Wear</a></li>
                        <li>
                            <div class="flex">
                                <i class="text-light fa-solid fa-minus"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                                <i class="text-light fa-solid fa-minus ms-1"></i>
                            </div>
                        </li>
                        <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                href="#">Storage</a></li>
                        <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                href="#">Extended</a></li>
                        <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                href="#">Items</a></li> --}}
                    </ul>
                    <div>
                        <div class="grid grid-cols-2 gap-3 mt-2">
                            <button class="bg-white p-1">
                                <a href="https://shopee.co.id" target="_blank" class="flex items-center gap-1">
                                    <img src="/img/shopee.jpg" alt="" width="25">
                                    <small class="font-semibold text-[10px]">bvcklesmiggle</small>
                                </a>
                            </button>
                            <button class="bg-white p-1">
                                <a href="https://tokopedia.com" target="_blank" class="flex items-center gap-1">
                                    <img src="/img/tokopedia.png" alt="" width="25">
                                    <small class="font-semibold text-[10px]">bvcklesmiggle</small>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="products">
                    <div class="sticky top-[70px]">
                        <form action="" class="flex items-stretch mb-3 lg:hidden">
                            <input type="text" placeholder="Search for Product"
                                class="grow px-3 py-2 outline-none bg-dark border border-gray-200 border-r-0 rounded-l-full text-light text-sm">
                            <button class="self-auto px-3 border border-primary bg-dark rounded-r-full"><i
                                    class="fa-solid fa-magnifying-glass text-light"></i></button>
                            {{-- <button class="self-auto px-3 border border-primary rounded-r-xl"><i class="fa-solid fa-magnifying-glass text-light"></i></button> --}}
                        </form>
                        <div class="flexBetween gap-3 mb-6">
                            <div class="relative lg:hidden">
                                <button
                                    class="categoryBtn flexCenter gap-1 bg-dark border border-primary text-light rounded-full px-3 py-1">
                                    Category
                                    <i class="categoryChevron fa-solid fa-chevron-down text-light duration-200"></i>
                                </button>
                                <div class="categoryContainer absolute top-full mt-1 h-0 overflow-hidden duration-300">
                                    <ul class="leading-loose px-5 py-3 border border-gray-500 bg-dark rounded-xl">
                                        <li><a class="font-bold font-segoe color-primary" href="#">ALL</a>
                                        <li>
                                            <hr class="border-t-1 border-gray-200 border-dashed my-2 px-16">
                                        </li>
                                        @foreach ($categories as $category)
                                            <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                                    href="products?category={{ $category }}">{{ $category }}</a>
                                            </li>
                                        @endforeach
                                        {{-- <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                                href="#">Body
                                                Armor</a></li>
                                        <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                                href="#">Hand
                                                Wear</a></li>
                                        <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                                href="#">Foot
                                                Wear</a></li>
                                        <li>
                                            <hr class="border-t-1 border-gray-200 border-dashed my-2 px-16">
                                        </li>
                                        <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                                href="#">Storage</a></li>
                                        <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                                href="#">Extended</a></li>
                                        <li><a class="text-light font-semibold font-segoe hover:color-primary"
                                                href="#">Items</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3 lg:hidden">
                                <button class="bg-white px-3 py-1 rounded-full">
                                    <a href="#" target="_blank" class="flex items-center gap-1">
                                        <img src="/img/shopee.jpg" alt="" width="25">
                                        <small class="font-semibold text-[10px] leading-none">bvckle<br>smiggle</small>
                                    </a>
                                </button>
                                <button class="bg-white px-3 py-1 rounded-full">
                                    <a href="#" target="_blank" class="flex items-center gap-1">
                                        <img src="/img/tokopedia.png" alt="" width="25">
                                        <small class="font-semibold text-[10px] leading-none">bvckle<br>smiggle</small>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 min-h-[50vh]">
                        {{-- @for ($i = 0; $i < 12; $i++)
                            <div class="card hover:brightness-50 hover:cursor-pointer">
                                <img src="/img/blckruby3.jpg" alt="" class="img-fluid rounded-2xl">
                            </div>
                            @endfor --}}
                        @foreach ($products as $product)
                            <div class="card hover:brightness-50 hover:cursor-pointer">
                                {{-- <h1 class="text-white text-2xl"></h1> --}}
                                {{-- @foreach (json_decode($product->product_images) as $image) --}}
                                {{-- @endforeach --}}
                                <img data-id="{{ $product->id }}"
                                    src="{{ asset('storage/' . json_decode($product->product_images)[0]) }}"
                                    alt="" class="img-fluid rounded-2xl">
                            </div>
                        @endforeach
                    </div>
                    {{-- <div class="pagination flex items-center justify-between lg:justify-center gap-10 mt-7">
                        <a href="#" class="font-bold text-light text-xs lg:text-base color-primary">First page</a>
                        <div class="flexCenter gap-3">
                            <a href="#" class="font-bold color-primary">1</a>
                            <a href="#" class="font-bold text-light">2</a>
                            <a href="#" class="font-bold text-light">3</a>
                            <small class="text-light">...</small>
                            <a href="#" class="font-bold text-light">9</a>
                            <a href="#" class="font-bold text-light">10</a>
                        </div>
                        <a href="#" class="font-bold text-light text-xs lg:text-base">Last page</a>
                    </div> --}}
                </div>
            </div>
        </section>
    </main>
    @vite('resources/js/products.js')
</x-layout>
