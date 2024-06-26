@extends('layouts.auth_layout')
@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md">
            <form method="POST" class="bg-white shadow-md rounded-xl px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-8 text-center">
                    <p class="text-xl font-bold">Masuk ke Sponsorify</p>
                    <p class="text-sm text-gray-400">Selamat Datang kembali! Tolong masuk untuk melanjutkan</p>
                </div>
                @if (session('error'))
                <div role="alert" class="alert alert-error mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    <span>Warning: {{session('error')}}</span>
                  </div>
                @endif

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full h-10 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" type="email" name="email" placeholder="email" required>
                </div>


                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full h-10 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="password" name="password" placeholder="password" required>
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="w-full h-10 py-2 px-3 bg-neutral hover:bg-gray-700 text-white font-600 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Masuk
                    </button>
                </div>

                <div class="text-center mt-4">
                    <p class="text-gray-600 text-sm">Sudah memiliki akun? <a href="/auth/register"
                            class="text-blue-500 hover:underline">Daftar</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
