@extends('layout')

@section('content')
    <x-show-header title="{{ __('messages.new_client') }}" :showButton="false" />
    <div class="flex">
        <form method="POST" action="/clients" enctype="multipart/form-data" class="max-w-md p-5 flex-1">
            @csrf
            <div class="relative z-0 w-full mb-5 group">
                <img class="h-28 w-28 object-cover rounded-full shadow-l dark:shadow-gray-400"
                    src="https://flowbite.com/docs/images/examples/image-2@2x.jpg" alt="Profile">
            </div>
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">{{__('messages.profile_picture')}}</label>
                <input type="file" id="user_avatar" name="picture"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="user_avatar_help">
                @error('picture')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex gap-5">
                <div class="mb-5 flex-1">
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('messages.first_name') }}
                    </label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" />
                    @error('first_name')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5 flex-1">
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('messages.last_name') }}
                    </label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" />
                    @error('last_name')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <div class="mb-5">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('messages.address') }}
                </label>
                <input type="text" id="address" name="address" value="{{ old('address') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" />
                @error('address')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('messages.email') }}
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" />
                @error('email')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex gap-5">
                <div class="mb-5 flex-1">
                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('messages.phone_number') }}
                    </label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                        regex="/^\+?[1-9]\d{1,14}$/"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" />
                    @error('phone_number')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5 flex-1">
                    <label for="cin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{__('messages.DNI')}}
                    </label>
                    <input type="text" id="cin" name="cin" value="{{ old('cin') }}"
                        regex="/^\d{6,}$/"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" />
                    @error('cin')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <button type="submit"
                class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                {{__('messages.save')}}
            </button>
        </form>
        <div class="flex-1 p-5">
            <img src="{{ asset('assets/add_client.svg') }}" class="mx-auto" alt="">
        </div>
    </div>
@endsection
