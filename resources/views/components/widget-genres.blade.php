<div {!! $attributes->merge(['class' => 'flex flex-wrap justify-center']) !!}>
    @foreach ($genres as $id => $genre)
        <span class="select-none cursor-pointer ml-2 mb-2 p-1 bg-gray-200 rounded-full" :class="{ 'bg-teal-400 text-white': selectedGenre === {{$id}} }" @click="selectedGenre = {{$id}}">{{ $genre }}</span>
        @endforeach
</div>


