<div>
    <p class="inline text-xl font-bold text-gray-800 border-b-2 border-teal-400">Resultados de la busqueda: </p>
    <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-4">
        <template x-for="[id, value] in Object.entries(results)" :key="id">
            <div>
                <div class=" relative">
                    <a  href="">

                        <img src="{{ Storage::url('sin-poster.png') }}" x-show="!value.poster_path" alt="poster" class="  hover:opacity-75 transition ease-in-out duration-150">
                        <img x-bind:src="'https://www.themoviedb.org/t/p/w440_and_h660_face/' + value.poster_path" x-show="value.poster_path" alt="poster" class="  hover:opacity-75 transition ease-in-out duration-150">
                        <span class="absolute bottom-2 right-2 px-2  bg-teal-500 rounded-full text-white text-sm" x-text="truncate(value.first_air_date, 0, 4)"></span>
                    </a>

                </div>
                <div class="mt-2">
                    <a href="" class="text-lg mt-2 hover:text-gray-300" x-text="value.name"></a>
                </div>
            </div>
        </template>
    </div>
</div>
