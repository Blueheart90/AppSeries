<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inicio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-contenido>
                    <x-slot name="titulo">
                        Series Mas Populares
                    </x-slot>
<!-- Swiper -->
<div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="https://i.ibb.co/dGY5GdR/1.jpg" alt="img"></div>
      <div class="swiper-slide">Slide 2</div>
      <div class="swiper-slide">Slide 3</div>
      <div class="swiper-slide">Slide 4</div>
      <div class="swiper-slide">Slide 5</div>
      <div class="swiper-slide">Slide 6</div>
      <div class="swiper-slide">Slide 7</div>
      <div class="swiper-slide">Slide 8</div>
      <div class="swiper-slide">Slide 9</div>
      <div class="swiper-slide">Slide 10</div>
    </div>
  </div>


                    {{-- <div class="container mx-auto px-4 pt-16">
                        <div class="popular-tv">
                            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Shows</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                                @foreach ($popularTv as $tvshow)
                                    <x-tv-card :tvshow="$tvshow"/>
                                @endforeach
                            </div>
                        </div>
                    </div> --}}
                </x-contenido>


            </div>
        </div>
    </div>
</x-app-layout>
