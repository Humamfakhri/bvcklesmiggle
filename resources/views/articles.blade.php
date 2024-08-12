<x-layout>
    <main class="max-container padding-container">
        <img src="/img/banner_articles.jpg" alt="" class="img-fluid w-full my-4 border-2 border-gray-200">
        <div class="flex flex-col lg:flex-row gap-4">
            <div class="articles flex flex-col gap-5 lg:gap-7">
                <div class="ads-container lg:hidden">
                    {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                    <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280 atau 6:5<br>Ads
                        Placement</div>
                </div>
                <div class="categories lg:hidden">
                    <h2 class="font-bold text-gray-200 mb-3">CATEGORIES:</h2>
                    <ul class="flex items-center gap-2">
                        <li><a href="#" class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-full text-[#ff00ff]">Art</a></li>
                        <li><a href="#" class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-full text-[#ff00ff]">Event</a></li>
                        <li><a href="#" class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-full text-[#ff00ff]">Music</a></li>
                        <li><a href="#" class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-full text-[#ff00ff]">Popstore</a></li>
                    </ul>
                </div>
                <form action="" class="flex items-stretch lg:hidden">
                    <input type="text" placeholder="Cari Artikel (judul, nama band, dll.)" class="grow px-3 py-2 outline-none bg-dark border border-gray-200 border-r-0 rounded-l-xl text-gray-200 text-sm">
                    <button class="self-auto px-3 border border-[#ff00ff] bg-dark rounded-r-xl"><i class="fa-solid fa-magnifying-glass text-gray-200"></i></button>
                    {{-- <button class="self-auto px-3 border border-[#ff00ff] rounded-r-xl"><i class="fa-solid fa-magnifying-glass text-gray-200"></i></button> --}}
                </form>
                <div class="article px-4 lg:px-10 pt-4 lg:pt-7 pb-3 bg-white rounded-xl grow">
                    <h1 class="article-title font-bold text-lg lg:text-xl">DI SINI BUAT JUDUL ARTIKEL</h1>
                    <div class="flex flex-col lg:flex-row justify-between mt-2 text-sm lg:text-base">
                        <div class="leading-tight">
                            <p class="article-date">Posted on June 9, 2024</p>
                            <p class="article-categories">Categories: <a href="#" class="color-primary">Music,
                                </a><a href="#" class="color-primary">Art</a></p>
                        </div>
                        <div>
                            <p class="article-author">Author: <a href="#" class="color-primary">INQ</a></p>
                        </div>
                    </div>
                    <p class="article-body leading-relaxed mt-4 lg:mt-7 text-sm lg:text-base">
                        Daun-daun bunga krisan jatuhberguguran
                        <br>jatuh ke Jatuh ke bumi mata merah yang dibasahi darah
                        <br>Walaupun demikian, kedudukanmu tetap tidak akan berubah
                        <br>Meski kau kehilangan setengah dari tangan dan kakimu
                        <br>Laba-laba berkaki sebelas terserang rindu kampung halaman
                        <br>Kepala dan kaki, kaki dan kepala sudah tak saling mengiringi
                        <br>Daripada mencari teman yang baru
                        <br>Lebih baik "persetan" dengan semua yang akan datang dan pergi
                        <br>Orang-orang yang akan kau temui di sisa hidupmu ini
                        <br>Yang dicinta dan dibenci
                        <br>Sahabat dan musuhlawan dan kawan
                        <br>Bila ingin berjalan, berjalanlah sendiri
                        <br>Bila ingin pergi...pergilah ke timur
                        <br>dan bila ingin berbicara...
                        <br>aku selalu siap mendengarkan
                    </p>
                    <hr class="border-zinc-400 my-3">
                    <div class="text-end">
                        <button>
                            <a href="#" class="text-sm lg:text-base color-primary">Leave a comment</a>
                        </button>
                    </div>
                </div>
                <div class="ads-container lg:hidden">
                    {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                    <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280 atau 6:5<br>Ads
                        Placement</div>
                </div>
                <div class="article px-4 lg:px-10 pt-4 lg:pt-7 pb-3 bg-white rounded-xl grow">
                    <h1 class="article-title font-bold text-lg lg:text-xl">DI SINI BUAT JUDUL ARTIKEL</h1>
                    <div class="flex flex-col lg:flex-row justify-between mt-2">
                        <div class="leading-tight">
                            <p class="article-date">Posted on June 9, 2024</p>
                            <p class="article-categories">Categories: <a href="#" class="color-primary">Music,
                                </a><a href="#" class="color-primary">Art</a></p>
                        </div>
                        <div>
                            <p class="article-author">Author: <a href="#" class="color-primary">INQ</a></p>
                        </div>
                    </div>
                    <img src="/img/article.png" alt="" class="img-fluid mt-7">
                    <p class="article-body leading-relaxed mt-3">
                        Daun-daun bunga krisan jatuhberguguran
                        <br>jatuh ke Jatuh ke bumi mata merah yang dibasahi darah
                        <br>Walaupun demikian, kedudukanmu tetap tidak akan berubah
                        <br>Meski kau kehilangan setengah dari tangan dan kakimu
                        <br>Laba-laba berkaki sebelas terserang rindu kampung halaman
                        <br>Kepala dan kaki, kaki dan kepala sudah tak saling mengiringi
                        <br>Daripada mencari teman yang baru
                        <br>Lebih baik "persetan" dengan semua yang akan datang dan pergi
                        <br>Orang-orang yang akan kau temui di sisa hidupmu ini
                        <br>Yang dicinta dan dibenci
                        <br>Sahabat dan musuhlawan dan kawan
                        <br>Bila ingin berjalan, berjalanlah sendiri
                        <br>Bila ingin pergi...pergilah ke timur
                        <br>dan bila ingin berbicara...
                        <br>aku selalu siap mendengarkan
                    </p>
                    <hr class="border-zinc-400 my-3">
                    <div class="text-end">
                        <button>
                            <a href="#" class="text-sm lg:text-base color-primary">Leave a comment</a>
                        </button>
                    </div>
                </div>
                <div class="pagination flex gap-3 justify-center lg:justify-end">
                    <div class="font-bold text-gray-200">PAGE: </div>
                    <a href="#" class="font-bold text-[#ff00ff]">1 </a>
                    <a href="#" class="font-bold text-gray-200">2 </a>
                    <a href="#" class="font-bold text-gray-200">3 </a>
                    <div class="font-bold text-gray-200">... </div>
                    <a href="#" class="font-bold text-gray-200">last page</a>
                </div>
            </div>
            <div class="aside grow">
                <form action="" class="hidden lg:flex items-stretch mb-4">
                    <input type="text" placeholder="Cari Artikel (judul, nama band, dll.)"
                        class="grow px-3 py-2 outline-none bg-dark border border-gray-200 border-r-0 rounded-l-xl text-gray-200 text-sm">
                    <button class="self-auto px-3 border border-[#ff00ff] bg-dark rounded-r-xl"><i
                            class="fa-solid fa-magnifying-glass text-gray-200"></i></button>
                    {{-- <button class="self-auto px-3 border border-[#ff00ff] rounded-r-xl"><i class="fa-solid fa-magnifying-glass text-gray-200"></i></button> --}}
                </form>
                <div class="ads-container hidden lg:block">
                    {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                    <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280 atau 6:5<br>Ads
                        Placement</div>
                </div>
                <div class="categories hidden lg:block mt-3 leading-loose">
                    <h2 class="font-bold text-gray-200">CATEGORIES:</h2>
                    <ul>
                        <li><a href="#" class="text-[#ff00ff]">> Art</a></li>
                        <li><a href="#" class="text-[#ff00ff]">> Event</a></li>
                        <li><a href="#" class="text-[#ff00ff]">> Music</a></li>
                        <li><a href="#" class="text-[#ff00ff]">> Popstore</a></li>
                    </ul>
                </div>
                <hr class="border-t-1 border-gray-200 border-dashed my-2 lg:mt-2 lg:mb-0">
                <div class="ads-container mt-4 lg:hidden">
                    {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                    <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280 atau 6:5<br>Ads
                        Placement</div>
                </div>
                <div class="download-pdf mt-3 leading-loose">
                    <h2 class="font-bold text-gray-200">DOWNLOAD OUR ZINE (pdf):</h2>
                    <ul>
                        <li><a href="#" class="text-[#ff00ff]">#1 Issue "Goldie Old"</a></li>
                        <li><a href="#" class="text-[#ff00ff]">#2 Issue "Never TooEmo"</a></li>
                        <li><a href="#" class="text-[#ff00ff]">#3 Issue "AnotherVeil"</a></li>
                        <li class="text-gray-500">#4 Issue (soon)</li>
                    </ul>
                </div>
                <div class="flex flex-col gap-4 mt-8">
                    <div class="ads-container hidden lg:block">
                        {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                        <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280 atau 6:5<br>Ads
                            Placement</div>
                    </div>
                    <div class="ads-container hidden lg:block">
                        {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                        <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280 atau 6:5<br>Ads
                            Placement</div>
                    </div>
                    <div class="ads-container hidden lg:block">
                        {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                        <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280 atau 6:5<br>Ads
                            Placement</div>
                    </div>
                </div>
                <a href="#" class="hidden lg:block text-end mt-1 color-secondary text-[10px]">Ads powered by Google</a>
            </div>
        </div>
    </main>
</x-layout>
