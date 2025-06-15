@extends('layouts.app')

@section('content')
<div class="min-h-screen flex">
    <!-- Logo Kiri -->
    <div class="w-1/2 bg-white flex justify-center items-center">
        <img src="{{ asset('img/logo.png') }}" alt="Zidan Transport Logo" class="w-2/3">
    </div>

    <!-- Form Login Kanan -->
    <div class="w-1/2 bg-gray-50 flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800 text-center mb-1">Selamat Datang di</h2>
            <h1 class="text-2xl font-bold text-center text-blue-600 mb-6">Zidan Transport</h1>

            <!-- Google Login -->
            <a href="#" class="flex items-center justify-center border rounded-lg py-2 mb-4 shadow">
                <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="w-5 h-5 mr-2">
                <span>Login with Google</span>
            </a>

            <div class="flex items-center my-4">
                <hr class="flex-grow border-gray-300">
                <span class="mx-2 text-sm text-gray-400">OR</span>
                <hr class="flex-grow border-gray-300">
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="flex items-center border border-gray-300 bg-gray-100 rounded-lg p-2">
                        <!-- Ikon Email -->
                        <svg class="w-6 h-5 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2 4a2 2 0 012-2h16a2 2 0 012 2v16a2 2 0 01-2 2H4a2 2 0 01-2-2V4zm2 0v.01L12 13 20 4.01V4H4zm0 16h16V6.83l-8 8-8-8V20z"/>
                        </svg>

                        <!-- Input Email -->
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="w-full bg-transparent outline-none text-gray-700 font-medium placeholder-gray-500"
                            placeholder="email@gmail.com">
                    </div>
                </div>


                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="flex items-center border bg-gray-100 rounded-lg p-2">
                        <svg class="w-5 h-5 text-black mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 9V7a5 5 0 0110 0v2h1a1 1 0 011 1v8a1 1 0 01-1 1H4a1 1 0 01-1-1v-8a1 1 0 011-1h1zm2 0h6V7a3 3 0 00-6 0v2z"/>
                        </svg>
                        <input type="password" name="password" required
                            class="w-full bg-transparent outline-none text-gray-700 font-semibold"
                            placeholder="">
                    </div>
                </div>

                <!-- Remember Me & Forgot -->
                <div class="flex items-center justify-between text-sm mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-indigo-600 hover:text-orange-600">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Login
                </button>
            </form>

            <!-- Register -->
            <p class="text-center text-sm mt-4 text-gray-600">
                Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 hover:text-orange-600 font-medium">Daftar</a>
            </p>
        </div>
    </div>
</div>
@endsection