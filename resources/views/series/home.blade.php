<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Series
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-contenido>
                    <x-slot name="titulo">
                        Series Populares
                    </x-slot>
                    <!-- Swiper -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                             @foreach ($popularTv as $tvshow)
                                <x-tv-card :tvshow="$tvshow" isslider="true"/>
                            @endforeach

                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination pt-5 static"></div>
                        <!-- Add Arrows -->
                        {{-- <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div> --}}
                    </div>
                </x-contenido>
            </div>
        </div>
    </div>
</x-app-layout>

