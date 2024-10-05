<x-layout>
    @isset($article)
        @section('head')
            <meta property="og:title" content="{{ $article->pure_title }}">
            {{-- <meta property="og:description" content="Deskripsi singkat artikel Anda."> --}}
            <meta property="og:image" content="{{ asset('storage/' . $article->image) }}">
            <meta property="og:url" content="https://bvcklesmiggle.com/articles/{{ $article->slug }}">
        @endsection
    @endisset
    <main class="max-container padding-container min-h-screen">
        @if (session('success'))
            <x-success-alert>{{ session('success') }}</x-success-alert>
        @elseif (session('error'))
            <x-error-alert>{{ session('error') }}</x-error-alert>
        @endif
        <div class="modal fixed inset-0 flex opacity-100 -z-10 transition-opacity items-center justify-center">
            {{-- <div class="cardPopupContent transition ease-in-out duration-300 bg-white border-2 border-black w-[85%] max-h-[80%] p-3 mt-12" onclick="event.stopPropagation()"> --}}
            <div class="modalContent transition ease-in-out duration-300 scale-0 bg-white border-2 border-black rounded-md w-[95%] max-w-[500px] max-h-[85%] px-3 overflow-y-auto"
                onclick="event.stopPropagation()">
                <div id="cardPopupBody" class="card-popup-body">
                    <form method="POST" action="{{ route('articlesComment.store') }}" class="flex-col gap-5 px-2 py-4">
                        @csrf
                        <div class="flex flex-col gap-3">
                            <input id="articleIdModal" name="articleId" type="hidden">
                            <div>
                                <label class="block text-sm mb-1 font-bold" for="name">Name</label>
                                <input type="text" name="name" id="name" oninput="checkInputFilled(this)"
                                    placeholder="Enter your name"
                                    class="text-sm w-full rounded-md px-3 py-2 border border-gray-400">
                            </div>
                            <div>
                                <label class="block text-sm mb-1 font-bold" for="email">Email<span
                                        class="text-red-600">*</span></label>
                                <input required type="email" name="email" id="email"
                                    oninput="checkInputFilled(this)" placeholder="Enter your email"
                                    class="text-sm w-full rounded-md px-3 py-2 border border-gray-400">
                            </div>
                            <div>
                                <label class="block text-sm mb-1 font-bold" for="comment">Comment<span
                                        class="text-red-600">*</span></label>
                                <input required type="text" name="content" id="content"
                                    oninput="checkInputFilled(this)" placeholder="Enter your comment"
                                    class="text-sm w-full rounded-md px-3 py-2 border border-gray-400">
                            </div>
                            <div class="text-sm">
                                Or <a href="/login" class="color-primary text-dark">Login</a> once and comment with
                                ease!
                            </div>
                            <div class="flexBetween mt-2">
                                <button type="button"
                                    class="w-fit px-4 py-1 text-white font-bold border-2 border-gray-500 bg-gray-500 rounded-md closePopup">Cancel</button>
                                <button id="saveAddCommentBtn" disabled
                                    class="w-fit px-4 py-1  text-white font-bold bg-primary rounded-md border-2 border-black flexCenter gap-2 disabled:cursor-not-allowed disabled:opacity-30">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <img src="/img/banner_articles_mob.jpg" alt=""
            class="lg:hidden img-fluid w-full my-2 border-2 border-gray-200">
        <img src="/img/banner_articles.jpg" alt=""
            class="hidden lg:block img-fluid w-full my-4 border-2 border-gray-200">
        <div class="flex flex-col lg:flex-row gap-4 items-start">
            <div class="articles flex flex-col gap-5 lg:gap-7 grow">
                <div
                    class="sticky top-[70px] lg:hidden {{ $articles->count() == 0 && !request()->input('search') ? 'hidden' : '' }}">
                    <form method="GET" action="" class="flex items-stretch mb-2">
                        <input type="text" name="search" id="search" placeholder="Search for Articles"
                            value="{{ request()->input('search') ? request()->input('search') : '' }}"
                            class="grow px-3 py-2 outline-none bg-dark border border-gray-200 border-r-0 rounded-l-md text-gray-200 text-sm">
                        <button class="self-auto px-3 border border-[#ff00ff] bg-dark rounded-r-md"><i
                                class="fa-solid fa-magnifying-glass text-gray-200"></i></button>
                        {{-- <button class="self-auto px-3 border border-[#ff00ff] rounded-r-xl"><i class="fa-solid fa-magnifying-glass text-gray-200"></i></button> --}}
                    </form>
                </div>
                <div class="categories lg:hidden">
                    <h2 class="font-bold text-gray-200 mb-3">CATEGORIES:</h2>
                    <ul class="flex items-center gap-2">
                        @foreach ($categories as $category)
                            <li><a href="articles?category={{ $category->name }}"
                                    class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-md text-[#ff00ff]">{{ $category->name }}</a>
                            </li>
                        @endforeach
                        {{-- <li><a href="#"
                                class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-md text-[#ff00ff]">Event</a>
                        </li>
                        <li><a href="#"
                                class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-md text-[#ff00ff]">Music</a>
                        </li>
                        <li><a href="#"
                                class="bg-dark border border-[#ff00ff]  px-3 py-1 rounded-md text-[#ff00ff]">Popstore</a>
                        </li> --}}
                    </ul>
                </div>
                {{-- <div class="ads-container flexCenter lg:hidden">
                    <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280 atau 6:5<br>Ads Placement</div>
                </div> --}}
                <div class="ads-container hidden justify-center items-center lg:hidden">
                    {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                    <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">300 x 250 atau
                        6:5<br>Ads
                        Placement</div>
                    {{-- <div class="ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">336 x 280 atau 6:5<br>Ads
                        Placement</div> --}}
                </div>
                @foreach ($articles as $article)
                    <div class="article px-4 lg:px-10 pt-4 lg:pt-7 pb-4 bg-white rounded-md grow">
                        <h1 class="article-title font-bold text-lg lg:text-xl">{!! $article->title !!}</h1>
                        <div class="flex flex-col lg:flex-row justify-between mt-2">
                            <div class="leading-tight">
                                <p class="article-date text-sm lg:text-base">Posted on
                                    {{ \Carbon\Carbon::parse($article->created_at)->format('M d, Y') }}</p>
                                <p class="article-categories text-sm lg:text-base">Categories: <a
                                        href="articles?category={{ $article->categories->implode('name', ', ') }}"
                                        class="color-primary">{{ $article->categories->implode('name', ', ') }}</a></p>
                            </div>
                            <div>
                                <p class="article-author text-sm lg:text-base">Author: <a href="#"
                                        class="color-primary">{{ $article->author }}</a></p>
                            </div>
                        </div>
                        <img src="{{ asset('storage/' . $article->image) }}" alt=""
                            class="w-auto h-full max-w-3xl max-h-96 mt-7 block mx-auto rounded-md">
                        {{-- <div class="flexCenter my-5">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/OqEc_169ywY"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        </div> --}}

                        {{-- <video width="320" height="240" controls>
                            <source src="https://www.youtube.com/embed/watch?v=OqEc_169ywY&list=RDDP2RgqiA-bQ&index=2">
                            Error Message
                          </video> --}}
                        {{-- <video src="https://youtu.be/OqEc_169ywY?si=MUNMqwba057N0_2V"></video> --}}
                        <div
                            class="relative flex items-center gap-5 px-3 pb-2 pt-4 border-2 border-gray-400  w-fit rounded-md mx-auto mt-4">
                            <div
                                class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-primary rounded-full text-white px-5 py-1 text-xs">
                                Share</div>
                            {{-- <i class="fa-solid fa-share-from-square text-2xl color-primary"></i>  --}}
                            <button>
                                <a href="https://api.whatsapp.com/send?text={{ $article->pure_title }}:+https://bvcklesmiggle.com/articles/{{ $article->slug }}"
                                    target="_blank" class="flex flexCenter p-1 rounded-lg w-9">
                                    <i
                                        class="fa-brands fa-square-whatsapp text-gray-600 text-3xl hover:text-[#ff00ff]"></i>
                                </a>
                            </button>
                            <button>
                                <a target="_blank"
                                    href="https://www.facebook.com/sharer/sharer.php?u=https://bvcklesmiggle.com/articles/{{ $article->slug }}"
                                    class="flex flexCenter p-1 rounded-lg w-9"><i
                                        class="fa-brands fa-square-facebook text-gray-600 text-3xl hover:text-[#ff00ff]"></i></a>
                            </button>
                            <button id="copyLinkButton" class="flex items-center space-x-2">
                                <div class="small shareLink hidden">
                                    https://bvcklesmiggle.com/articles/{{ $article->slug }}</div>
                                <i class="fa-solid fa-clone text-lg lg:text-2xl text-gray-600 hover:color-primary"></i>
                            </button>
                        </div>
                        <div class="article-body leading-relaxed mt-3 line-clamp-3">
                            {!! $article->body !!}
                        </div>
                        {{-- <hr class="border-zinc-400 my-3"> --}}
                        <div class="text-end mt-2 lg:mt-5">
                            {{-- <button id="addCommentBtn" data-article-id="{{ $article->id }}"
                                class="text-sm lg:text-base color-primary border border-primary px-3 py-1 rounded-md hidden">Add
                                a comment</button> --}}
                            {{-- <button class="text-sm lg:text-base text-white bg-primary px-4 py-1 rounded-md">Send</button> --}}
                            <button
                                class="text-sm lg:text-base color-primary border border-primary px-3 py-1 rounded-md"
                                onclick="toggleShowArticle(this)">Show more</button>
                        </div>
                        <div class="hidden">
                            <h5 class="text-lg font-bold mb-3">Comments</h5>
                            {{-- <hr class="my-3"> --}}
                            @auth
                                <form method="POST" action="{{ route('articlesComment.store') }}">
                                    @csrf
                                    {{-- <label for="comment">Komentar:</label><br> --}}
                                    <input value="{{ $article->id }}" name="articleId" type="hidden">
                                    <input value="{{ Auth::user()->name }}" name="name" type="hidden">
                                    <input value="{{ Auth::user()->email }}" name="email" type="hidden">
                                    <textarea id="comment"
                                        class="comment-box outline-none border-b border-gray-300 focus:border-primary text-sm w-full py-2 resize-none overflow-hidden min-h-10"
                                        name="content" rows="1" maxlength="200" placeholder="Add a comment ..."></textarea>
                                    <div class="flexBetween mt-1">
                                        <div id="charCount" class="character-count">0 / 200</div>
                                        <button id="saveCommentBtn" disabled
                                            class="text-sm lg:text-base text-white bg-primary px-4 py-1 rounded-md disabled:opacity-30">Send</button>
                                    </div>
                                </form>
                            @else
                                <button id="addCommentBtn" data-article-id="{{ $article->id }}"
                                    class="text-sm lg:text-base color-primary border border-primary px-3 py-1 rounded-md hidden mb-3">Add
                                    a comment</button>
                            @endauth
                            <ul class="flex flex-col gap-5 mt-3">
                                {{-- {{ $article->comments }} --}}
                                @foreach ($article->comments as $comment)
                                    <li>
                                        <div class="flex gap-1">
                                            @if ($comment->user->name)
                                                <small class="font-bold">{{ $comment->user->name }}</small>
                                            @else
                                                <small class="font-bold italic">Anonymous</small>
                                            @endif
                                            <small class="text-gray-300 font-light text-xs">•</small>
                                            <small class="text-gray-400 font-light text-xs">
                                                {{ $comment->created_at->diffForHumans(['parts' => 1]) }}</small>
                                            {{-- <small>{{ $comment->created_at->diffForHumans(['parts' => 1]) }}</small> --}}
                                        </div>
                                        <p class="text-sm">
                                            {{ $comment->content }}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
                @if ($articles->hasPages())
                    {{ $articles->links() }}
                @endif
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
                <form method="GET" action=""
                    class="hidden lg:flex {{ $articles->count() == 0 && !request()->input('search') ? 'lg:hidden' : '' }} items-stretch mb-4">
                    <div class="relative">
                        <input type="text" placeholder="Search for Articles" name="search" id="search"
                            value="{{ request()->input('search') ? request()->input('search') : '' }}"
                            class="grow pl-3 pr-8 py-2 outline-none bg-dark border border-gray-200 border-r-0 rounded-l-md text-gray-200 text-sm">
                        @if (request()->input('search'))
                            <button onclick="clearSearchField()" type="button" class="absolute right-3 top-1/2 -translate-y-1/2"><i
                                    class="fa-solid fa-xmark text-xl text-light"></i></button>
                        @endif
                    </div>
                    <button class="self-auto px-3 border border-[#ff00ff] bg-dark rounded-r-md"><i
                            class="fa-solid fa-magnifying-glass text-gray-200 mb-1"></i></button>
                    {{-- <button class="self-auto px-3 border border-[#ff00ff] rounded-r-xl"><i class="fa-solid fa-magnifying-glass text-gray-200"></i></button> --}}
                </form>
                <div class="ads-container hidden lg:block">
                    {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                    <x-ads-m />
                </div>
                @if ($articles->count() > 0)
                    <div class="categories hidden lg:block mt-3 leading-loose">
                        <h2 class="font-bold text-gray-200">CATEGORIES:</h2>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="articles?category={{ $category->name }}" class="text-[#ff00ff]">>
                                        {{ $category->name }}</a></li>
                            @endforeach
                            {{-- <li><a href="#" class="text-[#ff00ff]">> Event</a></li>
                        <li><a href="#" class="text-[#ff00ff]">> Music</a></li>
                        <li><a href="#" class="text-[#ff00ff]">> Popstore</a></li> --}}
                        </ul>
                    </div>
                @endif
                {{-- <hr class="border-t-1 border-gray-200 border-dashed my-2 lg:mt-2 lg:mb-0"> --}}
                <div class="ads-container mt-4 hidden justify-center items-center lg:hidden">
                    {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                    <div class="ads-image-s lg:ads-image ads-1 flexCenter bg-white text-gray-500 text-center text-xs">
                        4:3<br>Ads
                        Placement</div>
                </div>
                <div class="download-pdf mt-3 leading-loose {{ $downloads->count() == 0 ? 'hidden' : '' }}">
                    <h2 class="font-bold text-gray-200">DOWNLOAD OUR ZINE (pdf):</h2>
                    <ul>
                        @foreach ($downloads as $download)
                            <li><a href="#" class="text-[#ff00ff]">{{ $download->title }}</a></li>
                        @endforeach
                        {{-- <li><a href="#" class="text-[#ff00ff]">#1 Issue "Goldie Old"</a></li>
                        <li><a href="#" class="text-[#ff00ff]">#2 Issue "Never TooEmo"</a></li>
                        <li><a href="#" class="text-[#ff00ff]">#3 Issue "AnotherVeil"</a></li>
                        <li class="text-gray-500">#4 Issue (soon)</li> --}}
                    </ul>
                </div>
                <div class="flex flex-col gap-4 mt-8">
                    <div class="ads-container hidden lg:block">
                        {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                        <x-ads-m />
                    </div>
                    <div class="ads-container hidden lg:block">
                        {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                        <x-ads-m />
                    </div>
                    <div class="ads-container hidden lg:block">
                        {{-- <img src="your-image-url.jpg" alt="336 x 280 (6:5 ratio) Ads Placement" class="ads-image bg-gray-200"> --}}
                        <x-ads-m />
                    </div>
                </div>
                <a href="#" class="hidden text-end mt-1 color-secondary text-[10px]">Ads powered by Google</a>
            </div>
        </div>
    </main>
    <script>
        function toggleShowArticle(el) {
            el.parentElement.previousElementSibling.classList.toggle('line-clamp-3');
            el.innerHTML = el.innerHTML === 'Show Less' ? 'Show More' : 'Show Less';
            el.classList.toggle('border');
            // el.previousElementSibling.classList.toggle('hidden');
            el.parentElement.nextElementSibling.classList.toggle('hidden');
            if (el.parentElement.nextElementSibling.querySelector('#addCommentBtn')) {
                el.parentElement.nextElementSibling.querySelector('#addCommentBtn').classList.toggle('hidden')
            }
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
            const comment = document.querySelector('#content');
            if (email.value && comment.value) {
                saveAddCommentBtn.removeAttribute('disabled');
            } else {
                saveAddCommentBtn.setAttribute('disabled', true);
            }
        }

        const articleBody = document.querySelector('.article-body');
        const divs = articleBody.querySelectorAll('div');

        // Iterasi setiap elemen div
        divs.forEach(div => {
            let content = div.innerHTML;

            // Cek apakah teks mengandung URL YouTube embed (mendukung beberapa URL)
            const youtubeUrlRegex = /https:\/\/www\.youtube\.com\/embed\/[a-zA-Z0-9_-]+/g;
            const foundUrls = content.match(youtubeUrlRegex);

            if (foundUrls) {
                // Ganti setiap URL yang ditemukan dengan iframe
                foundUrls.forEach(url => {
                    const iframe = `
        <div class="flexCenter my-5">
          <iframe width="560" height="315" src="${url}" title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen>
          </iframe>
        </div>`;

                    // Gantikan URL dengan iframe dalam konten
                    content = content.replace(url, iframe);
                });

                // Set kembali konten ke elemen div
                div.innerHTML = content;
            }
        });

        const copyLinkBtns = document.querySelectorAll('#copyLinkButton')
        copyLinkBtns.forEach(copyLinkBtn => {
            const shareLink = copyLinkBtn.querySelector('.shareLink').innerHTML.trim()
            copyLinkBtn.addEventListener('click', () => {
                const url = shareLink;
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link copied to clipboard!');
                }).catch(err => {
                    console.error('Failed to copy text', err);
                });
            });
        })

        // KOMENTAR
        const commentBox = document.getElementById('comment');
        const charCount = document.getElementById('charCount');
        const saveCommentBtn = document.getElementById('saveCommentBtn');

        // Auto resize textarea
        commentBox.addEventListener('input', function() {
            this.style.height = 'auto'; // Reset height to auto to recalculate height
            this.style.height = (this.scrollHeight) + 'px'; // Adjust height based on content

            // Update character count
            const currentLength = this.value.length;
            charCount.textContent = `${currentLength} / 200`;

            if (commentBox.value.length > 0) {
                saveCommentBtn.removeAttribute('disabled');
            } else {
                saveCommentBtn.setAttribute('disabled', true);
            }
        });

        function clearSearchField() {
            const searchFields = document.querySelectorAll('#search');
            searchFields.forEach(searchField => {
                searchField.value = '';
            })
        }
    </script>
</x-layout>
