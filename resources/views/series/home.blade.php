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
                        Series Populares
                    </x-slot>
                    <x-swiper>
                        @foreach ($popularTv as $tvshow)
                            <x-tv-card :tvshow="$tvshow" isslider="true"/>
                        @endforeach
                    </x-swiper>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-3 bg-gray-600">1</div>

                        <div class="side-r">
                            <x-widget-side :topRatedTv="$topRatedTv" color="blue" take="5">
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

