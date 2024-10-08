@extends('layout')

@php
    $headers = ['#', __('messages.brand'), __('messages.model'), __('messages.license_plate'), __('messages.status')];
    if (!$vehicles->isEmpty()) {
        $columns = array_keys($vehicles->first()->toArray());
    }
@endphp

@section('content')
    <x-show-header :title="$client->first_name . ' ' . $client->last_name" :route="$client->id . '/edit'" />
    <div class="grid grid-cols-2 gap-8">
        <x-card title="Info">
            <x-info-card :user="$user" :person="$client" />
        </x-card>
        <x-card title="{{__('messages.invoices')}}">
            <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                @foreach ($invoices as $item)
                    <li class="flex items-center justify-between">
                        <span>
                            @if ($item['status'] == 'Paid')
                                <i class="fa-solid fa-circle-check text-green-500 mr-1"></i>
                            @else
                                <i class="fa-solid fa-circle-xmark text-red-500 mr-1"></i>
                            @endif
                            {{ $item['description'] }}
                        </span>
                        <span class="font-bold text-gray-900">{{ $item['total'] }} DH</span>
                    </li>
                @endforeach
            </ul>
        </x-card>
        <x-card title="{{__('messages.vehicles')}}" class="col-span-2">
            <div class="relative overflow-x-auto sm:rounded-lg">
                @if (!$vehicles->isEmpty())
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <tr>
                                @foreach ($headers as $header)
                                    <th scope="col" class="px-6 py-3">
                                        {{ $header }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr onclick="window.location='{{ '/vehicles' . '/' . $vehicle->id }}'"
                                    class="cursor-pointer bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    @foreach ($columns as $col)
                                        <td class="px-6 py-4">
                                            @if ($col != 'status')
                                                {{ $vehicle[$col] }}
                                            @else
                                                @php
                                                    $colors = [
                                                        'received' => 'bg-yellow-900',
                                                        'valuated' => 'bg-yellow-500',
                                                        'in_workshop' => 'bg-yellow-300',
                                                        'total_loss' => 'bg-purple-500',
                                                        'left_without_nomination' => 'bg-blue-400',
                                                        'left_and_in_nomination' => 'bg-green-500',
                                                    ];
                                                    $status = $vehicle->status; // Assuming the status is stored in $vehicle->status
                                                    $statusLabel = __('messages.status_list.' . $status);
                                                    $statusColor = $colors[$status] ?? 'bg-gray-500';
                                                @endphp
                                                <x-status :status="$statusLabel" :color="$statusColor"/>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center">No Vehicle Found</div>
                @endif
            </div>
        </x-card>
    </div>
@endsection
