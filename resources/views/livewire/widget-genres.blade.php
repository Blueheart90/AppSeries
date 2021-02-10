<div {!! $attributes->merge(['class' => 'flex flex-wrap justify-center']) !!}>
    @foreach ($genres as $id => $genre)
        <span class="p-1 mb-2 ml-2 bg-gray-200 rounded-full cursor-pointer select-none active:bg-teal-300 hover:bg-teal-400 hover:text-white" :class="{ 'bg-teal-400 text-white': selectedGenre.includes({{$id}}) }" @click="addGenres({{$id}})">{{ $genre }}</span>
    @endforeach
</div>
