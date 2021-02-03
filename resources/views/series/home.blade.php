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
                            <div class="flex justify-between flex-col sm:flex-row">
                                @php
                                    $navList = [
                                        ['name' => 'Estrenos', 'href' => 'estrenos', 'option' => 'option-1'],
                                        ['name' => 'Populares', 'href' => 'populares', 'option' => 'option-2'],
                                        ['name' => 'Al Aire', 'href' => 'al-aire', 'option' => 'option-3'],
                                        ['name' => 'Categorias', 'href' => 'categorias', 'option' => 'option-4'],
                                    ]
                                @endphp
                                <ul class="flex text-base sm:text-lg">
                                    @foreach ($navList as $item)
                                        <li class="p-2" >
                                            <a class="select-none" :class="{ 'border-b-2 border-teal-400 text-gray-800 font-bold': selected === '{{$item['option']}}' }" href="/{{$item['href']}}" x-on:click.prevent @click="selected = '{{$item['option']}}', filter = false">{{$item['name']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="relative">
                                    <x-jet-input class="" placeholder="Buscar serie" x-model="searchValue" @keyUp.debounce.750="search()">
                                    </x-jet-input>
                                </div>

                            </div>

                            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4"  x-show.transition.in.opacity.duration.750ms="selected === 'option-1'">


                            </div>
                            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4"  x-show.transition.in.opacity.duration.750ms="selected === 'option-2'">
                                @foreach ($popularTv as $tvshow)
                                    <x-tv-card class="" :tvshow="$tvshow"/>
                                @endforeach
                            </div>
                            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4"  x-show.transition.in.opacity.duration.750ms="selected === 'option-3'">
                                @foreach ($onAirTv as $tvshow)
                                    <x-tv-card class="" :tvshow="$tvshow"/>
                                @endforeach
                            </div>
                            <div class="mt-8"  x-show.transition.in.opacity.duration.750ms="selected === 'option-4'">
                                <h3 class="ml-4 mb-4">Filtrar Por Categoria:</h3>
                                <x-widget-genres class="mb-4" :genres="$genres"></x-widget-genres>
                                <x-search-results></x-search-results>

                            </div>
                            <div class="mt-8" x-show.transition.in.opacity.duration.750ms="selected === 'search'">
                                <x-search-results></x-search-results>
                                <div class="flex flex-col items-center my-12">
                                    <div class="flex text-gray-700">
                                        <div class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left w-4 h-4">
                                                <polyline points="15 18 9 12 15 6"></polyline>
                                            </svg>
                                        </div>
                                        <div class="flex h-8 font-medium rounded-full bg-gray-200">
                                            <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  rounded-full  ">1</div>
                                            <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  rounded-full  ">...</div>
                                            <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  rounded-full  ">3</div>
                                            <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  rounded-full bg-pink-600 text-white ">4</div>
                                            <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  rounded-full  ">5</div>
                                            <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  rounded-full  ">...</div>
                                            <div class="w-8 md:flex justify-center items-center hidden  cursor-pointer leading-5 transition duration-150 ease-in  rounded-full  ">15</div>
                                            <div class="w-8 h-8 md:hidden flex justify-center items-center cursor-pointer leading-5 transition duration-150 ease-in rounded-full bg-pink-600 text-white">4</div>
                                        </div>
                                        <div class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right w-4 h-4">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg>
                                        </div>
                                    </div>
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
                filter: false,
                selected: 'option-1',
                selectedGenre: [],
                stringGenre: '',
                searchValue: '',
                addGenres: function(id) {

                    // Remueve el genero si este existe en el array o lo agrega al final del mismo
                    if (this.selectedGenre.includes(id)) {
                        const i = this.selectedGenre.indexOf(id);
                        this.selectedGenre.splice(i, 1);
                    } else {
                        this.selectedGenre.push(id);
                    }
                    // convierte array a string separado por comas (,)
                    this.stringGenre = this.selectedGenre.join();
                    console.log(this.stringGenre);

                    // Enviar peticion a axios
                    const config = {
                        headers: {
                            authorization: 'Bearer ' + this.token
                        },
                        params: {
                            language: 'es-mx',
                            with_genres: this.stringGenre
                        }
                    };
                    if (this.stringGenre) {
                        axios
                            .get('https://api.themoviedb.org/3/discover/tv', config)
                            .then(respuesta => {

                                this.results = respuesta.data.results;
                                // var a = respuesta.data.results;
                                console.log(respuesta.data.results);



                            })
                            .catch(error => console.log(error));
                    }else{
                        this.results = [];
                    }
                },
                truncate: function(string, num1, num2) {
                    if (string) {
                        return string.slice(num1, num2);
                    }
                },
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
                        this.filter = false;
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

