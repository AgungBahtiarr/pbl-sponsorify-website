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
            </div>
        </div>
    @else
        <div>
            <div class="flex flex-col items-center justify-center my-14">
                <h1 class="text-2xl font-bold">Daftar Event</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="overflow-x-auto mb-10 mx-6">
                <table class="table border ">
                    <!-- head -->
                    <thead>
                        <tr class="text-black">
                            <th class="font-bold text-[18px]">Nama Event</th>
                            <th class="font-bold text-[18px]">Email PIC</th>
                            <th class="font-bold text-[18px]">Deskripsi Event</th>
                            <th class="font-bold text-[18px]">Lokasi</th>
                            <th class="font-bold text-[18px]">Proposal</th>
                            <th class="font-bold text-[18px]">Tanggal Mulai</th>
                            <th class="font-bold text-[18px]">Tanggal Berakhir</th>
                            <th>                <div>
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
                            </div></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $item)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <div class="font-bold">{{ $item->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{$item->email}}
                                </td>
                                <td>
                                    {{ $item->description }}
                                </td>
                                <td>{{ $item->location }}</td>
                                <th>
                                    <a href={{"http://localhost:8000/" .  $item->proposal }}>Download</a>
                                </th>
                                <td>
                                    {{ $item->start_date }}
                                </td>
                                <td>
                                    {{ $item->end_date }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
