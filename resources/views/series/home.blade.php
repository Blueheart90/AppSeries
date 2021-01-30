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
                    <div class="grid grid-cols-4 gap-4 mt-6" x-data="main()" >
                        <div class=" col-span-4 lg:col-span-3">
                            <div class="flex justify-between mb-4 flex-col sm:flex-row">
                                <ul class="flex mb-4 text-base sm:text-lg">
                                    <li class="p-2" >
                                      <a class="select-none" :class="{ 'border-b-2 border-teal-400 text-gray-800 font-bold': selected === 'option-1' }" href="#option-1" @click="selected = 'option-1'">Estrenos</a>
                                    </li>
                                    <li class=" p-2">
                                      <a class="select-none" :class="{ 'border-b-2 border-teal-400 text-gray-800 font-bold': selected === 'option-2' }" href="#option-2" @click="selected = 'option-2'">Populares</a>
                                    </li>
                                    <li class="p-2">
                                      <a class="select-none" :class="{ 'border-b-2 border-teal-400 text-gray-800 font-bold': selected === 'option-3' }" href="#option-3" @click="selected = 'option-3'">Al Aire</a>
                                    </li>
                                </ul>
                                <div>
                                    <x-jet-input placeholder="Buscar serie" x-model="searchValue" @keyUp.debounce.750="search()"></x-jet-input>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4"  x-show.transition.in.opacity.duration.750ms="selected === 'option-2'">
                                @foreach ($popularTv as $tvshow)
                                    <x-tv-card class="" :tvshow="$tvshow"/>
                                @endforeach

                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4"  x-show.transition.in.opacity.duration.750ms="selected === 'option-3'">
                                @foreach ($onAirTv as $tvshow)
                                    <x-tv-card class="" :tvshow="$tvshow"/>
                                @endforeach

                            </div>
                            <div x-show.transition.in.opacity.duration.750ms="selected === 'search'">
                                <p class="inline text-xl font-bold text-gray-800 border-b-2 border-teal-400">Resultados de la busqueda: </p>
                                <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-4">
                                    <template x-for="[id, value] in Object.entries(results)" :key="id">
                                        <div>
                                            <a  href="">

                                                <img src="{{ Storage::url('sin-poster.png') }}" x-show="!value.poster_path" alt="poster" class="  hover:opacity-75 transition ease-in-out duration-150">
                                                <img x-bind:src="'https://www.themoviedb.org/t/p/w440_and_h660_face/' + value.poster_path" x-show="value.poster_path" alt="poster" class="  hover:opacity-75 transition ease-in-out duration-150">

                                            </a>
                                            <div class="mt-2">
                                                <a href="" class="text-lg mt-2 hover:text-gray-300" x-text="value.name"></a>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                            </div>
                        </div>

                        <div class="hidden side-r lg:block">
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
    <script>
        function main(){
            return {
                token: "{{config('services.tmdb.token')}}",
                results: [],
                prueba: 1,
                selected: 'option-1',
                searchValue: '',
                search: function () {
                    // console.log(event.target.value);
                    // console.log(this.searchValue);

                    // Enviar peticion a axios
                    const config = {
                        headers: {
                            authorization: 'Bearer ' + this.token
                        },
                        params: {
                            language: 'es-mx',
                            query: this.searchValue
                        }
                    };

                    if (this.searchValue) {
                        this.selected = "search";
                        axios
                            .get('https://api.themoviedb.org/3/search/tv', config)
                            .then(respuesta => {

                                this.results = respuesta.data.results;
                                // var a = respuesta.data.results;
                                // console.log(respuesta.data.results);



                            })
                            .catch(error => console.log(error));
                    }else{
                        this.results = [];
                        this.selected = "option-1";
                    }
                },

            }
        }
    </script>
</x-app-layout>

