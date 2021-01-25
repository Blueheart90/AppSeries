<article class="p-2">
    <div class="text-lg py-1 px-4 text-teal-600 font-bold">{{$titulo}}</div>
    <ul class=" pt-2">

        @forelse ($topRatedTv as $tvshow)
            <li class="{{ $loop->iteration == $take ? '' : 'mb-2' }}">
                <div class="flex">
                    <div class="flex-none relative">
                        <figure >
                            <a href="">
                                <span class="absolute pl-3.5 pr-2  bg-teal-500 rounded-br-md text-white font-bold text-xs">{{$loop->iteration}}</span>
                                <span class="absolute bottom-0 right-0 px-2  bg-teal-500 rounded-tl-md text-white text-xs">{{ $tvshow['year'] }}</span>
                                <img class=" w-16" src="{{ $tvshow['poster_path'] }}" alt="poster">
                            </a>
                        </figure>
                    </div>
                    <div class="flex-1 p-2 flex flex-col justify-center items-center">
                        <h3 class="font-bold text-teal-500">
                            <a href="">{{ $tvshow['name']}}</a>
                        </h3>
                        <span class="info text-sm italic ">Tv Show, score:
                            <span class=" text-yellow-400 font-bold">{{ $tvshow['vote_average'] }}</span>
                        </span>
                    </div>

                </div>
            </li>
            @break($loop->iteration == $take)

        @empty
            <p>No Hay Resultados</p>
        @endforelse
    </ul>
</article>
