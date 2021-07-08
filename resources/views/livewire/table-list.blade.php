<div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            @foreach ($tableH as $header => $field)

            <th
                wire:click="sortBy('{{$field}}')"
                scope="col"
                class="py-3 pl-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                >
                <div class="flex border-r border-gray-300">

                    @if ($sortField == $field)
                        @if ($sortDirection == 'asc')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                            </svg>
                        @endif
                    @endif
                    {{ __($header) }}
                </div>
            </th>
            @endforeach
            <th scope="col" class="relative py-3 pl-2">
                <span class="sr-only">Edit</span>
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($lists as $list)
                <tr>
                    <td class="pl-2 py-4 border-l-8 border-{{ $watchingColors[$list['watching_state_id']] }}-500 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="">
                                <img class="rounded-full w-14 h-14" src="{{ 'https://www.themoviedb.org/t/p/w66_and_h66_face' . $list['poster']}}" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    @if ($list['type'] == 'TvShow')
                                        <a href="{{ route('serie.show', ['serie' => $list['api_id']]) }}" class="mt-2 text-lg hover:text-gray-300">{{ $list['name'] }}</a>
                                    @else
                                        <a href="{{ route('pelicula.show', ['pelicula' => $list['api_id'], 'slug' => 'peli']) }}" class="mt-2 text-lg hover:text-gray-300">{{ $list['name'] }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 pl-2 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $list['score_id'] }}</div>
                    </td>
                    <td class="py-4 pl-2 whitespace-nowrap">
                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                            {{$list['type']}}
                        </span>
                    </td>
                    <td class="py-4 pl-2 text-sm text-gray-500 whitespace-nowrap">
                        {{$list['season']}}
                    </td>
                    <td class="py-4 pl-2 text-sm text-gray-500 whitespace-nowrap">
                        {{$list['episode']}}
                    </td>
                    <td class="py-4 pl-2 text-sm font-medium whitespace-nowrap">
                        @auth
                            @if ($userId === Auth::id() )
                                {{-- <button @click="showModal = true, apiId = '{{$list['api_id']}}'"> --}}
                                <button wire:click="$emit('modal', {{$list['api_id']}})">
                                    <a href="#" class="text-gray-600 hover:text-indigo-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </button>

                            @endif
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
