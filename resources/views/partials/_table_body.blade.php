@foreach ($list as $item)

    <tr onclick="window.location='{{ $route . '/' . $item->id }}'"
        class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        @if (in_array('picture', $columns))
            <td class="text-center">
                @if ($item['picture'])
                    <img class="w-10 h-10 rounded-full object-cover m-auto" src="{{ asset('storage/' . $item->picture) }}"
                        alt="Profile">
                @else
                    <div
                        class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <span
                            class="font-medium text-gray-600 dark:text-gray-300">{{ $item['first_name'][0] . $item['last_name'][0] }}</span>
                    </div>
                @endif
            </td>
        @endif
        @foreach ($columns as $col)
            @if ($col != 'id' && $col != 'picture')
                @if ($col === 'status')
                    @php
                        // Define colors for different status values
                        $colors = [
                            'received' => 'bg-yellow-900',
                            'valuated' => 'bg-yellow-500',
                            'in_workshop' => 'bg-yellow-300',
                            'total_loss' => 'bg-purple-500',
                            'left_without_nomination' => 'bg-blue-400',
                            'left_and_in_nomination' => 'bg-green-500',
                        ];
                        $status = $item[$col];
                        $statusLabel = __('messages.status_list.' . $status);
                        $statusColor = $colors[$item[$col]] ?? 'bg-gray-500';
                    @endphp
                    <td class="px-6 py-4">
                        <span class="inline-block w-3 h-3 rounded-full {{ $statusColor }} mr-2"></span>
                        {{ $statusLabel }}
                    </td>
                @else
                    <td class="px-6 py-4">
                        {{ $item[$col] }}
                    </td>
                @endif
            @endif
        @endforeach
        <td class="flex justify-center items-center px-6 py-4">
            @if (auth()->user()->role != 'mechanic')
                <button type="button"
                    onclick="event.stopPropagation(); window.location='{{ $route . '/' . $item->id . '/edit' }}'"
                    class="mr-1 text-purple-700 border border-purple-700 hover:bg-purple-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-purple-500 dark:text-purple-500 dark:hover:text-white dark:focus:ring-purple-800 dark:hover:bg-purple-500">
                    <i class="fa-solid fa-pen"></i>
                </button>
                <button type="button" onclick="event.stopPropagation();" data-modal-target="delete-modal"
                    data-modal-toggle="delete-modal"
                    class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500">
                    <i class="fa-solid fa-trash"></i>
                </button>
            @endif
        </td>
    </tr>
    @if (auth()->user()->role != 'mechanic')
        <x-delete-modal :id="$item->id" :route="$route" />
    @endif
@endforeach
