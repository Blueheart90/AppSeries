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
                                <ul class="flex text-base sm:text-lg">
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
                                <div class="relative">
                                    <x-jet-input class="focus:outline-none border-none shadow-none leading-tight" placeholder="Buscar serie" x-model="searchValue" @keyUp.debounce.750="search()">

                                    </x-jet-input>
                                    <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
                                        </svg>
                                    </button>
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
                            <div class="mt-8" x-show.transition.in.opacity.duration.750ms="selected === 'search'">
                                <p class="inline text-xl font-bold text-gray-800 border-b-2 border-teal-400">Resultados de la busqueda: </p>
                                <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-4">
                                    <template x-for="[id, value] in Object.entries(results)" :key="id">
                                        <div>
                                            <div class=" relative">
                                                <a  href="">

                                                    <img src="{{ Storage::url('sin-poster.png') }}" x-show="!value.poster_path" alt="poster" class="  hover:opacity-75 transition ease-in-out duration-150">
                                                    <img x-bind:src="'https://www.themoviedb.org/t/p/w440_and_h660_face/' + value.poster_path" x-show="value.poster_path" alt="poster" class="  hover:opacity-75 transition ease-in-out duration-150">
                                                    <span class="absolute bottom-2 right-2 px-2  bg-teal-500 rounded-full text-white text-sm" x-text="truncate(value.first_air_date, 0, 4)"></span>
                                                </a>

                                            </div>
                                            <div class="mt-2">
                                                <a href="" class="text-lg mt-2 hover:text-gray-300" x-text="value.name"></a>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                            </div>
                        </div>

                        <div class="hidden side-r lg:block">
                            <x-widget-genres class=" mb-4" :genres="$genres"></x-widget-genres>
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
                selected: 'option-2',
                selectedGenre: '',
                searchValue: '',
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

