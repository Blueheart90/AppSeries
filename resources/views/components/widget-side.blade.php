<article class="">
    <div class="text-lg py-1  bg-{{$color}}-300 text-center text-{{$color}}-900 rounded-sm">{{$titulo}}</div>
    <ul class=" pt-2">

        @forelse ($topRatedTv as $tvshow)
            <li class="bg-{{$color}}-100 {{ $loop->iteration == $take ? '' : 'mb-4' }}">
                <div class="flex space-x-2">
                    <div class="flex-none relative">
                        <figure >
                            <a href="">
                                <span class="absolute pl-3.5 pr-2  bg-teal-500 rounded-br-md text-white font-bold text-sm">{{$loop->iteration}}</span>
                                <span class="absolute bottom-0 right-0 px-2  bg-teal-500 rounded-tl-md text-white text-sm">{{ $tvshow['year'] }}</span>
                                <img class=" w-24" src="{{ $tvshow['poster_path'] }}" alt="poster">
                            </a>
                        </figure>
                    </div>
                    <div class="flex-1 p-2">
                        <h3>
                            <a href="">{{ $tvshow['name']}}</a>
                        </h3>
                        <span class="info">Tv, {{ $tvshow['vote_average'] }}</span>
                    </div>

                </div>
            </li>
            @break($loop->iteration == $take)

        @empty
            <p>No Hay Resultados</p>
        @endforelse
    </ul>
</article>
