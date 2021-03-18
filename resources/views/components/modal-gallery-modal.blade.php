<div>
    <h2 class="mb-4 text-lg font-bold">Videos</h2>
    <div
        x-data="{
            showModal: false,
            urlYt: '',
            modal: function(e){
                this.showModal = true;
                this.urlYt = 'https://www.youtube.com/embed/' + e + '?autoplay=1';
            }
        }"
    >
        <div class="flex space-x-4">

            @foreach ($tvshow['videos'] as $key => $video)
                <a
                    href=""
                    @click.prevent="modal('{{$video["key"]}}')"
                >
                    <img
                        data-src="{{ 'http://i3.ytimg.com/vi/' . $video['key'] . '/hqdefault.jpg' }}"
                        alt="video"
                        class="transition duration-150 ease-in-out w-60 lazyload hover:opacity-75"
                    >
                </a>

            @endforeach
        </div>
        <template x-if="showModal">
            <div
                class="fixed inset-0 z-20 w-full h-full overflow-y-auto duration-300 bg-black bg-opacity-50"

                x-transition:enter="transition duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div class="relative mx-2 my-10 opacity-100 sm:w-3/4 md:w-1/2 lg:w-1/3 sm:mx-auto">
                    <div
                        class="relative z-20 bg-white rounded-md shadow-lg w-max-content"
                        @click.away="showModal = false"
                        x-show="showModal"
                        x-transition:enter="transition transform duration-300"
                        x-transition:enter-start="scale-0"
                        x-transition:enter-end="scale-100"
                        x-transition:leave="transition transform duration-300"
                        x-transition:leave-start="scale-100"
                        x-transition:leave-end="scale-0"
                    >
                        <iframe :src="urlYt" allowFullScreen="allowFullScreen" width="800" height="450" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </template>
</div>
