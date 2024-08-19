@extends('layout')

@section('content')
    <x-show-header title="{{ __('messages.update_insurer') }}" :showButton="false" />
    <div class="flex">
        <form method="POST" action="/insurers/{{ $insurer->id }}" class="max-w-lg p-5 flex-1">
            @csrf
            @method('PUT') <!-- Use PUT or PATCH depending on your preference -->

            <div class="flex gap-5 mb-5">
                <div class="flex-1">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('messages.insurer_name') }}
                    </label>
                    <input type="text" id="name" name="name" value="{{ $insurer->name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" />
                    @error('name')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="nit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('messages.insurer_nit') }}
                    </label>
                    <input type="text" id="nit" name="nit" value="{{ $insurer->nit }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" />
                    @error('nit')
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
