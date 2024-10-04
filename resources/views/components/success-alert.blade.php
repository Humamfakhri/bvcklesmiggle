<div class="myAlert opacity-100 transition-opacity duration-300 rounded fixed bottom-0 right-0 my-5 padding-container pt-5 z-50" role="alert">
    <div class="bg-green-100 rounded border border-green-400 text-green-700 px-4 py-3">
        <span class="block sm:inline">{{ $slot }}</span>
    </div>
</div>

<script>
    const myAlert = document.querySelector('.myAlert');
    setTimeout(() => {
        myAlert.classList.add('opacity-0');
        myAlert.classList.remove('opacity-100');
    }, 2000);
    setTimeout(() => {
        myAlert.classList.add('hidden');
    }, 2300);
</script>
