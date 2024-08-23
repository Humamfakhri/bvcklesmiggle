<x-layout>
    <main class="max-container padding-container">
        <img src="/img/banner_articles_mob.jpg" alt=""
            class="lg:hidden img-fluid w-full my-2 border-2 border-gray-200">
        <img src="/img/banner_articles.jpg" alt=""
            class="hidden lg:block img-fluid w-full my-4 border-2 border-gray-200">
        <div class="flex flex-col lg:flex-row gap-4 items-start">
            <div class="articles flex flex-col gap-5 lg:gap-7">
                <div class="sticky top-[70px] lg:hidden">
                    <form action="" class="flex items-stretch mb-2">
                        <input type="text" placeholder="Cari Artikel (judul, nama band, dll.)"
                            class="grow px-3 py-2 outline-none bg-dark border border-gray-200 border-r-0 rounded-l-xl text-gray-200 text-sm">
                        <button class="self-auto px-3 border border-[#ff00ff] bg-dark rounded-r-xl"><i
                                class="fa-solid fa-magnifying-glass text-gray-200"></i></button>
                        {{-- <button class="self-auto px-3 border border-[#ff00ff] rounded-r-xl"><i class="fa-solid fa-magnifying-glass text-gray-200"></i></button> --}}
                    </form>
                </div>
                <div class="categories lg:hidden">
                    <h2 class="font-bold text-gray-200 mb-3">CATEGORIES:</h2>
                    <ul class="flex items-center gap-2">
                        <li><a href="#"
                                class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-full text-[#ff00ff]">Art</a>
                        </li>
                        <li><a href="#"
                                class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-full text-[#ff00ff]">Event</a>
                        </li>
                        <li><a href="#"
                                class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-full text-[#ff00ff]">Music</a>
                        </li>
                        <li><a href="#"
                                class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-full text-[#ff00ff]">Popstore</a>
                        </li>
                    </ul>
                </div>
                {{-- <div class="ads-container flexCenter lg:hidden">
                    <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280 atau 6:5<br>Ads Placement</div>
                </div> --}}
                <div class="ads-container flexCenter lg:hidden">
                    {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                    <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">300 x 250 atau
                        6:5<br>Ads
                        Placement</div>
                    {{-- <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280 atau 6:5<br>Ads
                        Placement</div> --}}
                </div>
                @foreach ($articles as $article)
                    <div class="article px-4 lg:px-10 pt-4 lg:pt-7 pb-4 bg-white rounded-xl grow">
                        <h1 class="article-title font-bold text-lg lg:text-xl">{{ $article->title }}</h1>
                        <div class="flex flex-col lg:flex-row justify-between mt-2">
                            <div class="leading-tight">
                                <p class="article-date">Posted on
                                    {{ \Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</p>
                                <p class="article-categories">Categories: <a href="#"
                                        class="color-primary">{{ $article->categories->implode('name', ', ') }}</a></p>
                            </div>
                            <div>
                                <p class="article-author">Author: <a href="#"
                                        class="color-primary">{{ $article->author }}</a></p>
                            </div>
                        </div>
                        <img src="{{ asset('storage/' . $article->image) }}" alt="" class="img-fluid mt-7">
                        <div class="article-body leading-relaxed mt-3 line-clamp-3">
                            {!! $article->body !!}
                        </div>
                        {{-- <hr class="border-zinc-400 my-3"> --}}
                        <div class="text-end mt-2 lg:mt-5">
                            <button class="text-sm lg:text-base color-primary border border-primary px-2 py-1 rounded-full" onclick="toggleShowArticle(this)">Show more</button>
                        </div>
                    </div>
                @endforeach
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
                    <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280 atau
                        6:5<br>Ads
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
                <div class="ads-container mt-4 flexCenter lg:hidden">
                    {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                    <div class="ads-image-s lg:ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">
                        4:3<br>Ads
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
                        <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280
                            atau 6:5<br>Ads
                            Placement</div>
                    </div>
                    <div class="ads-container hidden lg:block">
                        {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                        <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280
                            atau 6:5<br>Ads
                            Placement</div>
                    </div>
                    <div class="ads-container hidden lg:block">
                        {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                        <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280
                            atau 6:5<br>Ads
                            Placement</div>
                    </div>
                </div>
                <a href="#" class="hidden lg:block text-end mt-1 color-secondary text-[10px]">Ads powered by
                    Google</a>
            </div>
        </div>
    </main>
    <script>
        function toggleShowArticle(el) {
            el.parentElement.previousElementSibling.classList.toggle('line-clamp-3');
            el.innerHTML = el.innerHTML === 'Show Less' ? 'Show More' : 'Show Less';
            el.classList.toggle('border');
        }
    </script>
</x-layout>
