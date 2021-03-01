<div>
    <div
        class="flex px-2 py-1 mt-2 bg-gray-700 border border-gray-200 rounded-t-md"
        :class="{ 'rounded-b-md' : open === false }"
    >
        <svg
            class="w-6 mr-2 text-green-500 bg-white rounded-full"
            x-show="editMode"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <span class="flex-grow select-none" x-text="editMode ? 'Editar estado' : 'Añadir a mi lista'"></span>

        <svg
            class="w-6 transition duration-500 ease-in-out cursor-pointer "
            :class="{'transform rotate-180 ' : open}"
            xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24"
            stroke="currentColor"
            @click="open = !open"
            >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>
    <form
        class="flex flex-wrap p-4 text-sm text-gray-700 bg-gray-200 bg-opacity-75 rounded-b-md "
        x-show="open"
        x-on:submit.prevent
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 "
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-end="opacity-0"
    >
        <div class="flex mb-2" >
            <x-jet-label class="pr-2 text-white" >Estado</x-jet-label>
            <select
                class="rounded-sm "
                :class="{' border border-red-600' : errors && errors.watching_state_id}"
                x-model="fields.watching_state_id"
                name="watching_state_id"
                id="state"
            >
                <option disabled selected value='0'>Seleccione</option>
                @foreach ($stateWatchingList as $state)
                    <option value="{{$state->id}}" >{{$state->name}}</option>
                @endforeach

            </select>
        </div>
        <div class="flex mb-2">
            <x-jet-label class="pr-2 text-white">Temporada</x-jet-label>
            <select
                class="px-2 rounded-sm "
                :class="{' border border-red-600' : errors && errors.season}"
                name="season"
                id="season"
                x-model="fields.season"

            >
                @foreach ($tvshow['seasons'] as $key => $value)
                    @if ($key != 0)
                        <option value="{{ $key }}">{{ $key }}</option>

                    @endif

                @endforeach
            </select>
        </div>
        <div class="flex mb-2">
            <x-jet-label class="pr-2 text-white">Cap. Vistos</x-jet-label>
            <input
                class="w-12 pl-2 pr-1 rounded-sm"
                :class="{' border border-red-600' : errors && errors.episode}"
                type="number"
                min="0"
                x-model="fields.episode"
                :max="getCountEp(fields.season - 1)"
                name="episode"
            >
            <span class="pl-2 ">/</span>
            <span class="pl-2 " x-text="getCountEp(fields.season - 1)"></span>
        </div>
        <div class="flex mb-4">
            <x-jet-label class="pr-2 text-white">Puntuación</x-jet-label>
            <select
                class="rounded-sm"
                :class="{' border border-red-600' : errors && errors.score_id}"
                name="score_id"
                x-model="fields.score_id"
            >
                <option disabled selected value='0'>Seleccione</option>
                @foreach ($scoreList as $score)
                    <option value="{{$score->id}}">({{$score->id}}) {{$score->name}}</option>
                @endforeach

            </select>
        </div>
        <x-jet-button
            color="gray"
            class="min-w-full mb-2"
            @click="editMode ? updateTvList() : addTvList()">
            <template x-if="editMode">
                {{-- SVG Update --}}
                <svg class="w-4 mr-2 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </template>
            <template x-if="!editMode">
                {{-- SVG add --}}
                <svg class="w-4 mr-2 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </template>
            <span x-text="editMode ? 'Actualizar' : 'Añadir'"></span>
        </x-jet-button>

        {{-- <x-jet-button
            color="gray"
            class="min-w-full mb-2"
            @click="debug()"
        >
            <svg class="w-6 pr-2 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Debug</span>
        </x-jet-button> --}}
        <template x-if="Object.keys(errors).length">
            <div class="min-w-full p-2 mb-2 text-sm text-red-500 bg-red-100 border border-red-500 rounded-md " >
                Hay campos sin llenar
            </div>
        </template>
    </form>
    <script>
        function main(){
            return {
                stringEp: "{{ $tvshow['stringEpCount'] }}",
                apiId: "{{$tvshow['id']}}",
                arrayEp: [],
                open: false,
                success: false,
                errors: {},
                editMode: false,
                fields: {
                    watching_state_id: 0,
                    season: 1,
                    score_id: 0,
                    episode: 1,
                    name: '{{ $tvshow["name"] }}',
                    api_id: '{{ $tvshow["id"]}}',
                    poster: '{{ $tvshow["poster_path"]}}',
                },
                oldFields : {},
                init() {
                    this.$watch('fields.season', value => {
                        this.fields.episode = 0;
                    });
                    this.$watch('fields.watching_state_id', value => {
                        if (value == '2') {
                            this.fields.season = this.arrayEp.length;
                            this.fields.episode = this.getCountEp(this.fields.season - 1);
                        }
                    });

                    this.oldData();


                },
                stringToArray: function(string) {
                    this.arrayEp = string.split(',')
                },
                getCountEp: function(s) {
                    this.stringToArray(this.stringEp);
                    return this.arrayEp[s];
                },
                addTvList: function() {
                    axios
                        .post('/tvlist', this.fields)
                        .then(respuesta => {
                            this.success = true;
                            this.errors = {};
                            this.open =false;
                            this.editMode = true;
                            this.oldData();

                        })
                        .catch(error => {
                            console.log(error.response);
                            if (error.response.status == 422) {
                                this.errors = error.response.data.errors;

                            }
                        });
                },
                updateTvList: function() {
                    axios
                        .put('/tvlist/' + this.oldFields.id, this.fields )
                        .then(respuesta => {
                            this.open = false;
                            this.success =true;
                        })
                        .catch(error => console.log(error));

                },
                oldData: function(){
                    axios
                        .get('/tvlist/' + this.apiId)
                        .then(respuesta => {
                            // console.log(respuesta.data);
                            this.oldFields = respuesta.data;
                            // console.log(Object.entries(this.oldFields).length );

                            if (Object.keys(this.oldFields).length !== 0) {
                                this.editMode = true;
                                // this.fields = this.oldFields;
                                // Asignamos los valores 'viejos' a los fields con  x-model
                                for (const property in this.oldFields){
                                    if (property in this.fields) {
                                        this.fields[property] = this.oldFields[property]
                                    }
                                }
                            }
                        })
                        .catch(error => console.log(error));
                },
                debug: function() {
                    console.log(this.fields);
                    console.log(this.oldFields);
                    // console.log(Object.keys(this.errors).length)

                    // console.log(typeof this.tvCheck);
                    // console.log(typeof this.editMode);
                    // console.log( this.editMode);
                    // console.log( this.editMode ? true : false);

                    // if (this.tvCheck != '[]') {
                    //     console.log('verdadero')
                    // } else {
                    //     console.log('falso')

                    // }

                }
            }
        }

    </script>
</div>


