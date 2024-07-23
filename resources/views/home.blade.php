<x-layout>
    {{-- <main class="max-container padding-container"> --}}
    <main class="mb-36">
        <section class="max-container padding-container">
            <img src="/img/banner.png" alt="" class="img-fluid w-full my-4 border-2 border-gray-200">
            <h1 class="font-bold text-gray-200 text-6xl"><span class="color-primary">></span>SHOUT OUT<span
                    class="color-primary">__</span></h1>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2 gap-4">
                    <div class="flex justify-between items-end">
                        <p class="font-semibold text-2xl text-gray-200 max-w-[30%]">We are a<br>creative-smith<br>at the
                            intersection<br>of craft, community,<br>music, and lifestyle.</p>
                        <div class="flex justify-end ms-20 me-5 flex-grow">
                            <img src="/img/home.png" alt="" class="max-w-[70%] h-auto">
                            {{-- <img src="/img/home.png" alt="" class="img-fluid"> --}}
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-end justify-end gap-10">
                    <p class="text-end text-lg text-gray-200">Our goal is to deliver amazing<br>experiences that
                        make<br>people "awake" with<br>encourage their<br>deepest desire<br>at lifestyle,<br>arts,
                        and<br>culture.</p>
                    <img src="/img/v.png" alt="" class="img-fluid">
                </div>
            </div>
        </section>
        <section class="relative max-container mt-10">
            <div class="flex justify-between items-center">
                <img src="/img/events.png" alt="" class="img-fluid padding-container">
                <div class="flex flex-col gap-8 padding-container">
                    <h1 class="font-bold text-gray-200 text-6xl text-end"><span class="color-primary">></span>EVENTS,
                        MUSIC, <br>AND OTHER <br>SINS<span class="color-primary">__</span></h1>
                    <p class="font-semibold text-2xl text-gray-200 text-end">Keep update<br>and
                        still<br>rockNroll<br>with our<br>news and<br>field report.</p>
                    <button class="block ms-auto mt-24 py-5 px-10 bg-primary rounded-lg border-2 border-black shadow-[-6px_6px_rgba(0,0,0,1)] hover:shadow-none hover:-translate-x-1 hover:translate-y-1 transition"><a
                            href="#" class="font-bold text-2xl text-white">Check the hype!</a></button>
                </div>
            </div>
            <div class="absolute left-0 bottom-0 -translate-y-24 w-full -z-10">
              <hr class="border-zinc-500">
            </div>
        </section>
    </main>
</x-layout>
