<div class="sidebar h-screen py-6 bg-dark flex flex-col padding-container sticky top-0">
    <img src="/img/logo.png" alt="" class="h-auto max-w-52">
    <ul class="flex flex-col gap-5 mt-5 grow">
        {{-- <li><x-nav-link href="/">HOME</x-nav-link></li> --}}
        <li><x-nav-link href="sipalingadminB$/articles">ARTICLES</x-nav-link></li>
        <li><x-nav-link href="sipalingadminB$/products">PRODUCTS</x-nav-link></li>  
        {{-- <li><x-nav-link href="partnership">PARTNERSHIP</x-nav-link></li> --}}
    </ul>
    <div class="flex justify-between items-end border border-gray-500 px-3 py-2 rounded-lg">
        <div>
            <small class="text-gray-400">You are logged in as:</small>
            <h3 class="text-light font-bold">Admin</h3>
        </div>
        <button><a href="/logout">
                <i class="fa-solid fa-arrow-right-from-bracket color-primary text-2xl rotate-180"></i>
            </a></button>
    </div>
</div>