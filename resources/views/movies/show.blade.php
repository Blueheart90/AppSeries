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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" />
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $movie['name'] }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="bg-white ">
                    <div
                        class="bg-no-repeat bg-cover "
                        style="background-image: linear-gradient(90deg, rgba(35,36,51,0.711922268907563) 53%, rgba(59, 130, 246,0.76234243697479) 100%), url('{{ $movie["random_bg"] }}')">
                        <div class="grid grid-flow-row gap-8 p-10 text-white md:grid-cols-6 md:grid-flow-col ">
                            <div class="md:col-span-2">
                                <figure>
                                    <img  src="{{ $movie['poster_path'] }}" alt="poster" class="mx-auto transition duration-150 ease-in-out rounded-sm lazyload hover:opacity-75">
                                    {{-- Desplegable con formulario --}}
                                    <div>

                                        {{-- <x-dropdown-form-list :movie="$movie" /> --}}
                                        <livewire:dropdown-add-movie-list :movie="$movie" />

                                    </div>
                                </figure>
                            </div>
                            <div class="md:col-span-4">
                            {{-- <div class="col-span-3 "> --}}
                                <h2 class="text-xl font-bold">{{ $movie['name'] }}({{$movie['year']}})</h2>
                                <div class="flex">
                                    <p class="pb-4">{{ $movie['runtime'] }}</p>
                                    <a class="pl-2 " href="{{ $movie['imdb_link'] }}" target="_blank">
                                        <svg class="w-10 " version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid meet" viewBox="0 0 575 289.83" ><defs><path d="M575 24.91C573.44 12.15 563.97 1.98 551.91 0C499.05 0 76.18 0 23.32 0C10.11 2.17 0 14.16 0 28.61C0 51.84 0 237.64 0 260.86C0 276.86 12.37 289.83 27.64 289.83C79.63 289.83 495.6 289.83 547.59 289.83C561.65 289.83 573.26 278.82 575 264.57C575 216.64 575 48.87 575 24.91Z" id="d1pwhf9wy2"></path><path d="M69.35 58.24L114.98 58.24L114.98 233.89L69.35 233.89L69.35 58.24Z" id="g5jjnq26yS"></path><path d="M201.2 139.15C197.28 112.38 195.1 97.5 194.67 94.53C192.76 80.2 190.94 67.73 189.2 57.09C185.25 57.09 165.54 57.09 130.04 57.09L130.04 232.74L170.01 232.74L170.15 116.76L186.97 232.74L215.44 232.74L231.39 114.18L231.54 232.74L271.38 232.74L271.38 57.09L211.77 57.09L201.2 139.15Z" id="i3Prh1JpXt"></path><path d="M346.71 93.63C347.21 95.87 347.47 100.95 347.47 108.89C347.47 115.7 347.47 170.18 347.47 176.99C347.47 188.68 346.71 195.84 345.2 198.48C343.68 201.12 339.64 202.43 333.09 202.43C333.09 190.9 333.09 98.66 333.09 87.13C338.06 87.13 341.45 87.66 343.25 88.7C345.05 89.75 346.21 91.39 346.71 93.63ZM367.32 230.95C372.75 229.76 377.31 227.66 381.01 224.67C384.7 221.67 387.29 217.52 388.77 212.21C390.26 206.91 391.14 196.38 391.14 180.63C391.14 174.47 391.14 125.12 391.14 118.95C391.14 102.33 390.49 91.19 389.48 85.53C388.46 79.86 385.93 74.71 381.88 70.09C377.82 65.47 371.9 62.15 364.12 60.13C356.33 58.11 343.63 57.09 321.54 57.09C319.27 57.09 307.93 57.09 287.5 57.09L287.5 232.74L342.78 232.74C355.52 232.34 363.7 231.75 367.32 230.95Z" id="a4ov9rRGQm"></path><path d="M464.76 204.7C463.92 206.93 460.24 208.06 457.46 208.06C454.74 208.06 452.93 206.98 452.01 204.81C451.09 202.65 450.64 197.72 450.64 190C450.64 185.36 450.64 148.22 450.64 143.58C450.64 135.58 451.04 130.59 451.85 128.6C452.65 126.63 454.41 125.63 457.13 125.63C459.91 125.63 463.64 126.76 464.6 129.03C465.55 131.3 466.03 136.15 466.03 143.58C466.03 146.58 466.03 161.58 466.03 188.59C465.74 197.84 465.32 203.21 464.76 204.7ZM406.68 231.21L447.76 231.21C449.47 224.5 450.41 220.77 450.6 220.02C454.32 224.52 458.41 227.9 462.9 230.14C467.37 232.39 474.06 233.51 479.24 233.51C486.45 233.51 492.67 231.62 497.92 227.83C503.16 224.05 506.5 219.57 507.92 214.42C509.34 209.26 510.05 201.42 510.05 190.88C510.05 185.95 510.05 146.53 510.05 141.6C510.05 131 509.81 124.08 509.34 120.83C508.87 117.58 507.47 114.27 505.14 110.88C502.81 107.49 499.42 104.86 494.98 102.98C490.54 101.1 485.3 100.16 479.26 100.16C474.01 100.16 467.29 101.21 462.81 103.28C458.34 105.35 454.28 108.49 450.64 112.7C450.64 108.89 450.64 89.85 450.64 55.56L406.68 55.56L406.68 231.21Z" id="fk968BpsX"></path></defs><g><g><g><use xlink:href="#d1pwhf9wy2" opacity="1" fill="#f6c700" fill-opacity="1"></use><g><use xlink:href="#d1pwhf9wy2" opacity="1" fill-opacity="0" stroke="#000000" stroke-width="1" stroke-opacity="0"></use></g></g><g><use xlink:href="#g5jjnq26yS" opacity="1" fill="#000000" fill-opacity="1"></use><g><use xlink:href="#g5jjnq26yS" opacity="1" fill-opacity="0" stroke="#000000" stroke-width="1" stroke-opacity="0"></use></g></g><g><use xlink:href="#i3Prh1JpXt" opacity="1" fill="#000000" fill-opacity="1"></use><g><use xlink:href="#i3Prh1JpXt" opacity="1" fill-opacity="0" stroke="#000000" stroke-width="1" stroke-opacity="0"></use></g></g><g><use xlink:href="#a4ov9rRGQm" opacity="1" fill="#000000" fill-opacity="1"></use><g><use xlink:href="#a4ov9rRGQm" opacity="1" fill-opacity="0" stroke="#000000" stroke-width="1" stroke-opacity="0"></use></g></g><g><use xlink:href="#fk968BpsX" opacity="1" fill="#000000" fill-opacity="1"></use><g><use xlink:href="#fk968BpsX" opacity="1" fill-opacity="0" stroke="#000000" stroke-width="1" stroke-opacity="0"></use></g></g></g></g></svg>
                                    </a>
                                </div>
                                <div class="flex items-center pb-4">
                                    <div class="pr-2 circle" id="circles-1"></div>
                                    <p>Puntuación De Usuarios</p>
                                    <input class="hidden" id="score" type="text" value={{$movie['vote_average']}}>
                                </div>
                                <p class="pb-4">{{$movie['overview']}}</p>
                                <p class="pb-4 italic">{{$movie['tagline']}}</p>
                                <p class=""><span class="font-extrabold ">Generos:</span>
                                    {{$movie['genres']}}
                                </p>
                                @if ($movie['cast'])
                                    <p class=""><span class="font-extrabold ">Elenco:</span>

                                        @foreach ($movie['cast'] as $actor)
                                            @if(!$loop->last)
                                                {{$actor['name']}},

                                            @else
                                                {{$actor['name']}}
                                            @endif
                                        @endforeach

                                    </p>
                                @endif
                                @if ($movie['director'])
                                    <p class=""><span class="font-extrabold ">Director:</span>

                                        @foreach ($movie['director'] as $director)
                                            @if(!$loop->last)
                                                {{$director['name']}},

                                            @else
                                                {{$director['name']}}
                                            @endif
                                        @endforeach

                                    </p>
                                @endif
                                @if ($movie['screenplay'])
                                    <p class=""><span class="font-extrabold ">Guion:</span>

                                        @foreach ($movie['screenplay'] as $person)
                                            @if(!$loop->last)
                                                {{$person['name']}},

                                            @else
                                                {{$person['name']}}
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
                                <svg class="mr-2 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                                </svg>

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
                                @foreach ($movie['cast'] as $actor)
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

                            {{-- Tab navbar --}}
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
                                                <a class="select-none" :class="{ 'border-b-2 border-teal-400 text-gray-800 font-bold': selected === '{{$item['option']}}' }" href="/{{$item['href']}}" x-on:click.prevent @click="selected = '{{$item['option']}}'">{{$item['name']}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                {{-- Tab Videos --}}
                                <div
                                    x-show.transition.in.opacity.duration.750ms="selected === 'videos'"
                                    >
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 md:grid-cols-4 videoGallery">
                                        @foreach ($movie['videos'] as $key => $video)
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
                                        @foreach ($movie['backdrops'] as $bd)
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
                            {{--End Tab navbar --}}
                            <livewire:reviews :apiId="$movie['id']"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/circles/0.0.6/circles.min.js" integrity="sha512-r1w3tnPCKov9Spj2bJGCQQBJ5wcJywFgL79lKMXvzBMXIPFI9xXQDmwuVs+ERh1tnL0UFT1hLrwtKh1z5/XCCQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js" integrity="sha512-OYtVuAy6KSuCAf0HG9j12VF96ehWm00yWBkYAqwzOkGV4WLPCWlOY1q1C3Mr4ouohyL5vEPqTulTyDlT7AHoGQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg==" crossorigin="anonymous"></script>
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
