@extends('layouts.auth_layout')
@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md">
            <form method="POST" class="bg-white shadow-md rounded-xl px-8 pt-6 pb-8 mb-4">

                <div class="mb-8 text-center">
                    <p class="text-xl font-bold">Sign In to sponsorify</p>
                    <p class="text-sm text-gray-400">Welcome back! Please sign in to continue</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Username or Email Address
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full h-10 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" type="email" name="email" required>
                </div>


                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full h-10 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="password" name="password" required>


                    <div class="flex items-center justify-between">
                        <button
                            class="w-full h-10 py-2 px-3 bg-gray-600 hover:bg-gray-700 text-white font-600 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            continue
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-gray-600 text-sm">Already have an account? <a href="#"
                                class="text-blue-500 hover:underline">Sign Up</a></p>
                    </div>
            </form>
        </div>
    </div>
@endsection
