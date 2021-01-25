<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Series
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-contenido>
                    <x-slot name="titulo">
                        Tendencia Esta Semana
                    </x-slot>
                    <x-swiper>
                        @foreach ($trendingTv as $tvshow)
                            <x-tv-card :tvshow="$tvshow" isslider="true"/>
                        @endforeach
                    </x-swiper>
                    <div class="grid grid-cols-4 gap-4 mt-6" x-data="{ selected: 'option-1' }">
                        <div class="col-span-3">
                            <ul class="flex text-lg mb-4" >
                                <li class="px-4 py-2" :class="{ 'border-b-2 border-teal-400 text-gray-800 font-bold': selected === 'option-1' }">
                                  <a href="#option-1" @click="selected = 'option-1'">Estrenos</a>
                                </li>
                                <li class="px-4 py-2" :class="{ 'border-b-2 border-teal-400 text-gray-800 font-bold': selected === 'option-2' }">
                                  <a href="#option-2" @click="selected = 'option-2'">Populares</a>
                                </li>
                                <li class="px-4 py-2" :class="{ 'border-b-2 border-teal-400 text-gray-800 font-bold': selected === 'option-3' }">
                                  <a href="#option-3" @click="selected = 'option-3'">Al Aire</a>
                                </li>
                            </ul>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4"  x-show.transition.in.opacity.duration.750ms="selected === 'option-2'">
                                @foreach ($popularTv as $tvshow)
                                    <x-tv-card class="" :tvshow="$tvshow"/>
                                @endforeach

                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4"  x-show.transition.in.opacity.duration.750ms="selected === 'option-3'">
                                @foreach ($onAirTv as $tvshow)
                                    <x-tv-card class="" :tvshow="$tvshow"/>
                                @endforeach

                            </div>
                        </div>

                        <div class="side-r">
                            <x-widget-side :topRatedTv="$topRatedTv" take="5">
                                <x-slot name="titulo">
                                    Mejor Calificadas
                                </x-slot>
                            </x-widget-side>
                        </div>

                    </div>
                </x-contenido>
            </div>
        </div>
    </div>

</x-app-layout>

