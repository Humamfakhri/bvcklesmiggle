<div id="header"
    class="flex flex-col lg:flex-row lg:justify-between lg:items-center z-50 max-container lg:padding-container sticky top-0 lg:static pt-4 lg:py-0 lg:mt-3 transition duration-200 lg:bg-transparent">
    <div class="flex lg:justify-between items-center gap-4 lg:gap-0 padding-container lg:p-0">
        <button class="toggleNavbar lg:hidden cursor-pointer">
            <div class="barIcon w-7 flexCenter"><i
                    class="fa-solid fa-bars text-gray-200 hover:text-[#ff00ff] text-2xl"></i></div>
            <div class="xIcon w-7 hidden"><i class="fa-solid fa-xmark text-gray-200 hover:text-[#ff00ff] text-2xl"></i>
            </div>
        </button>
        <img src="img/logo.png" alt="" class="h-auto max-h-[35px] lg:max-h-full max-w-64">
    </div>
    <div class="navbar-content transition-all duration-300 h-0 overflow-hidden padding-container mt-3 border-gray-200 bg-dark">
        <ul class="flex flex-col gap-5 mt-5">
            <li><x-nav-link href="/">HOME</x-nav-link></li>
            <li><x-nav-link href="articles">ARTICLES</x-nav-link></li>
            <li><x-nav-link href="products">PRODUCTS</x-nav-link></li>
            <li><x-nav-link href="partnership">PARTNERSHIP</x-nav-link></li>
        </ul>
        <ul class="flex items-center gap-5 mt-3">
            <li><a href="#" class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9"><i
                        class="fa-brands fa-square-facebook text-gray-200 text-2xl hover:text-[#ff00ff]"></i></a></li>
            <li><a href="#" class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9"><i
                        class="fa-brands fa-instagram text-gray-200 text-2xl hover:text-[#ff00ff]"></i></a></li>
            <li><a href="#" class="flex flexCenter border-2 border-[#ff00ff] p-1 rounded-lg w-9"><i
                        class="fa-brands fa-tiktok text-gray-200 text-2xl hover:text-[#ff00ff]"></i></a></li>
        </ul>
    </div>
    <h2 class="font-bold font-segoe text-gray-200 text-2xl text-end hidden lg:block">Bvck<br>Yourself!</h2>
</div>

<script>
    const header = document.getElementById("header");
    window.addEventListener("scroll", function() {
        let windowPosition = window.scrollY > 0;
        if (window.scrollY > 0) {
            header.classList.add("bg-dark");
        } else {
            header.classList.remove("bg-dark");
        }
    });

    const toggleNavbar = document.querySelector('.toggleNavbar');
    const navbarContent = document.querySelector('.navbar-content');
    const barIcon = document.querySelector('.barIcon');
    const xIcon = document.querySelector('.xIcon');
    toggleNavbar.onclick = function() {
        navbarContent.classList.toggle("h-0");
        navbarContent.classList.toggle("h-[262px]");
        navbarContent.classList.toggle("border-t-2");
        if (navbarContent.classList.contains("h-[262px]")) {
            header.classList.add("bg-dark");
        } else {
            header.classList.remove("bg-dark");
        }
        // if (navbarContent.classList.contains('h-0')) {
        //     navbarContent.style.height = navbarContent.scrollHeight + 'px';
        //     navbarContent.classList.remove('h-0');
        //     navbarContent.classList.add('visible');
        // } else {
        //     navbarContent.style.height = navbarContent.scrollHeight + 'px'; // Set height to its current height
        //     navbarContent.offsetHeight; // Force a reflow
        //     navbarContent.style.height = '0';
        //     navbarContent.classList.remove('visible');
        //     navbarContent.classList.add('h-0');
        // }
        barIcon.classList.toggle("hidden");
        xIcon.classList.toggle("hidden");
        barIcon.classList.toggle("flexCenter");
        xIcon.classList.toggle("flexCenter");
    };
</script>
