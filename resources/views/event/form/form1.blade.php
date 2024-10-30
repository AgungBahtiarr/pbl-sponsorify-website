@extends('layouts.event_layout')
@section('content')
    <div class="flex justify-center mb-5">
        <h1 class="font-semibold text-[30px] mt-8">Tambah event</h1>
    </div>
    <div class="flex justify-center mb-8">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Nama acara</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full max-w-xs" name="name" />
                </label>
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Email penanggung jawab</span>
                    </div>
                    <input type="email" placeholder="..." class="input input-bordered w-full max-w-xs" name="email" />
                </label>
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Deskripsi acara</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full max-w-xs"
                        name="description" />
                </label>
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Alamat (Link Google Map)</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full max-w-xs" name="alamat" />
                </label>

                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Tanggal mulai acara</span>
                    </div>
                    <input type="date" placeholder="..." class="input input-bordered w-full max-w-xs"
                        name="start_date" />
                </label>
                {{-- <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Tanggal acara berakhir</span>
                    </div>
                    <input type="date" placeholder="..." class="input input-bordered w-full max-w-xs" name="end_date" />
                </label> --}}

                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Proposal</span>
                    </div>
                    <input type="file" placeholder="..." class="file-input file-input-bordered w-full max-w-xs"
                        name="proposal" />
                </label>
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Poster acara</span>
                    </div>
                    <input type="file" placeholder="..." class="file-input file-input-bordered w-full max-w-xs"
                        name="image" />
                </label>
            </div>

            <div class="flex justify-end mt-4 gap-3">
                <a href="/event/my_event" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Kirim</button>
            </div>
        </form>
    </div>
@endsection
