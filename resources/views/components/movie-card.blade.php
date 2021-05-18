<div class="{{ $isslider  ? 'swiper-slide' : ''}}">
    <a  href="{{ route('pelicula.show', ['pelicula' => $tvshow['id'], 'slug' => $tvshow['slug']]) }}">
        <img  data-src="{{ $tvshow['poster_path'] }}" alt="poster" class="transition duration-150 ease-in-out lazyload hover:opacity-75">
    </a>
    <div class="mt-2">
        <a href="{{ route('pelicula.show', ['pelicula' => $tvshow['id'], 'slug' => $tvshow['slug']]) }}" class="mt-2 text-lg hover:text-gray-300">{{ $tvshow['name'] }}</a>
    </div>
</div>
