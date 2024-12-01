@extends('layouts.event_layout')
@section('content')
    @if (count($events) == 0)
        <div class="flex justify-center items-center min-h-[89vh] px-4">
            <div class="flex flex-col items-center gap-3 text-center">
                <h1 class="text-lg sm:text-xl font-semibold">Silahkan tambahkan acara terlebih dahulu</h1>
                <div>
                    <a href="/event/formSatu">
                        <button
                            class="px-4 py-2 bg-yellow-400 font-semibold rounded-xl hover:bg-yellow-500 transition-colors">
                            Tambah
                        </button>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col items-center justify-center my-8 sm:my-14">
                <h1 class="text-2xl sm:text-[30px] font-bold text-center">Daftar Acara</h1>
                <p class="font-semibold text-[#7f7f7f] text-center">Buat acara terbaikmu disini!</p>
            </div>

            <!-- Tombol Tambah untuk Mobile -->
            <div class="mb-6 sm:hidden">
                <a href="/event/formSatu" class="btn btn-primary w-full font-semibold">Tambah acara</a>
            </div>

            <!-- Table Header - Hidden on Mobile -->
            <div class="hidden sm:block border-b border-black pb-3">
                <div class="grid grid-cols-7 text-center font-semibold items-center gap-2">
                    <div>Nama acara</div>
                    <div>Email PIC</div>
                    <div>Deskripsi acara</div>
                    <div>Lokasi</div>
                    <div>Proposal</div>
                    <div>Tanggal Mulai</div>
                    <div>
                        <a href="/event/formSatu" class="btn btn-primary font-semibold">Tambah acara</a>
                    </div>
                </div>
            </div>

            <!-- Mobile View -->
            <div class="sm:hidden space-y-4">
                @foreach ($events as $item)
                    <div class="bg-white rounded-lg shadow p-4 space-y-3">
                        <div class="flex justify-between items-center">
                            <h2 class="font-semibold">{{ $item->name }}</h2>
                            <form action="/event/{{ $item->id }}" method="POST" class="inline">
                                @csrf
                                @method('delete')
                                <button class="text-red-500">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                        <div class="space-y-2">
                            <p><span class="font-medium">Email:</span> {{ $item->email }}</p>
                            <p><span class="font-medium">Deskripsi:</span> {{ $item->description }}</p>
                            <p><span class="font-medium">Lokasi:</span> {{ $item->location }}</p>
                            <p><span class="font-medium">Tanggal Mulai:</span> {{ $item->start_date }}</p>
                            <div>
                                <a href={{ '/' . $item->proposal }} class="text-blue-600 underline">
                                    Unduh Proposal
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop View -->
            <div class="hidden sm:block">
                @foreach ($events as $item)
                    <div class="grid grid-cols-7 items-center gap-2 border border-black rounded-lg my-4 p-3">
                        <div class="text-center truncate">{{ $item->name }}</div>
                        <div class="text-center truncate">{{ $item->email }}</div>
                        <div class="text-center truncate px-2">{{ $item->description }}</div>
                        <div class="text-center truncate px-2">{{ $item->location }}</div>
                        <div class="text-center">
                            <a href={{ '/' . $item->proposal }} class="text-blue-600 underline hover:font-semibold">
                                Unduh
                            </a>
                        </div>
                        <div class="text-center">{{ $item->start_date }}</div>
                        <div class="text-center">
                            <form action="/event/{{ $item->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="text-red-500 hover:text-red-700">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
