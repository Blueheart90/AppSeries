<div class="mt-4" x-data="{
    content: @entangle('content'),
    recommended: @entangle('recommended'),
    showForm: @entangle('showForm'),

}">
    {{-- @dump($oldData) --}}
    <h2 class="mb-4 text-lg font-bold">{{ __('Reviews') }}</h2>
    @if ($allReviews->isEmpty())
        <div class="flex justify-center py-8 border border-green-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mr-2 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-lg leading-loose text-cool-gray-800">
                No existen reseñas para mostrar. Se el primero en añadir una
            </span>
        </div>
    @else
        @foreach ($allReviews as $review)
            <div>
                <div class="flex w-full">
                    <img class="object-cover w-16 h-16 mr-4 rounded-full " src="{{ $review->user->profile_photo_url }}" alt="{{ $review->user->name }}" />
                    <div class="flex justify-between w-full">
                        <div>
                            <p class="mb-2">{{ $review->user->name }}</p>
                            <div class="flex">
                                @if ($review->recommended)
                                    <div class="px-2 py-1 rounded-l-xl bg-cool-gray-600">
                                        <x-like-svg class="text-green-400 " ></x-like-svg>
                                    </div>
                                    <span class="px-2 py-1 text-gray-800 bg-green-400 rounded-r-xl">Recomendado</span>
                                @else
                                    <div class="px-2 py-1 rounded-l-xl bg-cool-gray-600">
                                        <x-dislike-svg class="text-red-400 " ></x-dislike-svg>
                                    </div>
                                    <span class="px-2 py-1 text-gray-800 bg-red-400 rounded-r-xl">No Recomendado</span>
                                @endif
                            </div>
                        </div>
                        <div class="text-sm text-right text-gray-600 ">
                            <p>Publicado: {{ $review->created_at->diffForHumans() }}</p>
                            <p>Temp vistas: {{ $review->tvlist->season }}</p>
                            <p>Cap vistos: {{ $review->tvlist->episode }}</p>
                        </div>
                    </div>
                </div>
                <p class="mt-4">{!! $review->content !!}</p>
                @if ($review->updated_at != $review->created_at)
                    <p class="text-sm italic text-right text-gray-600 ">Editada {{ \Carbon\Carbon::parse($review->updated_at)->isoFormat('MMMM D, YYYY') }}</p>
                @endif
            </div>
            <hr class="my-4">
        @endforeach
    @endif
    @auth
        <div class="mt-12 ">
            <div class="mb-4 ">
                <img class="float-left object-cover w-20 h-20 mb-4 mr-4 rounded-full " src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                @if ($oldData)
                    <div>
                        <h2 class="text-lg font-bold text-teal-400">Reseñaste esta serie en {{ \Carbon\Carbon::parse($oldData->created_at)->format('M d, Y') }}</h2>
                        <p class="text-gray-500 ">
                            Si quieres puedes editarla y cambiar si la recomiendas.
                            <span class="text-gray-800 cursor-pointer" wire:click="$toggle('showForm')">Editar reseña</span>
                        </p>
                    </div>
                @else
                    <div>
                        <h2 class="text-lg font-bold text-teal-400">Escribe una reseña sobre: <span class="italic">{{ $tvshow['name'] }}</span></h2>
                        <p class="text-gray-500 ">
                            Describe lo que te ha gustado o no de esta serie/pelicula y si se lo recomendarías a otros.
                            Recuerda ser educado/a y seguir las Normas y directrices.
                        </p>
                    </div>

                @endif
            </div>
            <form
                wire:submit.prevent="submit()"
                x-show="showForm"
                x-on:submit.prevent
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 "
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-end="opacity-0"
                >
                <div>
                    <input id="content" name="content" type="hidden" value="{{$content}}" />
                    <div wire:ignore>
                        <trix-editor wire:model.debounce.300ms="content">
                        </trix-editor>
                    </div>
                    @error('content') <span class="text-red-600 ">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-between mt-2">
                    <div>
                        <p class="mb-1">¿Recomiendas esta serie?</p>
                        <x-jet-button type="button" wire:click="$set('recommended', 1)">
                            <x-like-svg class="text-white" x-bind:class="{ ' text-green-400 animate-bounce' : recommended == true }" ></x-like-svg>
                        </x-jet-button>
                        <x-jet-button type="button" wire:click="$set('recommended', 0)">
                            <x-dislike-svg class="text-gray-200 " x-bind:class="{ ' text-red-400 animate-bounce ' : recommended == false }" ></x-dislike-svg>
                        </x-jet-button>
                        @error('recommended') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>
                    @if ($oldData)
                        <x-jet-button type="button"  wire:click="update({{$oldData->id}})" class="self-end h-10 text-sm capitalize">
                            <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            {{ __('Update') }}
                        </x-jet-button>
                    @else
                        <x-jet-button class="self-end h-10 text-sm capitalize">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            {{ __('Add') }}
                        </x-jet-button>
                    @endif
                </div>
            </form>
            <x-flash-messages></x-flash-messages>
        </div>
    @else
        <p class="mt-4 ">»Debes <a href="{{ route('login') }}" class="text-gray-700 underline ">iniciar sesion</a>
            antes de escribir una reseña</p>
    @endauth

</div>
