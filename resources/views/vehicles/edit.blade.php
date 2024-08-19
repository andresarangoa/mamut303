@extends('layout')

@section('content')
    <x-show-header title="{{ __('messages.update_vehicle') }}" :showButton="false" />
    <div class="flex">
        <form method="POST" action="/vehicles/{{ $vehicle->id }}" class="max-w-md p-5 flex-1">
            @csrf
            @method('PUT')
            <div class={{ auth()->user()->role == 'client' ? ' hidden' : 'mb-5' }}>
                <label for="client" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('messages.client') }}
                </label>
                <select id="client" name="client_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
                    <option value=""></option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" @selected($client->id == $vehicle->client_id)>
                            {{ $client->first_name . ' ' . $client->last_name }}</option>
                    @endforeach
                </select>
                @error('client_id')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex gap-5 mb-5">
                <div class="flex-1">
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('messages.brand') }}
                    </label>
                    <input type="text" id="brand" name="brand" value="{{ $vehicle->brand }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" />
                    @error('brand')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="model" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('messages.model') }}
                    </label>
                    <input type="text" id="model" name="model" value="{{ $vehicle->model }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" />
                    @error('model')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <div class="flex gap-5 mb-5">
                <div class="flex-1">
                    <label for="fuel_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('messages.fuel_type') }}
                    </label>
                    <select id="fuel_type" name="fuel_type"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
                        <option value=""></option>
                        <option value="Gasoline" @selected($vehicle->fuel_type == 'Gasoline')>Gasoline</option>
                        <option value="Diesel" @selected($vehicle->fuel_type == 'Diesel')>Diesel</option>
                        <option value="Electric" @selected($vehicle->fuel_type == 'Electric')>Electric</option>
                        <option value="Hybrid" @selected($vehicle->fuel_type == 'Hybrid')>Hybrid</option>
                        <option value="CNG" @selected($vehicle->fuel_type == 'CNG')>Compressed Natural Gas</option>
                        <option value="LPG" @selected($vehicle->fuel_type == 'LPG')>Liquefied Petroleum Gas</option>
                        <option value="Ethanol" @selected($vehicle->fuel_type == 'Ethanol')>Ethanol</option>
                        <option value="Hydrogen" @selected($vehicle->fuel_type == 'Hydrogen')>Hydrogen</option>
                    </select>
                    @error('fuel_type')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('messages.status') }}
                    </label>
                    <select id="status" name="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
                        <option value=""></option>
                        <option value="received" @selected($vehicle->status  == 'received')>{{ __('messages.status_list.received') }}</option>
                        <option value="valuated" @selected($vehicle->status  == 'valuated')>{{ __('messages.status_list.valuated') }}
                        </option>
                        <option value="in_workshop" @selected($vehicle->status  == 'in_workshop')>{{ __('messages.status_list.in_workshop') }}
                        </option>
                        <option value="total_loss" @selected($vehicle->status  == 'total_loss')>{{ __('messages.status_list.total_loss') }}
                        </option>
                        <option value="left_without_nomination" @selected($vehicle->status  == 'left_without_nomination')>
                            {{ __('messages.status_list.left_without_nomination') }}</option>
                        <option value="left_and_in_nomination" @selected($vehicle->status  == 'left_and_in_nomination')>
                            {{ __('messages.status_list.left_and_in_nomination') }}</option>
                    </select>
                    @error('status')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <div class="flex gap-5 mb-5">
                <div class="flex-1">
                    <label for="license_plate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('messages.license_plate') }}
                    </label>
                    <input type="text" id="license_plate" name="license_plate" value="{{ $vehicle->license_plate }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" />
                    @error('license_plate')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <button type="submit"
                class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                {{ __('messages.update') }}
            </button>
        </form>
        <div class="flex-1 p-5">
            <img src="{{ asset('assets/vehicle.svg') }}" class="mx-auto" alt="">
        </div>
    </div>
@endsection
