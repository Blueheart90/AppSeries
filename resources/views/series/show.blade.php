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
    @dump($info)
    @dump($api_flags)
    <div class="py-12" x-data="main()" x-init="init">
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
                                class="min-w-full p-1 my-2 text-sm text-center text-green-500 bg-green-100 border border-green-500 rounded-md "
                                x-show="success"
                                >
                                    Agregada exitosamente
                                </div>

                                {{-- Desplegable con formulario --}}
                                <x-dropdown-form-list :tvshow="$tvshow" />

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
                    <div class="grid grid-cols-4 p-10">
                        <div>
                            <div class="">
                                <h2>Información Adicional</h2>
                                <div>
                                    <span class="font-bold">Primera emision: </span>
                                    01-27-1900
                                </div>
                                <div>
                                    <span class="font-bold">Pagina Web: </span>
                                    01-27-1900
                                </div>
                                <div>
                                    <span class="font-bold">Estado: </span>
                                    En production | Terminada
                                </div>
                                <div>
                                    <span class="font-bold">Ultimo Capitulo: </span>
                                    01-27-1990
                                </div>
                                <div>
                                    <span class="font-bold">Siguiente Capitulo: </span>
                                    01-27-1990
                                </div>
                                <div>
                                    <span class="font-bold">Compañia: </span>
                                    HBO
                                </div>
                                <div>
                                    <span class="font-bold">Temporadas: </span>
                                    10
                                </div>
                                <div>
                                    <span class="font-bold">Capitulos: </span>
                                    10
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/circles/0.0.6/circles.min.js" integrity="sha512-r1w3tnPCKov9Spj2bJGCQQBJ5wcJywFgL79lKMXvzBMXIPFI9xXQDmwuVs+ERh1tnL0UFT1hLrwtKh1z5/XCCQ==" crossorigin="anonymous"></script>
        <script>
            var circles;
            // var colors[];
            const score = document.querySelector('#score').value;

            if (score > 74) {
                // Verde
                var colors = ['#A7F3D0','#10b981'];
            }else if(score > 51){
                // Amarillo
                var colors = ['#FDE68A','#D97706'];
            }else{
                // Rojo
                var colors = ['#FECACA','#DC2626'];
            }

            circles = Circles.create({
                id:         'circles-1',
                value:      score,
                radius:     25,
                width:      4,
                colors:     colors
            });



        </script>
    </div>
</x-app-layout>
