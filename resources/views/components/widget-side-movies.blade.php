<article {!! $attributes->merge(['class' => 'p-2']) !!}>
    <div class="px-4 py-1 text-lg font-bold text-teal-600">{{$titulo}}</div>
    <ul class="pt-2 ">

        @forelse ($topRatedMovie as $movie)
            <li class="{{ $loop->iteration == $take ? '' : 'mb-2' }}">
                <div class="flex">
                    <div class="relative flex-none">
                        <figure >
                            <a href="{{ route('pelicula.show', ['pelicula' => $movie['id'], 'slug' => $movie['slug']]) }}">
                                <span class="absolute pl-3.5 pr-2  bg-teal-500 rounded-br-md text-white font-bold text-xs">{{$loop->iteration}}</span>
                                <span class="absolute bottom-0 right-0 px-2 text-xs text-white bg-teal-500 rounded-tl-md">{{ $movie['year'] }}</span>
                                <img class="w-16 lazyload" data-src="{{ $movie['poster_path'] }}" alt="poster">
                            </a>
                        </figure>
                    </div>
                    <div class="flex flex-col items-center justify-center flex-1 p-2">
                        <h3 class="font-bold text-teal-500">
                            <a href="{{ route('pelicula.show', ['pelicula' => $movie['id'], 'slug' => $movie['slug']]) }}">{{ $movie['name']}}</a>
                        </h3>
                        <span class="text-sm italic info ">Tv Show, score:
                            <span class="font-bold text-yellow-400 ">{{ $movie['vote_average'] }}</span>
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
