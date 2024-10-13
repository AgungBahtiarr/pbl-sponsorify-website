@extends('layouts.event_layout')
@section('content')
    @if (count($events) == 0)
        <div class="flex justify-center items-center h-[89vh]">
            <div class="flex flex-col items-center gap-3">
                <h1 class="text-xl font-semibold">Silahkan tambahkan acara terlebih dahulu</h1>
                <div>
                    <button class="btn btn-primary font-semibold" onclick="noEvent.showModal()">Tambah acara</button>
                    <dialog id="noEvent" class="modal">
                        <div class="modal-box">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <h3 class="font-bold text-lg">Tambah acara</h3>
                            <form method="post" enctype="multipart/form-data">
                                @csrf
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Nama acara</span>
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
                                        <span class="label-text">Deskripsi acara</span>
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
                                        <span class="label-text">Nominal sponsorship bronze</span>
                                    </div>
                                    <input type="text" placeholder="..."
                                        class="input input-bordered w-full max-w-xs" name="#" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Maksimal sponsor bronze</span>
                                    </div>
                                    <input type="text" placeholder="..."
                                        class="input input-bordered w-full max-w-xs" name="#" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Nominal sponsorship silver</span>
                                    </div>
                                    <input type="text" placeholder="..."
                                        class="input input-bordered w-full max-w-xs" name="#" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Maksimal sponsor silver</span>
                                    </div>
                                    <input type="text" placeholder="..."
                                        class="input input-bordered w-full max-w-xs" name="#" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Nominal sponsorship gold</span>
                                    </div>
                                    <input type="text" placeholder="..."
                                        class="input input-bordered w-full max-w-xs" name="#" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Maksimal sponsor gold</span>
                                    </div>
                                    <input type="text" placeholder="..."
                                        class="input input-bordered w-full max-w-xs" name="#" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Nominal sponsorship platinum</span>
                                    </div>
                                    <input type="text" placeholder="..."
                                        class="input input-bordered w-full max-w-xs" name="#" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Maksimal sponsor platinum</span>
                                    </div>
                                    <input type="text" placeholder="..."
                                        class="input input-bordered w-full max-w-xs" name="#" />
                                </label>

                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">tanggal acara mulai</span>
                                    </div>
                                    <input type="date" placeholder="Type here"
                                        class="input input-bordered w-full max-w-xs" name="start_date" />
                                </label>
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Tanggal acara berakhir</span>
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
                                <label class="form-control w-full max-w-xs">
                                    <div class="label">
                                        <span class="label-text">Foto acara</span>
                                    </div>
                                    <input type="file" placeholder="..."
                                        class="file-input file-input-bordered w-full max-w-xs" name="image" />
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
                <h1 class="text-[30px] font-bold">Daftar Acara</h1>
                <p class="font-semibold text-[#7f7f7f]">Buat acara terbaikmu disini!</p>
            </div>
            <div class="border-b border-black mx-12 pb-3">
                <ul class="grid grid-cols-8 text-center font-semibold items-center">
                    <li>Nama acara</li>
                    <li>Email PIC</li>
                    <li>Deskripsi acara</li>
                    <li>Lokasi</li>
                    <li>proposal</li>
                    <li>Tanggal Mulai</li>
                    <li>Tanggal Berakhir</li>
                    <li>
                        <div>
                            <button class="btn btn-primary font-semibold" onclick="noEvent.showModal()">Tambah
                                acara</button>
                            <dialog id="noEvent" class="modal">
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                    <h3 class="font-bold text-lg">Tambah acara</h3>
                                    <form method="post" enctype="multipart/form-data">
                                        @csrf
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Nama acara</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="name" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Email penanggung jawab</span>
                                            </div>
                                            <input type="email" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="email" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Deskripsi acara</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="description" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Desa</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="desa" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Kecamatan</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="kecamatan" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Kabupaten</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="kabupaten" />
                                        </label>

                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Nominal sponsorship bronze</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="#" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Maksimal sponsor bronze</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="#" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Nominal sponsorship silver</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="#" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Maksimal sponsor silver</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="#" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Nominal sponsorship gold</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="#" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Maksimal sponsor gold</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="#" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Nominal sponsorship platinum</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="#" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Maksimal sponsor platinum</span>
                                            </div>
                                            <input type="text" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="#" />
                                        </label>

                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">tanggal acara mulai</span>
                                            </div>
                                            <input type="date" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="start_date" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Tanggal acara berakhir</span>
                                            </div>
                                            <input type="date" placeholder="..."
                                                class="input input-bordered w-full max-w-xs" name="end_date" />
                                        </label>

                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Proposal</span>
                                            </div>
                                            <input type="file" placeholder="..."
                                                class="file-input file-input-bordered w-full max-w-xs" name="proposal" />
                                        </label>
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Foto acara</span>
                                            </div>
                                            <input type="file" placeholder="..."
                                                class="file-input file-input-bordered w-full max-w-xs" name="image" />
                                        </label>
                                        <div class="flex justify-start mt-4">
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
                        <p class="truncate text-center mx-3">{{ $item->description }}</p>
                        <h1 class="truncate text-center mc-3">{{ $item->location }}</h1>
                        <div class="text-center text-blue-600 underline hover:font-semibold"><a href={{ 'http://localhost:8000/' . $item->proposal }}>Unduh</a></div>
                        <h1 class="text-center">{{ $item->start_date }}</h1>
                        <h1 class="text-center">{{ $item->end_date }}</h1>
                        <div class="text-center">
                            <button class="text-[#dd3429]">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @endif
@endsection
