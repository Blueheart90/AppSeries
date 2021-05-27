<div>
    <div x-data="{
        selected: '',
        marker: null,
        item: null,
        indicador: function(e, option) {
            this.marker.style.left = e.offsetLeft+'px';
            this.marker.style.width = e.offsetWidth+'px';
            this.selected = option;
        },
        start: function() {
            this.marker = document.querySelector('#marker');
            this.item = document.querySelectorAll('ul li');

            {{-- Indicamos el item selecionado de inicio --}}
            this.indicador(this.item[0].firstElementChild, 'all');
        }

    }"

    x-init="start() "
        class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="flex flex-col items-center py-20 text-white bg-gray-700">

                    <h2 class="text-5xl text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-red-500 font-monoton">Mis Series/Peliculas</h2>
                    <span>Organiza y lleva el control de tu entretenimiento</span>

                </div>
                <div class="flex flex-col justify-center bg-gray-800 border border-gray-700 sm:flex-row" x-ref="topNav">
                    @php
                        $navList = [
                            ['name' => 'Todo', 'href' => 'todo', 'option' => 'all'],
                            ['name' => 'Viendo', 'href' => 'viendo', 'option' => 'watching'],
                            ['name' => 'Completa', 'href' => 'categorias', 'option' => 'complete'],
                            ['name' => 'En Espera', 'href' => 'en-espera', 'option' => 'onhold'],
                            ['name' => 'Abandonada', 'href' => 'abandonada', 'option' => 'dropped'],
                            ['name' => 'Planeando Ver', 'href' => 'planeando-ver', 'option' => 'plantowatch'],
                    ];
                    @endphp
                    <ul class="relative flex text-base text-white sm:text-lg">
                        @foreach ($navList as $item)
                            <li class="px-4 py-2" >
                                <a class="cursor-pointer select-none " @click="indicador($event.target, '{{$item["option"]}}')" >{{$item['name']}}</a>
                            </li>
                        @endforeach
                        <div id="marker" class="absolute left-0 w-0 h-1 transition-all bg-teal-400 rounded bottom-2"></div>
                    </ul>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                            <livewire:table-list />
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
