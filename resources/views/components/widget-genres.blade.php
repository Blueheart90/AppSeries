<div {!! $attributes->merge(['class' => 'flex flex-wrap justify-center']) !!}>
    @foreach ($genres as $id => $genre)
        <span class="select-none active:bg-teal-300 hover:bg-teal-400 hover:text-white cursor-pointer ml-2 mb-2 p-1 bg-gray-200 rounded-full" :class="{ 'bg-teal-400 text-white': selectedGenre.includes({{$id}}) }" @click="addGenres({{$id}})">{{ $genre }}</span>
    @endforeach
</div>


