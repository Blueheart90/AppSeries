<div>
    <div class="flex flex-row-reverse mb-4">
        <div class="px-2 cursor-pointer " @click="filter = !filter ">
            <svg class="w-6" :class="{'transform rotate-180' : filter}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        <span class="text-lg select-none ">Busqueda Avanzada</span>

    </div>
    <div x-show.transition.opacity="filter">
        <h3 class="mb-4 ml-4">Filtrar Por Categoria:</h3>
        <x-widget-genres class="mb-4" :genres="$genres"></x-widget-genres>
    </div>
</div>
