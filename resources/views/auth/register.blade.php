@extends('layouts.auth_layout')
@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-md rounded-xl px-8 pt-6 pb-8 mb-4">
            <div class="mb-8 text-center">
                <p class="text-xl font-bold">Buat akunmu</p>
                <p class="text-sm text-gray-400">Selamat datang! silahkan masuk untuk melanjutkan ke aplikasi</p>
            </div>

            {{-- @if (session('warning')) --}}

            @error('message')
                {{-- <div>{{ $errors }}</div> --}}
                <div role="alert" class="alert alert-warning mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Warning: {{ $errors->first() }}</span>
                </div>
            @enderror

            {{-- @endif --}}

            <form method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Nama lengkap
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full h-10 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username" type="text" name="name" required>
                </div>

                <div class="">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full h-10 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" type="text" name="email" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="role">pilih peranmu</label>
                    <select id="id_role" name="id_role"
                        class="shadow appearance-none border rounded w-full h-10 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline bg-white">
                        <option value="1" name="id_role">Event Organizer</option>
                        <option value="2" name="id_role">Sponsor</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            class="shadow appearance-none border rounded w-full h-10 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                            id="password" type="password" name="password" required>

                        <style>
                            #password[type="password"] {
                                font-family: "Arial", sans-serif;
                            }
                        </style>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="w-full h-10 py-2 px-3 bg-neutral from-gray-700 to-black hover:from-gray-800 hover:to-gray-900 text-white font-600 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Daftar
                    </button>
                </div>

                <div class="text-center mt-4 gap-2">
                    <p class="text-gray-600 text-sm">Sudah memiliki akun? <a href="/auth/login"
                            class="text-blue-500 hover:underline">Masuk</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
