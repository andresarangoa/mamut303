@extends('layout')

@php
    // $roleHeaders = [
    //     'client' => ['#', 'Mechanic', 'Date', 'Time', 'Status'],
    //     'mechanic' => ['#', 'Client', 'Date', 'Time', 'Status'],
    //     'admin' => ['#', 'Mechanic', 'Client', 'Date', 'Time', 'Status'],
    // ];

    // $headers = $roleHeaders[auth()->user()->role];

    // if (!$meetings->isEmpty()) {
    //     $columns = array_keys($meetings->first()->toArray());
    // }
@endphp

@section('content')
    <div id="tailwindModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full">
            <div class="flex justify-between items-center p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Modal Title</h3>
                <button id="closeModal" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-4">
                <!-- Modal content goes here -->
                <p>Your content...</p>
            </div>
            <div class="flex justify-end p-4 border-t border-gray-200">
                <button id="closeModal" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Close</button>
            </div>
        </div>
       
    </div>

    <x-add-date-modal :vehicles="$vehicles" />
    <div id="calendar">

    </div>
    <!-- Calendar View -->
    <!-- Modal -->
@endsection
