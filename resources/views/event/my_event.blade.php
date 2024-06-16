@extends('layouts.event_layout')
@section('content')
    @if (count($events) == 0)
        <div class="flex justify-center items-center h-[89vh]">
            <div class="flex flex-col items-center gap-3">
                <h1 class="text-xl font-semibold">Silahkan tambahkan event terlebih dahulu</h1>
                <div>
                    <button class="btn btn-primary font-semibold" onclick="noEvent.showModal()">Tambah Event</button>
                    <dialog id="noEvent" class="modal">
                        <div class="modal-box">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <h3 class="font-bold text-lg">Tambah Event</h3>
                            <form method="post" enctype="multipart/form-data">
                                @csrf
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Nama event</span>
                                    </div>
                                    <input type="text" placeholder="Type here"
                                        class="input input-bordered w-full max-w-xs" name="name" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Email penanggung jawab</span>
                                    </div>
                                    <input type="email" placeholder="email" class="input input-bordered w-full max-w-xs"
                                        name="email" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Deskripsi event</span>
                                    </div>
                                    <input type="text" placeholder="Type here"
                                        class="input input-bordered w-full max-w-xs" name="description" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Desa</span>
                                    </div>
                                    <input type="text" placeholder="desa" class="input input-bordered w-full max-w-xs"
                                        name="desa" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Kecamatan</span>
                                    </div>
                                    <input type="text" placeholder="kecamatan"
                                        class="input input-bordered w-full max-w-xs" name="kecamatan" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Kabupaten</span>
                                    </div>
                                    <input type="text" placeholder="Kabupaten"
                                        class="input input-bordered w-full max-w-xs" name="kabupaten" />
                                </label>

                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">tanggal event mulai</span>
                                    </div>
                                    <input type="date" placeholder="Type here"
                                        class="input input-bordered w-full max-w-xs" name="start_date" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Tanggal event berakhir</span>
                                    </div>
                                    <input type="date" placeholder="Type here"
                                        class="input input-bordered w-full max-w-xs" name="end_date" />
                                </label>

                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Proposal</span>
                                    </div>
                                    <input type="file" placeholder="Type here"
                                        class="file-input file-input-bordered w-full max-w-xs" name="proposal" />
                                </label>
                                <div class="flex justify-end">
                                    <button class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </dialog>
                </div>
            </div>
        </div>
    @else
        <div>
            <div class="flex flex-col items-center justify-center my-14">
                <h1 class="text-2xl font-bold">Daftar Event</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="border-b border-black mx-12 pb-3">
                <ul class="grid grid-cols-8 text-center font-semibold items-center">
                    <li>Nama Event</li>
                    <li>Email PIC</li>
                    <li>Deskripsi Event</li>
                    <li>Lokasi</li>
                    <li>proposal</li>
                    <li>Tanggal Mulai</li>
                    <li>Tanggal Berakhir</li>
                    <li>
                        <div>
                            <button class="btn btn-primary font-semibold" onclick="noEvent.showModal()">Tambah
                                Event</button>
                            <dialog id="noEvent" class="modal">
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                    <h3 class="font-bold text-lg">Tambah Event</h3>
                                    <form method="post" enctype="multipart/form-data">
                                        @csrf
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Nama event</span>
                                            </div>
                                            <input type="text" placeholder="Type here"
                                                class="input input-bordered w-full max-w-xs" name="name" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Email penanggung jawab</span>
                                            </div>
                                            <input type="email" placeholder="email"
                                                class="input input-bordered w-full max-w-xs" name="email" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Deskripsi event</span>
                                            </div>
                                            <input type="text" placeholder="Type here"
                                                class="input input-bordered w-full max-w-xs" name="description" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Desa</span>
                                            </div>
                                            <input type="text" placeholder="desa"
                                                class="input input-bordered w-full max-w-xs" name="desa" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Kecamatan</span>
                                            </div>
                                            <input type="text" placeholder="kecamatan"
                                                class="input input-bordered w-full max-w-xs" name="kecamatan" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Kabupaten</span>
                                            </div>
                                            <input type="text" placeholder="Kabupaten"
                                                class="input input-bordered w-full max-w-xs" name="kabupaten" />
                                        </label>

                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">tanggal event mulai</span>
                                            </div>
                                            <input type="date" placeholder="Type here"
                                                class="input input-bordered w-full max-w-xs" name="start_date" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Tanggal event berakhir</span>
                                            </div>
                                            <input type="date" placeholder="Type here"
                                                class="input input-bordered w-full max-w-xs" name="end_date" />
                                        </label>

                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Proposal</span>
                                            </div>
                                            <input type="file" placeholder="Type here"
                                                class="file-input file-input-bordered w-full max-w-xs" name="proposal" />
                                        </label>
                                        <div class="flex justify-end">
                                            <button class="btn btn-primary">Kirim</button>
                                        </div>
                                    </form>
                                </div>
                            </dialog>
                        </div>
                    </li>
                </ul>
            </div>
            @foreach ($events as $item)
                <div class="flex flex-col">
                    <div class="grid grid-cols-8 items-center mx-12 border border-black rounded-lg my-4 py-3">
                        <h1 class="text-center">{{ $item->name }}</h1>
                        <h1 class="text-center"> {{ $item->email }}</h1>
                        <h1 class="text-center">{{ $item->description }}</h1>

                        <h1 class="text-center">{{ $item->location }}</h1>
                        <div class="text-center"><a href={{ 'http://localhost:8000/' . $item->proposal }}>Download</a></div>
                        <h1 class="text-center">{{ $item->start_date }}</h1>
                        <h1 class="text-center">{{ $item->end_date }}</h1>
                        <div class="text-center">
                            <button class="text-[#dd3429]">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
            @endforeach
        </div>
        </div>
        </div>
    @endif
@endsection
