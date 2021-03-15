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
    {{-- @dump($tvshow) --}}
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
                            <div>
                                <div class="flex mb-4">
                                      <svg class="mr-2 w-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.327 13.099l-.427-.427.71-.71.424.427-.707.71zm-.417 4.467l-.708-.709-.428.427.707.709.429-.427zm4.09-11.566v16h-24v-16h10.888l-2.888-3.375.781-.625 3.219 3.75 3.219-3.75.781.625-2.888 3.375h10.888zm-21.049 12.993c.674.671 3.362 1.007 6.05 1.007 2.687 0 5.375-.336 6.049-1.007.633-.632.95-2.851.95-5.059 0-2.181-.31-4.351-.93-4.97-.637-.635-3.399-.964-6.141-.964-2.681 0-5.346.314-5.997.964-.603.601-.913 2.668-.931 4.786-.018 2.268.299 4.594.95 5.243zm15.049-5.9c0 1.021.796 1.851 1.802 1.904 1.097.059 2.009-.814 2.009-1.904 0-1.049-.85-1.906-1.907-1.906-1.048 0-1.904.847-1.904 1.906zm4-3.093v-.555h-4v.555h4zm-4 7.988c0 1.062.86 1.907 1.903 1.907 1.058 0 1.907-.858 1.907-1.907s-.85-1.906-1.907-1.906c-1.047 0-1.903.846-1.903 1.906zm4-9.988h-4v.555h4v-.555z"/></svg>
                                    <h2 class="text-lg ">Información Adicional</h2>
                                </div>
                                @foreach ($info as $key => $value)
                                    <div class="mb-2 ">
                                        <span class="block font-bold">{{$key}}</span>
                                        <span class="capitalize">

                                            {!!__($value)!!}
                                        </span>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-span-3">
                            <h2 class="mb-4 text-lg ">Actores</h2>
                            <x-swiper>
                                @foreach ($tvshow['cast'] as $actor)
                                    <div class="swiper-slide">
                                        <a  href="">
                                            <img  data-src="{{ $actor['profile_path'] }}" alt="poster" class="transition duration-150 ease-in-out lazyload hover:opacity-75">
                                        </a>
                                        <div class="mt-2">
                                            <a href="" class="block mt-2 text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                                            <a href="" class="mt-2 text-base text-gray-600">{{ $actor['character'] }}</a>

                                        </div>
                                    </div>

                                @endforeach

                            </x-swiper>
                            <h2 class="mb-4 text-lg ">Videos</h2>
                            <div
                                x-data="{
                                    showModal: false,
                                    urlYt: '',
                                    modal: function(e){
                                        this.showModal = true;
                                        this.urlYt = 'https://www.youtube.com/embed/' + e + '?autoplay=1';
                                    }
                                }"
                            >
                                <div class="flex space-x-4">

                                    @foreach ($tvshow['videos'] as $key => $video)
                                        <a
                                            href=""
                                            @click.prevent="modal('{{$video["key"]}}')"
                                        >
                                            <img
                                                data-src="{{ 'http://i3.ytimg.com/vi/' . $video['key'] . '/hqdefault.jpg' }}"
                                                alt="video"
                                                class="transition duration-150 ease-in-out w-60 lazyload hover:opacity-75"
                                            >
                                        </a>

                                    @endforeach
                                </div>
                                    <template x-if="showModal">
                                        <div
                                            class="fixed inset-0 z-20 w-full h-full overflow-y-auto duration-300 bg-black bg-opacity-50"

                                            x-transition:enter="transition duration-300"
                                            x-transition:enter-start="opacity-0"
                                            x-transition:enter-end="opacity-100"
                                            x-transition:leave="transition duration-300"
                                            x-transition:leave-start="opacity-100"
                                            x-transition:leave-end="opacity-0"
                                            >
                                            <div class="relative mx-2 my-10 opacity-100 sm:w-3/4 md:w-1/2 lg:w-1/3 sm:mx-auto">
                                                <div
                                                class="relative z-20 bg-white rounded-md shadow-lg w-max-content"
                                                @click.away="showModal = false"
                                                x-show="showModal"
                                                x-transition:enter="transition transform duration-300"
                                                x-transition:enter-start="scale-0"
                                                x-transition:enter-end="scale-100"
                                                x-transition:leave="transition transform duration-300"
                                                x-transition:leave-start="scale-100"
                                                x-transition:leave-end="scale-0"
                                                >
                                                <iframe :src="urlYt" allowFullScreen="allowFullScreen" width="800" height="450" frameborder="0"></iframe>
                                                </div>
                                            </div>
                                        </div>

                                    </template>
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
                var colors = ['#D97706','#FDE68A'];
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
