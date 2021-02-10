<div>
    {{-- Pagination --}}
    <div class="flex flex-col items-center my-12">
        <div class="flex text-gray-700">
            <button class="flex items-center justify-center w-8 h-8 mr-1 bg-gray-200 rounded-full cursor-pointer focus:outline-none active:bg-teal-300" @click="prevPage($refs.topNav)">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 feather feather-chevron-left">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <div class="flex h-8 font-medium bg-gray-200 rounded-full select-none">

                <template x-for="(page, index) in array_pages">
                    <div class="items-center justify-center hidden w-8 leading-5 transition duration-150 ease-in rounded-full cursor-pointer md:flex " :class="{'text-white bg-pink-600' : current_page === array_pages[index] }" @click="current_page = array_pages[index], update_page()" x-text="array_pages[index]"></div>
                </template>

                <div class="items-center justify-center hidden w-8 leading-5 transition duration-150 ease-in rounded-full cursor-pointer md:flex ">de</div>
                <div class="items-center justify-center hidden w-8 leading-5 transition duration-150 ease-in rounded-full cursor-pointer md:flex " x-text="total_pages"></div>

                <div class="flex items-center justify-center w-8 h-8 leading-5 text-white transition duration-150 ease-in bg-pink-600 rounded-full cursor-pointer md:hidden" x-text="current_page"></div>
            </div>
            <button class="flex items-center justify-center w-8 h-8 ml-1 bg-gray-200 rounded-full cursor-pointer focus:outline-none active:bg-teal-300" @click="nextPage($refs.topNav)">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </div>
</div>
