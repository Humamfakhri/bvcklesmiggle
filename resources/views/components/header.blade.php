<div id="header"
    class="flex flex-col lg:flex-row lg:justify-between lg:items-center z-50 max-container lg:padding-container sticky top-0 lg:static pt-4 lg:py-0 lg:mt-3 transition duration-200 lg:bg-transparent">
    <div class="flex lg:justify-between items-center gap-4 lg:gap-0 padding-container lg:p-0">
        <button class="toggleNavbar lg:hidden cursor-pointer">
            <div class="barIcon w-7 flexCenter"><i
                    class="fa-solid fa-bars text-gray-200 hover:text-[#ff00ff] text-2xl"></i></div>
            <div class="xIcon w-7 hidden"><i class="fa-solid fa-xmark text-gray-200 hover:text-[#ff00ff] text-2xl"></i>
            </div>
        </button>
        <img src="/img/logo.png" alt="" class="h-auto max-h-[35px] max-w-40 lg:max-h-full lg:max-w-64">
        <div class="leading-none grow text-end lg:hidden">
            <small class="font-bold font-segoe text-gray-200 text-xs">NOT JUST A GEAR,<br>A STATEMENT!</small>
        </div>
    </div>
    <div
        class="navbar-content transition-all duration-300 h-0 overflow-hidden padding-container mt-3 border-gray-200 bg-dark">
        <ul class="flex flex-col gap-5 mt-5">
            <li><x-nav-link href="/">HOME</x-nav-link></li>
            <li><x-nav-link href="articles">ARTICLES</x-nav-link></li>
            <li><x-nav-link href="products">PRODUCTS</x-nav-link></li>
            <li><x-nav-link href="partnership">PARTNERSHIP</x-nav-link></li>
        </ul>
        <ul class="flex items-center gap-5 mt-4 pb-2">
            {{-- UBAH HREF BUAT LINK KE SOSMED --}}
            <li><a target="_blank" href="https://www.facebook.com"
                    class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9"><i
                        class="fa-brands fa-square-facebook text-gray-200 text-2xl hover:text-[#ff00ff]"></i></a></li>
            <li><a target="_blank" href="https://www.instagram.com/bvcklesmiggle.id/"
                    class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9"><i
                        class="fa-brands fa-instagram text-gray-200 text-2xl hover:text-[#ff00ff]"></i></a></li>
            <li><a target="_blank" href="https://www.tiktok.com/@bucklesmiggle.id?_t=8oppLrSDTo9&amp;_r=1"
                    class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9"><i
                        class="fa-brands fa-tiktok text-gray-200 text-2xl hover:text-[#ff00ff]"></i></a></li>
            @auth
                <li>
                    <small id="profileBtnMobile" {{-- class="hidden border-2 border-[#ff00ff] p-1 rounded-lg w-9 cursor-pointer"> --}}
                        class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9 cursor-pointer">
                        <i class="fa-solid fa-user text-gray-200 text-2xl hover:text-[#ff00ff]"></i>
                    </small>

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
    <h2 class="font-bold font-segoe text-gray-200 text-2xl text-end hidden lg:block">NOT JUST A GEAR,<br>A STATEMENT!
    </h2>
    @auth
        <div id="profileModalMobile" {{-- class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 mt-3 bg-dark px-7 py-5 rounded-md border border-light scale-100 duration-200 transition z-50"> --}}
            class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 mt-3 bg-dark px-7 py-5 rounded-md border border-light scale-0 duration-200 transition z-50 w-[90vw] sm:max-w-72">
            {{-- class="absolute right-0 top-full mt-3 bg-dark px-7 py-5 rounded-md border border-light scale-0 duration-200 transition origin-[90%_0%]"> --}}
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
    @endauth
</div>

@vite('resources/js/header.js')
