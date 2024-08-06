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
                <li><a href="#" class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9"><i
                            class="fa-brands fa-square-facebook text-gray-200 text-2xl hover:text-[#ff00ff]"></i></a></li>
                <li><a href="#" class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9"><i
                            class="fa-brands fa-instagram text-gray-200 text-2xl hover:text-[#ff00ff]"></i></a></li>
                <li><a href="#" class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9"><i
                            class="fa-brands fa-tiktok text-gray-200 text-2xl hover:text-[#ff00ff]"></i></a></li>
            </ul>
        </div>
    </div>
</nav>

<script>
    window.addEventListener("scroll", function() {
        const header = document.getElementById("navbar");
        const navBg = header.querySelector(".navBg");
        const navContent = header.querySelector(".navContent");
        let windowPosition = window.scrollY > 0;
        if (window.scrollY > 83) {
            // header.classList.add("nav-scrolled", windowPosition);
            header.classList.add("nav-scrolled", windowPosition);
            navBg.classList.add("bg-[#151515]");
            navBg.classList.add("border-y-2");
            navBg.classList.add("border-gray-200");
            navContent.classList.remove("border-gray-200");
            navContent.classList.remove("border-y-2");
            // border-y-2 border-gray-200
        } else {
            // header.classList.remove("nav-scrolled", windowPosition);
            navBg.classList.remove("bg-[#151515]");
            navBg.classList.remove("border-y-2");
            navBg.classList.remove("border-gray-200");
            navContent.classList.add("border-gray-200");
            navContent.classList.add("border-y-2");
        }
    });
</script>
