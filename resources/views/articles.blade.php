<x-layout>
    <main class="max-container padding-container">
        @if (session('error'))
            <x-success-alert>{{ session('error') }}</x-success-alert>
        @endif
        <div class="modal fixed inset-0 flex opacity-100 -z-10 transition-opacity items-center justify-center">
            {{-- <div class="cardPopupContent transition ease-in-out duration-300 bg-white border-2 border-black w-[85%] max-h-[80%] p-3 mt-12" onclick="event.stopPropagation()"> --}}
            <div class="modalContent transition ease-in-out duration-300 scale-0 bg-white border-2 border-black rounded-md w-full max-w-[500px] max-h-[85%] px-3 overflow-y-auto"
                onclick="event.stopPropagation()">
                <div id="cardPopupBody" class="card-popup-body">
                    {{-- <form method="POST" action="{{ route('articlesComment.store') }}" class="flex-col gap-5 p-4"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col gap-3">
                        <input id="articleIdModal" name="articleId" type="hidden">
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="name">Name</label>
                            <input type="text" name="name" id="name"
                                oninput="checkInputFilled(this)" placeholder="Enter your name"
                                class="text-xs w-full rounded-md px-3 py-2 border border-gray-400">
                        </div>
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="email">Email<span
                                    class="text-red-600">*</span></label>
                            <input required type="text" name="email" id="email"
                                oninput="checkInputFilled(this)" placeholder="Enter your email"
                                class="text-xs w-full rounded-md px-3 py-2 border border-gray-400">
                        </div>
                        <div>
                            <label class="block text-xs mb-1 font-bold" for="comment">Comment<span
                                    class="text-red-600">*</span></label>
                            <input required type="text" name="content" id="content"
                                oninput="checkInputFilled(this)" placeholder="Enter your comment"
                                class="text-xs w-full rounded-md px-3 py-2 border border-gray-400">
                        </div>
                        <div class="flexBetween mt-2">
                            <button type="button" class="w-fit px-4 py-1 text-white font-bold border-2 border-gray-500 bg-gray-500 rounded-md closePopup">Cancel</button>
                            <button id="saveAddCommentBtn" disabled class="w-fit px-4 py-1  text-white font-bold bg-primary rounded-md border-2 border-black flexCenter gap-2 disabled:cursor-not-allowed disabled:opacity-30">Send</button>
                        </div>
                    </div>
                </form> --}}
                </div>
            </div>
        </div>

        <img src="/img/banner_articles_mob.jpg" alt=""
            class="lg:hidden img-fluid w-full my-2 border-2 border-gray-200">
        <img src="/img/banner_articles.jpg" alt=""
            class="hidden lg:block img-fluid w-full my-4 border-2 border-gray-200">
        <div class="flex flex-col lg:flex-row gap-4 items-start">
            <div class="articles flex flex-col gap-5 lg:gap-7 grow">
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
                        @foreach ($categories as $category)
                            <li><a href="#"
                                    class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-full text-[#ff00ff]">{{ $category->name }}</a>
                            </li>
                        @endforeach
                        {{-- <li><a href="#"
                                class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-full text-[#ff00ff]">Event</a>
                        </li>
                        <li><a href="#"
                                class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-full text-[#ff00ff]">Music</a>
                        </li>
                        <li><a href="#"
                                class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-full text-[#ff00ff]">Popstore</a>
                        </li> --}}
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
                            {{-- <button id="addCommentBtn" data-article-id="{{ $article->id }}"
                                class="text-sm lg:text-base color-primary border border-primary px-3 py-1 rounded-full hidden">Add
                                a comment</button> --}}
                            <button
                                class="text-sm lg:text-base color-primary border border-primary px-3 py-1 rounded-full"
                                onclick="toggleShowArticle(this)">Show more</button>
                        </div>
                        {{-- <div>
                            <h5 class="text-lg font-bold">Comments</h5>
                            <hr class="my-3">
                            <ul class="flex flex-col gap-3 mt-3">    
                                @foreach ($comments as $comment)
                                <li>
                                    <div class="flex gap-1">
                                        @if ($comment->name)
                                            <small class="font-bold">{{ $comment->name }}</small>
                                        @else
                                            <small class="font-bold italic">Anonymous</small>
                                        @endif
                                    </div>
                                    <p class="text-sm">
                                        {{ $comment->comment }}
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                        </div> --}}
                    </div>
                @endforeach
                {{ $articles->links() }}
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
            <div class="aside">
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
                @if ($articles->count() > 0)
                    <div class="categories hidden lg:block mt-3 leading-loose">
                        <h2 class="font-bold text-gray-200">CATEGORIES:</h2>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="#" class="text-[#ff00ff]">> {{ $category->name }}</a></li>
                            @endforeach
                            {{-- <li><a href="#" class="text-[#ff00ff]">> Event</a></li>
                        <li><a href="#" class="text-[#ff00ff]">> Music</a></li>
                        <li><a href="#" class="text-[#ff00ff]">> Popstore</a></li> --}}
                        </ul>
                    </div>
                @endif
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
            el.previousElementSibling.classList.toggle('hidden');
        }

        const modal = document.querySelector('.modal');
        const modalContent = document.querySelector('.modalContent');
        const closePopup = document.querySelector('.closePopup');
        const addCommentBtns = document.querySelectorAll('#addCommentBtn');

        const articleIdModal = document.querySelector('#articleIdModal');

        addCommentBtns.forEach(card => {
            card.addEventListener('click', () => {
                const articleId = card.getAttribute('data-article-id');
                articleIdModal.value = articleId;
                document.body.classList.add('overflow-hidden');
                modal.classList.remove('opacity-0');
                modal.classList.add('opacity-100');
                modal.classList.add('bg-black/50');
                modal.classList.remove('-z-10');
                modal.classList.add('z-50');
                modalContent.classList.add('scale-100');
                modalContent.classList.remove('scale-0');
            });
        });
        closePopup.addEventListener('click', () => {
            document.body.classList.remove('overflow-hidden');
            modal.classList.remove('opacity-100');
            modal.classList.remove('bg-black/50');
            modal.classList.add('opacity-0');
            modal.classList.remove('z-50');
            setTimeout(() => {
                modal.classList.add('-z-10');
            }, 300);
            modalContent.classList.add('scale-0');
            modalContent.classList.remove('scale-100');
        });
        modal.addEventListener('click', () => {
            document.body.classList.remove('overflow-hidden');
            modal.classList.remove('opacity-100');
            modal.classList.remove('bg-black/50');
            modal.classList.add('opacity-0');
            modal.classList.remove('z-50');
            setTimeout(() => {
                modal.classList.add('-z-10');
            }, 300);
            modalContent.classList.add('scale-0');
            modalContent.classList.remove('scale-100');
        });

        const saveAddCommentBtn = document.querySelector('#saveAddCommentBtn');

        function checkInputFilled(e) {
            console.log(e.value);
            const name = document.querySelector('#name');
            const email = document.querySelector('#email');
            const comment = document.querySelector('#comment');
            if (email.value && comment.value) {
                saveAddCommentBtn.removeAttribute('disabled');
            } else {
                saveAddCommentBtn.setAttribute('disabled', true);
            }
        }
    </script>
</x-layout>
