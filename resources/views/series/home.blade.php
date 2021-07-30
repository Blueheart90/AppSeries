<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Series
        </h2>
    </x-slot>
    @dump($genres)
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
                    <div class="grid grid-cols-4 gap-4 mt-6" x-data="main()" >
                        <div class="col-span-4 lg:col-span-3" >
                            <div class="flex flex-col justify-between sm:flex-row" x-ref="topNav">
                                @php
                                    $navList = [
                                        ['name' => 'Populares', 'href' => 'populares', 'option' => 'option-1'],
                                        ['name' => 'Al Aire', 'href' => 'al-aire', 'option' => 'option-2'],
                                        ['name' => 'Categorias', 'href' => 'categorias', 'option' => 'categorias'],
                                ];
                                @endphp
                                <ul class="flex text-base sm:text-lg">
                                    @foreach ($navList as $item)
                                        <li class="p-2" >
                                            <a class="select-none" :class="{ 'border-b-2 border-teal-400 text-gray-800 font-bold': selected === '{{$item['option']}}' }" href="/{{$item['href']}}" x-on:click.prevent @click="selected = '{{$item['option']}}', genreInit()">{{$item['name']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="relative">
                                    <x-jet-input class="" placeholder="Buscar serie" x-model="searchValue" @keyUp.debounce.750="search()">
                                    </x-jet-input>
                                </div>

                            </div>

                            {{-- Secciones --}}
                            <div class="grid grid-cols-1 gap-4 mt-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5"  x-show.transition.in.opacity.duration.750ms="selected === 'option-1'">
                                @foreach ($popularTv as $tvshow)
                                    <x-tv-card class="" :tvshow="$tvshow"/>
                                @endforeach
                            </div>
                            <div class="grid grid-cols-1 gap-4 mt-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5"  x-show.transition.in.opacity.duration.750ms="selected === 'option-2'">
                                @foreach ($onAirTv as $tvshow)
                                    <x-tv-card class="" :tvshow="$tvshow"/>
                                @endforeach
                            </div>
                            <div class="mt-8" x-init=""  x-show.transition.in.opacity.duration.750ms="selected === 'categorias'">
                                <h3 class="mb-4 ml-4">Filtrar Por Categoria:</h3>
                                <x-widget-genres class="mb-4" :genres='$genres'></x-widget-genres>
                                <x-search-results></x-search-results>

                            </div>
                            <div class="mt-8" x-show.transition.in.opacity.duration.750ms="selected === 'search'">
                                <x-search-results></x-search-results>
                            </div>
                        </div>
                        {{-- Aside --}}
                        <div class="hidden side-r lg:block" >
                            {{-- <x-dropdown-genres :genres="$genres" ></x-dropdown-genres> --}}
                            {{-- @livewire('dropdown-genres', ['genres' => $genres]) --}}
                            <x-widget-side-tvshows :topRatedTv="$topRatedTv" take="10">
                                <x-slot name="titulo">
                                    Mejor Calificadas
                                </x-slot>
                            </x-widget-side-tvshows>
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
                    }
                },
                update_page: function() {
                    // Configuracion de la peticion
                    const config = {
                        headers: {
                            authorization: 'Bearer ' + this.token
                        },
                        params: {
                            language: 'es-mx',
                            query: this.searchValue,
                            page: this.current_page,
                            with_genres: this.stringGenre
                        }
                    };
                    if (this.selected === 'search') {
                        // Enviar peticion a axios
                        axios
                            .get('https://api.themoviedb.org/3/search/tv', config)
                            .then(respuesta => {

                                this.results = respuesta.data.results;

                            })
                            .catch(error => console.log(error));
                    }else{
                        axios
                            .get('https://api.themoviedb.org/3/discover/tv', config)
                            .then(respuesta => {

                                this.results = respuesta.data.results;

                            })
                            .catch(error => console.log(error));
                    }
                },
                addGenres: function(id) {
                    this.current_page = 1;

                    // Remueve el genero si este existe en el array o lo agrega al final del mismo
                    if (this.selectedGenre.includes(id)) {
                        const i = this.selectedGenre.indexOf(id);
                        this.selectedGenre.splice(i, 1);
                    } else {
                        this.selectedGenre.push(id);
                    }
                    // convierte array a string separado por comas (,)
                    this.stringGenre = this.selectedGenre.join();

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
                                this.total_pages = respuesta.data.total_pages;
                                this.pages();

                            })
                            .catch(error => console.log(error));
                    }else{
                        this.results = [];
                    }
                },
                truncate: function(string, num1, num2) {
                    // dar formato a la fecha (ej. 2020)
                    if (string) {
                        return string.slice(num1, num2);
                    }
                },
                search: function () {

                    // Establecemos con pagina actual como la primera
                    this.current_page = 1;

                    this.stringGenre = null;

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

                    // Comprueba que haya algo en el input para realizar la busqueda
                    if (this.searchValue) {
                        this.selected = "search";
                        axios
                            .get('https://api.themoviedb.org/3/search/tv', config)
                            .then(respuesta => {

                                this.results = respuesta.data.results;
                                this.total_pages = respuesta.data.total_pages;
                                this.pages();
                            })
                            .catch(error => console.log(error));
                    }else{
                        this.results = [];
                        this.selected = "option-1";
                    }
                },
                genreInit: function() {
                    this.results = [];
                    this.current_page = 1;
                    this.selectedGenre = [];
                    this.searchValue = '';
                },
                string_to_slug: function (str) {
                    str = str.replace(/^\s+|\s+$/g, ''); // trim
                    str = str.toLowerCase();

                    // remove accents, swap ñ for n, etc
                    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                    var to   = "aaaaeeeeiiiioooouuuunc------";
                    for (var i=0, l=from.length ; i<l ; i++) {
                        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                    }

                    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                        .replace(/\s+/g, '-') // collapse whitespace and replace by -
                        .replace(/-+/g, '-'); // collapse dashes

                    return str;
                },
                route: function(id, slug) {

                    var link = id.toString().concat('/', this.string_to_slug(slug));
                    var url = "{{ route('serie.show', ['serie' => 'id', 'slug' => 'slug']) }}";
                    url = url.replace('id/slug', link);
                    return url;

                }
            }
        }
    </script>
</x-app-layout>

