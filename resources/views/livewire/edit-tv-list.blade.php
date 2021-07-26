<div
    x-data="{
        showModal: @entangle('showModal'),
        fields: @entangle('fields'),
        watching_state_id: @entangle('fields.watching_state_id'),
        season: @entangle('fields.season'),
        score_id:  @entangle('fields.score_id'),
        episode:  @entangle('fields.episode')
    }"
    x-init="
        $watch('watching_state_id', value => {
            if (value == '2') {

                $wire.completeTvshow();

            }
        });
        $watch('season', value => {

            $wire.getEpisodesForSeason(season);
        });

    "
>
    <x-modal trigger="showModal" color="black">
        <div class="relative">
            <figure>
                <img  src="{{ $fields['poster'] ? 'https://www.themoviedb.org/t/p/w440_and_h660_face'. $fields['poster'] : 'https://via.placeholder.com/500x750' }}" alt="poster" class="mx-auto rounded-sm lazyload">
            </figure>
            <div class="absolute text-gray-200 top-2 right-2">
                <a class="cursor-pointer " @click="showModal = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
            </div>
        </div>
        <form
            class="flex flex-col justify-center p-4 text-lg text-gray-700 bg-gray-200 bg-opacity-75 rounded-b-md"

            {{-- x-on:submit.prevent --}}
            wire:submit.prevent="addTvList()"
        >
            <div class="mx-auto ">
                <div class="flex mb-2 " >
                    <x-jet-label class="pr-2 text-base text-white" >Estado</x-jet-label>
                    <select
                        class="rounded-sm "
                        name="watching_state_id"
                        id="state"
                        wire:model="fields.watching_state_id"
                    >
                        <option disabled selected value='0'>Seleccione</option>
                        @foreach ($stateWatchingList as $state)
                            <option value="{{$state->id}}" >{{$state->name}}</option>
                        @endforeach

                    </select>
                </div>

                @if (isset($tvshow))

                    <div class="flex mb-2">
                        <x-jet-label class="pr-2 text-base text-white">Temporada</x-jet-label>
                        <select
                            class="px-2 rounded-sm "
                            name="season"
                            id="season"
                            wire:model="fields.season"
                        >
                            @foreach ($tvshow['seasons'] as $key => $value)
                                @if ($key != 0)
                                    <option value="{{ $key }}">{{ $key }}</option>

                                @endif

                            @endforeach
                        </select>
                    </div>

                    <div class="flex mb-2">
                        <x-jet-label class="pr-2 text-base text-white">Cap. Vistos</x-jet-label>
                        <input
                            class="w-12 pl-2 pr-1 rounded-sm"
                            type="number"
                            min="0"
                            name="episode"
                            wire:model.defer="fields.episode"
                            :max="{{ $epForSeason }}"
                        >
                        <span class="pl-2 ">/</span>
                        <span class="pl-2 ">{{ $epForSeason }}</span>
                        {{-- <p x-text="fields.season"></p> --}}
                    </div>

                    <div class="flex mb-4">
                        <x-jet-label class="pr-2 text-base text-white">Punt.</x-jet-label>
                        <select
                            class="rounded-sm"
                            name="score_id"
                            wire:model="fields.score_id"
                        >
                            <option disabled selected value='0'>Seleccione</option>
                            @foreach ($scoreList as $score)
                                <option value="{{$score->id}}">({{$score->id}}) {{$score->name}}</option>
                            @endforeach

                        </select>
                    </div>
                @endif

                <x-jet-button type="button"  wire:click="updateTvList({{ $fields['id'] }})"  class="min-w-full mb-2" color="gray">
                    {{-- SVG Update --}}
                    <svg class="w-4 mr-2 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    {{ __('Update') }}
                </x-jet-button>


                @if ($errors->any())
                    <div class="text-red-600">
                        <h2>Error, hay campos sin llenar</h2>
                        <ul class="pl-4 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </form>
        <x-flash-messages></x-flash-messages>
    </x-modal>
</div>
