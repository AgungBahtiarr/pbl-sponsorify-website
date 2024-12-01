@extends('layouts.event_layout')
@section('content')
    <div class="min-h-[90vh] flex flex-col items-center justify-center p-4 sm:p-6">
        <div class="w-full max-w-4xl">
            <h1 class="text-2xl sm:text-3xl font-semibold text-center mb-6">Tambah event</h1>

            @error('message')
                <div class="mb-6">
                    <div role="alert" class="alert alert-error max-w-lg mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Warning: {{ $errors->first() }}</span>
                    </div>
                </div>
            @enderror

            <form method="post" enctype="multipart/form-data" class="w-full">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Nama Acara -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Nama acara</span>
                        </label>
                        <input type="text" placeholder="Masukkan nama acara" class="input input-bordered w-full"
                            name="name" />
                    </div>

                    <!-- Email -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Email penanggung jawab</span>
                        </label>
                        <input type="email" placeholder="Masukkan email penanggung jawab"
                            class="input input-bordered w-full" name="email" />
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Deskripsi acara</span>
                        </label>
                        <textarea placeholder="Masukkan deskripsi acara" class="textarea textarea-bordered w-full h-24" name="description"></textarea>
                    </div>

                    <!-- Lokasi -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Alamat (Link Google Map)</span>
                        </label>
                        <input type="text" placeholder="Masukkan link Google Maps" class="input input-bordered w-full"
                            name="location" />
                    </div>

                    <!-- Venue -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Nama Venue</span>
                        </label>
                        <input type="text" placeholder="Masukkan nama venue" class="input input-bordered w-full"
                            name="venue_name" />
                    </div>

                    <!-- Tanggal -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Tanggal mulai acara</span>
                        </label>
                        <input type="date" class="input input-bordered w-full" name="start_date" />
                    </div>

                    <!-- Proposal -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Proposal</span>
                        </label>
                        <input type="file" class="file-input file-input-bordered w-full" name="proposal"
                            accept=".pdf" />
                    </div>

                    <!-- Poster -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Poster acara</span>
                        </label>
                        <input type="file" class="file-input file-input-bordered w-full" name="image"
                            accept="image/*" />
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-center gap-4 mt-8">
                    <a href="/event/my_event" class="btn btn-secondary w-32">Kembali</a>
                    <button type="submit" class="btn btn-primary w-32">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection
