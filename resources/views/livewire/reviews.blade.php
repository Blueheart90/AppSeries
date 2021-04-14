<div class="mt-4" x-data="{
    trix: @entangle('content').defer,
    recommended: @entangle('recommended')
}">
    @dump($allReviews)
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
                    <img class="object-cover w-16 h-16 mr-4 rounded-full " src="{{ $review->user->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
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
                        <div class="text-right ">
                            <p>Publicado: {{ $review->created_at->diffForHumans() }}</p>
                            <p>Temp vistas: {{ $review->tvlist->season }}</p>
                            <p>Cap vistos: {{ $review->tvlist->episode }}</p>
                        </div>
                    </div>
                </div>

                <p class="mt-4">{!! $review->content !!}</p>
            </div>
            <hr class="my-4">
        @endforeach
    @endif
    <div class="mt-12 ">
        <div class="mb-4 ">
            <img class="float-left object-cover w-20 h-20 mr-4 rounded-full " src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            <div>
                <h2 class="text-lg font-bold text-teal-400">Escribe una reseña sobre Path of Exile</h2>
                <p class="text-gray-500 ">
                    Describe lo que te ha gustado o no de esta serie/pelicula y si se lo recomendarías a otros.
                    Recuerda ser educado/a y seguir las Normas y directrices.
                </p>
            </div>
        </div>
        <form wire:submit.prevent="submit()">
            <div>
                <input id="content" name="content" type="hidden" value="{{$content}}" />
                <div wire:ignore>
                    <trix-editor x-model.debounce.300ms="trix">
                    </trix-editor>
                </div>
                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-between mt-2">
                <div>
                    <p class="mb-1">¿Recomiendas esta serie?</p>
                    <x-jet-button type="button" @click="recommended = true">
                        <x-like-svg class="text-white" x-bind:class="{ ' text-green-400 animate-bounce' : recommended === true }" ></x-like-svg>
                    </x-jet-button>
                    <x-jet-button type="button" @click="recommended = false">
                        <x-dislike-svg class="text-gray-200 " x-bind:class="{ ' text-red-400 animate-bounce ' : recommended === false }" ></x-dislike-svg>
                    </x-jet-button>
                </div>
                <x-jet-button class="self-end h-10 text-sm capitalize">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Add') }}
                </x-jet-button>
            </div>

        </form>
    </div>
    {{-- <x-jet-button wire:click="update(1)">Update</x-jet-button> --}}
</div>
