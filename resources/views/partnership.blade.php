<x-layout>
    <main class="max-container padding-container">
        <section>
            <img src="/img/banner_partnership.jpg" alt="" class="img-fluid w-full my-4 border-2 border-gray-200">
            <div class="lg:grid lg:grid-cols-7 gap-6">
                {{-- <div class="grid grid-cols-7 border-b-2 border-gray-200 gap-6"> --}}
                <div class="partnershipFeatures col-span-4 gap-4  h-fit">
                    <p class="font-semibold text-2xl text-gray-200">4 reasons<br>Why u should get a partnership with us?
                    </p>
                    <div class="flex flex-col lg:grid lg:grid-cols-2 gap-4 lg:gap-8 mt-6">
                        <div class="flex items-start gap-2">
                            <img src="/img/partnership-fair-trade.png" alt=""
                                class="mt-1.5 lg:mt-0 max-w-14 h-auto">
                            <div class="flex flex-col lg:gap-2">
                                <h1 class="font-semibold text-2xl text-gray-200">Fair Trade</h1>
                                <p class="text-sm text-gray-200">Fair play, fair pay. When you collaborate with us, it’s all about transparency and mutual gain, because good business is honest business.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <img src="/img/partnership-double.png" alt="" class="mt-1.5 lg:mt-0 max-w-14 h-auto">
                            <div class="flex flex-col lg:gap-2">
                                <h1 class="font-semibold text-2xl text-gray-200">Double Exposure</h1>
                                <p class="text-sm text-gray-200">Let's turn the spotlight on both sides! Partner with us, and together we'll amplify our reach, creating a win-win that's louder than ever.</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col lg:grid lg:grid-cols-2 gap-4 lg:8 mt-4 lg:mt-6">
                        <div class="flex items-start gap-2">
                            <img src="/img/partnership-exclusive.png" alt=""
                                class="mt-1.5 lg:mt-0 max-w-14 h-auto">
                            <div class="flex flex-col lg:gap-2">
                                <h1 class="font-semibold text-2xl text-gray-200">Exclusive Merch</h1>
                                <p class="text-sm text-gray-200">Crafted for the few, desired by many. Our accessories are the epitome of exclusivity, available only to those who dare to stand out.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <img src="/img/partnership-why-not.png" alt=""
                                class="mt-1.5 lg:mt-0 max-w-14 h-auto">
                            <div class="flex flex-col lg:gap-2">
                                <h1 class="font-semibold text-2xl text-gray-200">Why the fxxx not?</h1>
                                <p class="text-sm text-gray-200">So, what's holding you back? The time is now, let's make something epic together!</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 hidden lg:block">
                        <div class="flex gap-4 items-end justify-end">
                            <p class="font-semibold text-2xl text-gray-200 text-end">Let's talk,<br>Share ur excitement!
                            </p>
                            <button
                                class="py-3 px-10 bg-primary rounded-lg border-2 border-black shadow-[-6px_6px_rgba(0,0,0,1)] hover:shadow-none hover:-translate-x-1 hover:translate-y-1 transition"><a
                                    href="#" class="font-bold text-2xl text-white">Send us a mail</a></button>
                        </div>
                        <p class="text-gray-200 text-end mt-2">Send mail to <span
                                class="color-primary">contact@bvcklesmiggle.com</span>, or just click the button above
                            ^^^^^</p>
                    </div>
                </div>
                <div class="col-span-3 flex flex-col mt-10 lg:mt-0">
                    <p class="sponsorsTitle text-end font-semibold text-2xl text-gray-200 pb-2">In they, we trust (each
                        other)</p>
                    <div class="sponsors w-full border-2 border-gray-200 overflow-y-auto">
                        <div class="grid lg:grid-cols-2 gap-3 p-3">
                            @for ($i = 0; $i < 12; $i++)
                                <a href="#">
                                    <img src="/img/sponsor.png" alt="" class="sponsor-image">
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @vite('resources/js/partnership.js')
</x-layout>
