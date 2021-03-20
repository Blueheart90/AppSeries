<x-app-layout>
    <style>
        .circles-wrp {
            border-radius: 9999px;
            border-width: 4px;
            border-color: black;
            background-color: black;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.css" integrity="sha512-B+BE8OTmZEKa6ZRDnr0D14iAf88WGckI2ph0s8b+KXCKJc/sotEMEwOlpCuhCU9rAGox1g4i4vEsCpd0fzza9g==" crossorigin="anonymous" />
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $tvshow['name'] }}
        </h2>
    </x-slot>
    <div class="py-12" x-data="main()" x-init="init">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="bg-white ">
                    <div
                        class="bg-no-repeat bg-cover "
                        style="background-image: linear-gradient(90deg, rgba(35,36,51,0.711922268907563) 53%, rgba(59, 130, 246,0.76234243697479) 100%), url('{{ $tvshow["random_bg"] }}')">
                        <div class="grid grid-flow-row gap-8 p-10 text-white md:grid-cols-6 md:grid-flow-col ">
                        {{-- <div class="flex flex-col content-center p-10 text-white md:flex-row "> --}}
                        {{-- <div class="grid grid-cols-4 gap-8 p-10 text-white"> --}}
                            <div class="md:col-span-2">
                                <figure class="flex flex-col">
                                    <img  src="{{ $tvshow['poster_path'] }}" alt="poster" class="transition duration-150 ease-in-out rounded-sm lazyload hover:opacity-75">
                                    {{-- Desplegable con formulario --}}
                                    <div>
                                        <div
                                            class="min-w-full p-1 my-2 text-sm text-center text-green-500 bg-green-100 border border-green-500 rounded-md "
                                            x-show="success"
                                            >
                                            Agregada exitosamente
                                        </div>
                                        <x-dropdown-form-list :tvshow="$tvshow" />
                                    </div>
                                </figure>
                            </div>
                            <div class="md:col-span-4">
                            {{-- <div class="col-span-3 "> --}}
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
                    <div class="p-10 md:grid md:gap-4 md:grid-flow-col md:grid-cols-4">
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
                        <div class="md:col-span-3">
                            <h2 class="mb-4 text-lg font-bold ">Actores</h2>
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
                            <div x-data="{ selected: 'videos' }">
                                <div class="flex flex-col justify-between max-w-full mb-4 sm:flex-row" x-ref="topNav">
                                    @php
                                        $navList = [
                                            ['name' => 'Videos', 'href' => 'videos', 'option' => 'videos'],
                                            ['name' => 'Imagenes', 'href' => 'imagenes', 'option' => 'images'],
                                    ];
                                    @endphp
                                    <ul class="flex text-base sm:text-lg">
                                        @foreach ($navList as $item)
                                            <li class="p-2" >
                                                <a class="select-none" :class="{ 'border-b-2 border-teal-400 text-gray-800 font-bold': selected === '{{$item['option']}}' }" href="/{{$item['href']}}" x-on:click.prevent @click="selected = '{{$item['option']}}', genreInit()">{{$item['name']}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                {{-- Tab Videos --}}
                                <div
                                    x-show.transition.in.opacity.duration.750ms="selected === 'videos'"
                                    >
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 md:grid-cols-4 videoGallery">
                                        @foreach ($tvshow['videos'] as $key => $video)
                                            <a
                                                class="lightBoxVideoLink"
                                                href="https://www.youtube.com/embed/{{$video['key']}}?autoplay=true"
                                                title="{{$video['name']}}"
                                                >
                                                <img
                                                    data-src="{{ 'http://i3.ytimg.com/vi/' . $video['key'] . '/hqdefault.jpg' }}"
                                                    alt="video"
                                                    class="w-48 transition duration-150 ease-in-out lazyload hover:opacity-75"
                                                >
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- Tab Images --}}
                                <div
                                    x-show.transition.in.opacity.duration.750ms="selected === 'images'"
                                    >
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 md:grid-cols-4 imageGallery">
                                        @foreach ($tvshow['backdrops'] as $bd)
                                            <a
                                                href="{{$bd['w1280']}}"
                                                data-caption="
                                                <div class='mx-auto '>
                                                    <a href='{{$bd["original"]}}' target='_blank'>
                                                        <svg class='inline w-8' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4' />
                                                        </svg>
                                                        <span>
                                                            {{$bd['caption']}}
                                                        </span>
                                                    </a>
                                                </div>
                                                "
                                                title=""
                                                {{-- title="<a href='{{$bd["original"]}}' download>{{$bd['caption']}}</a>" --}}
                                            >
                                                <img class="transition duration-150 ease-in-out w-60 lazyload hover:opacity-75" src="{{$bd['thumbnail']}}" alt="Gallery image {{$loop->index}}" />
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/circles/0.0.6/circles.min.js" integrity="sha512-r1w3tnPCKov9Spj2bJGCQQBJ5wcJywFgL79lKMXvzBMXIPFI9xXQDmwuVs+ERh1tnL0UFT1hLrwtKh1z5/XCCQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js" integrity="sha512-OYtVuAy6KSuCAf0HG9j12VF96ehWm00yWBkYAqwzOkGV4WLPCWlOY1q1C3Mr4ouohyL5vEPqTulTyDlT7AHoGQ==" crossorigin="anonymous"></script>
        <script>
            var lightboxImg = new SimpleLightbox({
                elements: '.imageGallery a',
                captionAttribute: 'data-caption'
            });
            var lightboxVideo = new SimpleLightbox({elements: '.videoGallery a'});
            // $('.lightBoxVideoLink').lightboxVideo();



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
