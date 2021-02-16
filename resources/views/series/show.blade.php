<x-app-layout>
    <style>
        .circles-wrp {
            border-radius: 9999px;
            border-width: 4px;
            border-color: black;
            background-color: black;
        }
    </style>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $tvshow['name'] }}
        </h2>
    </x-slot>
    @dump($tvshow['seasons'])
    @dump($tvshow['stringEpCount'])


    <div class="py-12" x-data="main()">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="bg-white ">
                    <div
                        class="bg-no-repeat bg-cover "
                        style="background-image: linear-gradient(90deg, rgba(35,36,51,0.711922268907563) 53%, rgba(59, 130, 246,0.76234243697479) 100%), url('{{ $tvshow["random_bg"] }}')">
                        <div class="grid grid-cols-4 gap-8 p-10 text-white">
                            <div>
                                <figure class="">
                                    <img  src="{{ $tvshow['poster_path'] }}" alt="poster" class="transition duration-150 ease-in-out rounded-sm lazyload hover:opacity-75">

                                </figure>
                                <div
                                    class="flex px-2 py-1 mt-2 bg-gray-700 border border-gray-200 rounded-t-md"
                                    :class="{ 'rounded-b-md' : open === false }"
                                >
                                    <span class="flex-grow select-none">Añadir a mi lista</span>

                                    <svg
                                        class="w-6 transition duration-500 ease-in-out cursor-pointer "
                                        :class="{'transform rotate-180 ' : open}"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        @click="open = !open"
                                        >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <div
                                    class="flex flex-wrap p-4 text-sm text-gray-700 bg-gray-200 bg-opacity-75 rounded-b-md "
                                    x-show="open"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 "
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-end="opacity-0"
                                >
                                    <div class="flex mb-2">
                                        <x-jet-label class="pr-2 text-white">Estado</x-jet-label>
                                        <select class="rounded-sm " name="state" id="state">
                                            <option disabled selected>Seleccione Estado</option>
                                            <option value="1">Viendo</option>
                                            <option value="2">Completa</option>
                                            <option value="3">En Espera</option>
                                            <option value="4">Abandonada</option>
                                            <option value="5">En Plan Para Ver</option>
                                        </select>
                                    </div>
                                    <div class="flex mb-2">
                                        <x-jet-label class="pr-2 text-white">Temporada</x-jet-label>
                                        <select
                                            class="px-2 rounded-sm "
                                            name="season"
                                            id="season"
                                            x-model="season"
                                        >
                                            @foreach ($tvshow['seasons'] as $key => $value)
                                                @if ($key != 0)
                                                    <option value="{{ $key }}">{{ $key }}</option>

                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex mb-2">
                                        <x-jet-label class="pr-2 text-white">Cap. Vistos</x-jet-label>
                                        <input class="w-10 px-2 rounded-sm" >
                                        <span class="pl-2 ">/</span>
                                        <span class="pl-2 " x-text="getCountEp(season - 1)"></span>
                                    </div>
                                    <div class="flex mb-4">
                                        <x-jet-label class="pr-2 text-white">Puntuación</x-jet-label>
                                        <select class="rounded-sm" name="state" id="state">
                                            <option disabled selected>Seleccione</option>
                                            <option value="10">(10) Masterpiece</option>
                                            <option value="9">(9) Great</option>
                                            <option value="8">(8) Very Good</option>
                                            <option value="7">(7) Good</option>
                                            <option value="6">(6) Fine</option>
                                            <option value="5">(5) Average</option>
                                            <option value="4">(4) Bad</option>
                                            <option value="3">(3) Very Bad</option>
                                            <option value="2">(2) Horrible</option>
                                            <option value="1">(1) Appalling</option>
                                        </select>
                                    </div>
                                    <x-jet-button color="gray" class="min-w-full" @click="prueba()">
                                        <svg class="w-6 pr-2 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Añadir</span>
                                    </x-jet-button>
                                </div>
                            </div>
                            <div class="col-span-3 ">
                                <h2 class="pb-4 text-xl font-bold">{{ $tvshow['name'] }}({{$tvshow['year']}})</h2>
                                <div class="flex items-center pb-4">
                                    <div class="pr-2 circle" id="circles-1"></div>
                                    <p>Puntuación De Usuarios</p>
                                    <input class="hidden" id="score" type="text" value={{$tvshow['vote_average']}}>
                                </div>
                                <p class="pb-4">{{$tvshow['overview']}}</p>
                                <p class="pb-4 italic">{{$tvshow['tagline']}}</p>
                                <p class=""><span class="font-extrabold ">Generos:</span>
                                    {{$tvshow['genres']}}
                                </p>
                                @if ($tvshow['cast'])
                                    <p class=""><span class="font-extrabold ">Elenco:</span>

                                        @foreach ($tvshow['cast'] as $actor)
                                            @if(!$loop->last)
                                                {{$actor['name']}},

                                            @else
                                                {{$actor['name']}}
                                            @endif
                                        @endforeach

                                    </p>
                                @endif
                                @if ($tvshow['created_by'])
                                    <p class=""><span class="font-extrabold ">Creado por:</span>

                                        @foreach ($tvshow['created_by'] as $creador)
                                            @if(!$loop->last)
                                                {{$creador['name']}},

                                            @else
                                                {{$creador['name']}}
                                            @endif
                                        @endforeach

                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="p-10">

                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat voluptates voluptatum exercitationem corporis adipisci a. Atque consequatur optio nobis? Reprehenderit quos magni ducimus a eum quibusdam voluptatum earum doloribus nihil.
                        Earum, ratione! Quam, reprehenderit, ipsam quia, officiis magnam itaque dolorem rem vero dolorum optio facere. Voluptatum ex sit dolor voluptate iste accusantium explicabo sint, fugiat earum aspernatur perferendis sed omnis?
                        Error magni quod veniam corporis reiciendis impedit minus in. Quos alias esse magnam ipsa. Perspiciatis alias porro tenetur necessitatibus officia exercitationem, laboriosam repellat dolorum sit hic excepturi aperiam unde? Voluptatum.
                        Ex cupiditate ullam quos est itaque provident tempora, similique mollitia officia dicta cum iure, explicabo quasi corporis nulla neque dolorem, vero illum sequi ut quas? Dicta explicabo deserunt ipsum unde.</p>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/circles/0.0.6/circles.min.js" integrity="sha512-r1w3tnPCKov9Spj2bJGCQQBJ5wcJywFgL79lKMXvzBMXIPFI9xXQDmwuVs+ERh1tnL0UFT1hLrwtKh1z5/XCCQ==" crossorigin="anonymous"></script>
        <script>
            var circles;
            const score = document.querySelector('#score').value;
            circles = Circles.create({
                id:         'circles-1',
                value:      score,
                radius:     25,
                width:      4,
                colors:     ['rgba(167, 243, 208, 1)', '#10b981']
            });

            function main(){
                return {
                    stringEp: "{{ $tvshow['stringEpCount'] }}",
                    arrayEp: [],
                    open: false,
                    season: 1,
                    stringToArray: function(string) {
                        this.arrayEp = string.split(',')
                    },
                    getCountEp: function(s) {
                        this.stringToArray(this.stringEp);
                        return this.arrayEp[s];
                    },
                    prueba: function() {
                        this.stringToArray(this.stringEp);
                    },


                }
            }

        </script>
    </div>
</x-app-layout>
