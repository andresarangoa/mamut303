@extends('auth')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="flex w-3/5 bg-white rounded-lg shadow mx-auto my-4 align-middle justify-center px-8 py-14">
            <div class="flex-1 flex flex-col">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 mb-5">
                    {{ __('messages.sign_in') }}
                </h1>
                <form method="POST" action="/login" class="w-full flex-1">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                            {{ __('messages.email') }}
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="example@example.com"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-purple-500 dark:focus:border-purple-500" />
                        @error('email')
                            <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mt-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">  {{__('messages.password')}}</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-purple-600 focus:border-purple-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-purple-500 dark:focus:border-purple-500"
                            required="">
                    </div>
                    <div class="flex justify-between mt-3 mb-5">
                        <div class="flex items-center text-xs gap-1">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                            {{ __('messages.remember_me') }}
                        </div>
                        <a href="/forgot-password" class="text-xs">
                            {{ __('messages.forgot_password') }}
                        </a>
                    </div>
                    <button type="submit"
                        class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                        {{ __('messages.login') }}
                    </button>
                    <p class="text-sm text-center mt-2 font-light text-gray-500 dark:text-gray-400">
                        {{ __('messages.dont_have_account') }} <a href="/register"
                            class="font-medium text-purple-600 hover:underline dark:text-purple-500">
                            {{ __('messages.register') }}</a>
                    </p>
                </form>
            </div>
            <div class="flex-1 p-5 self-center hidden lg:block">
                <img src="{{ asset('assets/register.svg') }}" class="mx-auto" alt="">
            </div>
        </div>
    </div>
@endsection
