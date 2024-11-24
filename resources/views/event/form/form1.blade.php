@extends('layouts.event_layout')
@section('content')
    <div class="h-[90vh] flex flex-col items-center justify-center">
        <div class="flex justify-center mb-5">
            <h1 class="font-semibold text-[30px]">Tambah event</h1>
        </div>

        @error('message')
            <div class="flex justify-center">
                <div role="alert" class="alert alert-error mb-5 max-w-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Warning: {{ $errors->first() }}</span>
                </div>
            </div>
        @enderror

        <div class="flex justify-center">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Nama acara</span>
                        </div>
                        <input type="text" placeholder="Masukkan nama acara" class="input input-bordered w-full max-w-xs"
                            name="name" />
                    </label>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Email penanggung jawab</span>
                        </div>
                        <input type="email" placeholder="Masukkan email penanggung jawab"
                            class="input input-bordered w-full max-w-xs" name="email" />
                    </label>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Deskripsi acara</span>
                        </div>
                        <textarea placeholder="Masukkan deskripsi acara" class="textarea textarea-bordered w-full max-w-xs" name="description"></textarea>
                    </label>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Alamat (Link Google Map)</span>
                        </div>
                        <input type="text" placeholder="Masukkan link Google Maps"
                            class="input input-bordered w-full max-w-xs" name="location" />
                    </label>

                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Nama Venue</span>
                        </div>
                        <input type="text" placeholder="Masukkan nama venue" class="input input-bordered w-full max-w-xs"
                            name="venue_name" />
                    </label>

                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Tanggal mulai acara</span>
                        </div>
                        <input type="date" placeholder="Pilih tanggal mulai" class="input input-bordered w-full max-w-xs"
                            name="start_date" />
                    </label>

                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Proposal</span>
                        </div>
                        <input type="file" placeholder="Upload proposal (PDF)"
                            class="file-input file-input-bordered w-full max-w-xs" name="proposal" />
                    </label>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Poster acara</span>
                        </div>
                        <input type="file" placeholder="Upload poster (JPG/PNG)"
                            class="file-input file-input-bordered w-full max-w-xs" name="image" />
                    </label>
                    <div></div>
                    <div class="flex mt-8 justify-center items-center gap-3">
                        <a href="/event/my_event" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-primary">Kirim</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
