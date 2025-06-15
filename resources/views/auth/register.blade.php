@extends('layouts.app')

@section('content')
<div class="min-h-screen flex">
    <!-- Logo Kiri -->
    <div class="w-1/2 bg-white flex justify-center items-center">
        <img src="{{ asset('img/logo.png') }}" alt="Zidan Transport Logo" class="w-2/3">
    </div>

    <!-- Form Register Kanan -->
    <div class="w-1/2 bg-gray-50 flex items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800 text-center mb-1">Daftar Akun</h2>
            <h1 class="text-2xl font-bold text-center text-blue-600 mb-6">Zidan Transport</h1>

            <!-- Form Register -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <div class="flex items-center border border-gray-300 bg-gray-100 rounded-lg p-2">
                        <svg class="w-5 h-5 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-6 8a6 6 0 1112 0H4z" />
                        </svg>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full bg-transparent outline-none text-gray-700 font-medium placeholder-gray-500"
                            placeholder="Nama Lengkap">
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="flex items-center border border-gray-300 bg-gray-100 rounded-lg p-2">
                        <svg class="w-6 h-5 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2 4a2 2 0 012-2h16a2 2 0 012 2v16a2 2 0 01-2 2H4a2 2 0 01-2-2V4zm2 0v.01L12 13 20 4.01V4H4zm0 16h16V6.83l-8 8-8-8V20z"/>
                        </svg>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full bg-transparent outline-none text-gray-700 font-medium placeholder-gray-500"
                            placeholder="email@gmail.com">
                    </div>
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <div class="flex items-center border border-gray-300 bg-gray-100 rounded-lg p-2">
                        <svg class="w-5 h-5 text-gray-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79a15.09 15.09 0 006.59 6.59l2.2-2.2a1 1 0 011.11-.27 11.72 11.72 0 003.7.59 1 1 0 011 1v3.61a1 1 0 01-1 1A17.93 17.93 0 012 4a1 1 0 011-1h3.61a1 1 0 011 1 11.72 11.72 0 00.59 3.7 1 1 0 01-.27 1.11l-2.2 2.2z"/>
                        </svg>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                            class="w-full bg-transparent outline-none text-gray-700 font-medium placeholder-gray-500"
                            placeholder="08xxxxxxxxxx">
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

                <!-- Konfirmasi Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <div class="flex items-center border bg-gray-100 rounded-lg p-2">
                        <svg class="w-5 h-5 text-black mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 9V7a5 5 0 0110 0v2h1a1 1 0 011 1v8a1 1 0 01-1 1H4a1 1 0 01-1-1v-8a1 1 0 011-1h1zm2 0h6V7a3 3 0 00-6 0v2z"/>
                        </svg>
                        <input type="password" name="password_confirmation" required
                            class="w-full bg-transparent outline-none text-gray-700 font-semibold"
                            placeholder="">
                    </div>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Daftar Akun
                </button>
            </form>

            <!-- Link Login -->
            <p class="text-center text-sm mt-4 text-gray-600">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 hover:text-orange-600 font-medium">Login</a>
            </p>
        </div>
    </div>
</div>
@endsection