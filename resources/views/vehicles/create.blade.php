@extends('layout')

@section('content')
    <x-show-header title="{{ __('messages.new_vehicle') }}" :showButton="false" />
    <div class="flex">
        <form method="POST" action="/vehicles" class="max-w-lg p-5 flex-1">
            @csrf
            @if (auth()->user()->role != 'client')
                <label for="client_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white flex-1">
                    {{ __('messages.client') }}
                </label>
                <div class="mb-5 flex items-center">
                    <div class="flex flex-1 items-center w-full">
                        <!-- Select element with 80% width -->
                        <select id="client" name="client_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                            style="width: 70%; margin-right: 10px;">
                            <option value=""></option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" @selected($client->id == old('client_id'))>
                                    {{ $client->first_name . ' ' . $client->last_name }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Button container with text below -->
                        <div class="flex flex-col items-center">
                            <a href="{{ route('clients.create') }}"
                                class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-blue-600 focus:outline-none">
                                <span class="text-xl">+</span> <!-- Icon or symbol -->
                            </a>
                            <span class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                {{ __('messages.add_client') }}
                            </span>
                        </div>
                    </div>
                </div>
            @else
                <input class="hidden" type="text" name="client_id" id="client" value={{ auth()->user()->client->id }}>
            @endif
            <div class="flex gap-5 mb-5">
                <div class="flex-1">
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('messages.brand') }}
                    </label>
                    <input type="text" id="brand" name="brand" value="{{ old('brand') }}"
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
                    <input type="text" id="model" name="model" value="{{ old('model') }}"
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
                        <option value="Gasoline" @selected(old('fuel_type') == 'Gasoline')>{{ __('messages.fuel_types.Gasoline') }}
                        </option>
                        <option value="Diesel" @selected(old('fuel_type') == 'Diesel')>{{ __('messages.fuel_types.Diesel') }}</option>
                        <option value="Electric" @selected(old('fuel_type') == 'Electric')>{{ __('messages.fuel_types.Electric') }}
                        </option>
                        <option value="Hybrid" @selected(old('fuel_type') == 'Hybrid')>{{ __('messages.fuel_types.Hybrid') }}</option>
                        <option value="CNG" @selected(old('fuel_type') == 'CNG')>{{ __('messages.fuel_types.CNG') }}</option>
                        <option value="LPG" @selected(old('fuel_type') == 'LPG')>{{ __('messages.fuel_types.LPG') }}</option>
                        <option value="Ethanol" @selected(old('fuel_type') == 'Ethanol')>{{ __('messages.fuel_types.Ethanol') }}
                        </option>
                        <option value="Hydrogen" @selected(old('fuel_type') == 'Hydrogen')>{{ __('messages.fuel_types.Hydrogen') }}
                        </option>
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
                        <option value="received" @selected(old('status') == 'received')>{{ __('messages.status_list.received') }}
                        </option>
                        <option value="valuated" @selected(old('status') == 'valuated')>{{ __('messages.status_list.valuated') }}
                        </option>
                        <option value="in_workshop" @selected(old('status') == 'in_workshop')>
                            {{ __('messages.status_list.in_workshop') }}
                        </option>
                        <option value="total_loss" @selected(old('status') == 'total_loss')>
                            {{ __('messages.status_list.total_loss') }}
                        </option>
                        <option value="left_without_nomination" @selected(old('status') == 'left_without_nomination')>
                            {{ __('messages.status_list.left_without_nomination') }}</option>
                        <option value="left_and_in_nomination" @selected(old('status') == 'left_and_in_nomination')>
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
                    <input type="text" id="license_plate" name="license_plate" value="{{ old('license_plate') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
                    @error('license_plate')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="insurer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('messages.insurer') }}
                    </label>
                    <select id="insurer" name="insurer_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
                        <option value=""></option>
                        @foreach ($insurers as $insurer)
                            <option value="{{ $insurer->id }}" @selected($insurer->id == old('insurer_id'))>
                                {{ $insurer->name . ' - ' . $insurer->nit }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit"
                class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                {{ __('messages.save') }}
            </button>
        </form>
        <div class="flex-1 p-5">
            <img src="{{ asset('assets/vehicle.svg') }}" class="mx-auto" alt="">
        </div>
    </div>
@endsection
