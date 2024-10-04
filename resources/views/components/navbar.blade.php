<nav id="navbar" class="max-container sticky top-0 z-50 hidden lg:block">
    <div class="navBg padding-container mt-2">
        <div class="navContent flex items-center justify-between w-full border-y-2 border-gray-200 py-2">
            <ul class="flex items-center gap-8 w-full">
                <li><x-nav-link href="/">HOME</x-nav-link></li>
                <li><x-nav-link href="articles">ARTICLES</x-nav-link></li>
                <li><x-nav-link href="products">PRODUCTS</x-nav-link></li>
                <li><x-nav-link href="partnership">PARTNERSHIP</x-nav-link></li>
                {{-- <li><x-nav-link href="home">Home</x-nav-link></li> --}}
                {{-- <li><a href="/articles" class="font-semibold text-lg text-gray-200 hover:text-[#ff00ff]">ARTICLES</a></li> --}}
                {{-- <li><a href="/products" class="font-semibold text-lg text-gray-200 hover:text-[#ff00ff]">PRODUCTS</a></li> --}}
                {{-- <li><a href="/partnership" class="font-semibold text-lg text-gray-200 hover:text-[#ff00ff]">PARTNERSHIP</a></li> --}}
            </ul>
            <ul class="flex items-center gap-5">
                <li><a target="_blank" href="#"
                        class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9"><i
                            class="fa-brands fa-square-facebook text-gray-200 text-2xl hover:text-[#ff00ff]"></i></a>
                </li>
                <li><a target="_blank" href="https://www.instagram.com/bvcklesmiggle.id/"
                        class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9"><i
                            class="fa-brands fa-instagram text-gray-200 text-2xl hover:text-[#ff00ff]"></i></a></li>
                <li><a target="_blank" href="https://www.tiktok.com/@bucklesmiggle.id?_t=8oppLrSDTo9&amp;_r=1"
                        class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9"><i
                            class="fa-brands fa-tiktok text-gray-200 text-2xl hover:text-[#ff00ff]"></i></a></li>
                @auth
                    <li class="relative">
                        <small id="profileBtn" class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9 cursor-pointer">
                            <i class="fa-solid fa-user text-gray-200 text-2xl hover:text-[#ff00ff]"></i>
                        </small>
                        {{-- <div id="profileModal" class="hidden right-0 top-full mt-3 bg-dark px-7 py-5 rounded-md border border-light scale-0 duration-200 transition origin-[90%_0%]"> --}}
                        <div id="profileModal" class="absolute right-0 top-full mt-3 bg-dark px-7 py-5 rounded-md border border-light scale-0 duration-200 transition origin-[90%_0%] w-[90vw] sm:max-w-72">
                            <ul class="flex flex-col gap-1">
                                <li class="flexCenter">
                                    <div class="bg-light px-3 py-2 rounded-full w-fit aspect-square">
                                        <i class="fa-solid fa-user text-dark text-4xl"></i>
                                    </div>
                                </li>
                                <li class="text-light text-sm text-center font-bold my-2">{{ Auth::user()->name }}</li>
                                {{-- <li class="text-light text-center font-bold text-nowrap my-2">{{ Auth::user()->name }}</li> --}}
                                <li class="text-light text-xs font-light text-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="flexCenter w-4">
                                            <i class="fa-solid fa-user text-light"></i>
                                        </div>
                                        <span class="text-light">{{ Auth::user()->username }}</span>
                                    </div>
                                </li>
                                <li class="text-light text-xs font-light text-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="flexCenter w-4">
                                            <i class="fa-solid fa-envelope text-light"></i>
                                        </div>
                                        <span class="text-light">{{ Auth::user()->email }}</span>
                                    </div>
                                </li>
                                <hr class="mt-3 mb-4 border-gray-700">
                                <li><a href="{{ route('logout') }}"
                                        class="flexCenter gap-2 border border-[#ff00ff] px-3 py-2 rounded-lg text-gray-200 hover:text-[#ff00ff] text-sm group">
                                        <i class="fa-solid fa-arrow-right-from-bracket rotate-180 text-light group-hover:color-primary"></i>
                                        Logout
                                    </a></li>
                            </ul>
                        </div>
                    </li>
                @else
                    <li>
                        <a href="/login"
                            class="flex flexCenter border-2 border-[#ff00ff] font-bold px-3 py-1 rounded-lg text-gray-200 hover:text-[#ff00ff] h-full">
                            Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@vite('resources/js/navbar.js')
