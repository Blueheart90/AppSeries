<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Series
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <x-contenido>
                    <x-slot name="titulo">
                        Tendencia Esta Semana
                    </x-slot>
                    <x-swiper>
                        @foreach ($trendingTv as $tvshow)
                            <x-tv-card :tvshow="$tvshow" isslider="true"/>
                        @endforeach
                    </x-swiper>
                    <div class="grid grid-cols-4 gap-4 mt-6" x-data="main()">
                        <div class="col-span-4 lg:col-span-3">
                            <div class="flex flex-col justify-between sm:flex-row" x-ref="topNav">
                                @php
                                    $navList = [
                                        ['name' => 'Estrenos', 'href' => 'estrenos', 'option' => 'option-1'],
                                        ['name' => 'Populares', 'href' => 'populares', 'option' => 'option-2'],
                                        ['name' => 'Al Aire', 'href' => 'al-aire', 'option' => 'option-3'],
                                        ['name' => 'Categorias', 'href' => 'categorias', 'option' => 'option-4'],
                                ];
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

                            <div class="grid grid-cols-1 gap-4 mt-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5"  x-show.transition.in.opacity.duration.750ms="selected === 'option-1'">


                            </div>
                            <div class="grid grid-cols-1 gap-4 mt-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5"  x-show.transition.in.opacity.duration.750ms="selected === 'option-2'">
                                @foreach ($popularTv as $tvshow)
                                    <x-tv-card class="" :tvshow="$tvshow"/>
                                @endforeach
                            </div>
                            <div class="grid grid-cols-1 gap-4 mt-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5"  x-show.transition.in.opacity.duration.750ms="selected === 'option-3'">
                                @foreach ($onAirTv as $tvshow)
                                    <x-tv-card class="" :tvshow="$tvshow"/>
                                @endforeach
                            </div>
                            <div class="mt-8"  x-show.transition.in.opacity.duration.750ms="selected === 'option-4'">
                                <h3 class="mb-4 ml-4">Filtrar Por Categoria:</h3>
                                <x-widget-genres class="mb-4" :genres="$genres"></x-widget-genres>
                                <x-search-results></x-search-results>

                            </div>
                            <div class="mt-8" x-show.transition.in.opacity.duration.750ms="selected === 'search'">
                                <x-search-results></x-search-results>
                                <div class="flex flex-col items-center my-12">
                                    <div class="flex text-gray-700">
                                        <button class="flex items-center justify-center w-8 h-8 mr-1 bg-gray-200 rounded-full cursor-pointer focus:outline-none active:bg-teal-300" @click="prevPage($refs.topNav)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 feather feather-chevron-left">
                                                <polyline points="15 18 9 12 15 6"></polyline>
                                            </svg>
                                        </button>
                                        <div class="flex h-8 font-medium bg-gray-200 rounded-full select-none">

                                            <template x-for="(page, index) in array_pages">
                                                <div class="items-center justify-center hidden w-8 leading-5 transition duration-150 ease-in rounded-full cursor-pointer md:flex " :class="{'text-white bg-pink-600' : current_page === array_pages[index] }" @click="current_page = array_pages[index], update_page()" x-text="array_pages[index]"></div>
                                            </template>

                                            <div class="items-center justify-center hidden w-8 leading-5 transition duration-150 ease-in rounded-full cursor-pointer md:flex ">de</div>
                                            <div class="items-center justify-center hidden w-8 leading-5 transition duration-150 ease-in rounded-full cursor-pointer md:flex " x-text="total_pages"></div>

                                            <div class="flex items-center justify-center w-8 h-8 leading-5 text-white transition duration-150 ease-in bg-pink-600 rounded-full cursor-pointer md:hidden" x-text="current_page"></div>
                                        </div>
                                        <button class="flex items-center justify-center w-8 h-8 ml-1 bg-gray-200 rounded-full cursor-pointer focus:outline-none active:bg-teal-300" @click="nextPage($refs.topNav)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 feather feather-chevron-right">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- <button @click="$refs.topNav.scrollIntoView()">subir</button> --}}
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
                total_pages: 0,
                current_page: 1,
                array_pages: [1],
                pages: function(){
                    // Devulve un array de 7 o menos dependiendo del numero de paginas totales
                    // this.current_page = 1;
                    if (this.total_pages <= 6) {
                        this.array_pages = Array.from({length: this.total_pages}, (v, i) => i + 1);
                    }else{
                        this.array_pages = Array.from({length: 7}, (v, i) => i + 1);
                    }

                },
                prevPage: function(a){
                    if (this.current_page > 1) {
                        this.current_page--;
                        this.update_page();
                        console.log(this.current_page);
                        if (this.array_pages[0] > 1) {
                            this.array_pages = Array.from(this.array_pages, x => x - 1);
                        }
                        this.update_page();
                        setTimeout(function(){ a.scrollIntoView({ behavior: 'smooth' }); }, 500);
                    }


                },
                nextPage: function(a){
                    if (this.current_page < this.total_pages) {

                        if (this.array_pages.indexOf(this.current_page) < 4) {

                            this.current_page++;
                            console.log('menor a 4 ', this.array_pages.indexOf(this.current_page));

                        }else{
                            // solo actializa el array si el ultimo item es menor del total de paginas
                            if (this.array_pages[this.array_pages.length - 1] < this.total_pages ) {

                                this.array_pages = Array.from(this.array_pages, x => x + 1);
                                this.current_page++;

                            }else{
                                // si el vector ya llego a su fin (el ultimo item es = total_pages, incrementa current_page)
                                this.current_page++;
                            }
                        }
                        this.update_page();
                        setTimeout(function(){ a.scrollIntoView({behavior: 'smooth' }); }, 500);
                        // a.scrollIntoView({ behavior: 'smooth' });

                    }
                },
                update_page: function() {
                    // Enviar peticion a axios
                    const config = {
                        headers: {
                            authorization: 'Bearer ' + this.token
                        },
                        params: {
                            language: 'es-mx',
                            query: this.searchValue,
                            page: this.current_page,
                        }
                    };

                    if (this.searchValue) {
                        this.selected = "search";
                        axios
                            .get('https://api.themoviedb.org/3/search/tv', config)
                            .then(respuesta => {

                                this.results = respuesta.data.results;
                                this.total_pages = respuesta.data.total_pages;
                                // var a = respuesta.data.results;
                                // console.log(respuesta.data.results);



                                // console.log(Array.from({
                                //     length: this.total_pages,
                                // }));

                            })
                            .catch(error => console.log(error));
                    }else{
                        this.results = [];
                        this.selected = "option-1";
                    }

                },
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
                    console.table(this.stringGenre);

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
                                this.total_pages = respuesta.data.total_pages;
                                console.log(respuesta.data.total_pages);

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

                    // Establecemos con pagina actual como la primera
                    this.current_page = 1;
                    // Enviar peticion a axios
                    const config = {
                        headers: {
                            authorization: 'Bearer ' + this.token
                        },
                        params: {
                            language: 'es-mx',
                            query: this.searchValue,
                        }
                    };

                    if (this.searchValue) {
                        this.selected = "search";
                        axios
                            .get('https://api.themoviedb.org/3/search/tv', config)
                            .then(respuesta => {

                                this.results = respuesta.data.results;
                                this.total_pages = respuesta.data.total_pages;
                                this.pages();
                                // var a = respuesta.data.results;
                                // console.log(respuesta.data.results);



                                // console.log(Array.from({
                                //     length: this.total_pages,
                                // }));

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

