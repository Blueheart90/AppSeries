<div>
    <div x-show="results.length != 0">
        <p class="inline text-xl font-bold text-gray-800 border-b-2 border-teal-400">Resultados de la busqueda: </p>
        <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
            <template x-for="[id, value] in Object.entries(results)" :key="id">
                <div>
                    <div class="relative ">
                        <a  href="">

                            <img src="{{ Storage::url('sin-poster.png') }}" x-show="!value.poster_path" alt="poster" class="transition duration-150 ease-in-out hover:opacity-75">
                            <img x-bind:src="'https://www.themoviedb.org/t/p/w440_and_h660_face/' + value.poster_path" x-show="value.poster_path" alt="poster" class="transition duration-150 ease-in-out hover:opacity-75">
                            <span class="absolute px-2 text-sm text-white bg-teal-500 rounded-full bottom-2 right-2" x-text="truncate(value.first_air_date, 0, 4)"></span>
                        </a>

                    </div>
                    <div class="mt-2">
                        <a href="" class="mt-2 text-lg hover:text-gray-300" x-text="value.name"></a>
                    </div>
                </div>
            </template>
        </div>
        <x-pagination></x-pagination>
    </div>

    <div x-show="results.length === 0" class="flex items-center justify-center mt-20">
        <svg class="w-20 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

        <p class="ml-4 ">No hay conincidencias</p>
    </div>

</div>
