@extends('layouts.event_layout')
@section('content')
    @if (count($events) == 0)
        <div class="flex justify-center items-center h-[89vh]">
            <div class="flex flex-col items-center gap-3">
                <h1 class="text-xl font-semibold">Silahkan tambahkan acara terlebih dahulu</h1>
                <div>
                    <a href="/event/formSatu">
                        <h1 class="p-2 bg-yellow-400 font-semibold rounded-xl">Tambah</h1>
                    </a>
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
                            <a href="/event/formSatu" class="btn btn-primary font-semibold">Tambah acara</a>
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
                        <div class="text-center text-blue-600 underline hover:font-semibold"><a
                                href={{ 'http://localhost:8000/' . $item->proposal }}>Unduh</a></div>
                        <h1 class="text-center">{{ $item->start_date }}</h1>
                        <h1 class="text-center">{{ $item->end_date }}</h1>
                        <div class="text-center">
                            <form action="/event/{{ $item->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="text-[#dd3429]">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @endif
@endsection
