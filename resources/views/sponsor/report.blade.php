@extends('layouts.sponsor_layout')
@section('content')
    <div class="container mx-auto px-4 py-8 sm:py-11">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl lg:text-[30px] font-semibold mb-2">Laporan</h1>
            <p class="text-[#7f7f7f] font-semibold text-sm sm:text-base">
                Lihat laporan yang telah di kirim event organizer!
            </p>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block">
            <!-- Table Header -->
            <div class="border-b border-black pb-3 mb-4">
                <div class="grid grid-cols-5 text-center font-semibold">
                    <div>Nama Acara</div>
                    <div>Dana sponsorship</div>
                    <div>Tanggal diterima</div>
                    <div>Email penanggung jawab</div>
                    <div>Tindakan</div>
                </div>
            </div>

            <!-- Table Content -->
            <div class="space-y-4">
                @foreach ($data as $item)
                    <div class="grid grid-cols-5 items-center border border-black rounded-lg py-3">
                        <div class="text-center truncate px-2">{{ $item[1]->event->name }}</div>
                        <div class="text-center">Rp {{ number_format($item[0]->transaction->total_fund, 0, ',', '.') }}
                        </div>
                        <div class="text-center">{{ date('d/m/Y', strtotime($item[0]->transaction->created_at)) }}</div>
                        <div class="text-center truncate px-2">{{ $item[1]->event->email }}</div>
                        <div class="flex justify-center">
                            <a href="{{ $item[0]->report }}" class="btn btn-neutral gap-2 text-white">
                                <i class="fa-solid fa-download"></i>
                                <span>Unduh</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @foreach ($data as $item)
                <div class="border border-black rounded-lg p-4">
                    <div class="space-y-3">
                        <!-- Nama Acara -->
                        <div>
                            <label class="font-semibold block mb-1">Nama Acara</label>
                            <div>{{ $item[1]->event->name }}</div>
                        </div>

                        <!-- Dana -->
                        <div>
                            <label class="font-semibold block mb-1">Dana sponsorship</label>
                            <div>Rp {{ number_format($item[0]->transaction->total_fund, 0, ',', '.') }}</div>
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label class="font-semibold block mb-1">Tanggal diterima</label>
                            <div>{{ date('d/m/Y', strtotime($item[0]->transaction->created_at)) }}</div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="font-semibold block mb-1">Email penanggung jawab</label>
                            <div class="truncate">{{ $item[1]->event->email }}</div>
                        </div>

                        <!-- Download Button -->
                        <div class="pt-2">
                            <a href="{{ $item[0]->report }}" class="btn btn-neutral w-full gap-2 text-white">
                                <i class="fa-solid fa-download"></i>
                                <span>Unduh laporan</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if (count($data) === 0)
            <div class="border border-black rounded-lg p-6 text-center">
                <p class="text-gray-500">Belum ada laporan yang tersedia</p>
            </div>
        @endif

    </div>

    <style>
        @media (max-width: 768px) {
            .scroll-container {
                -webkit-overflow-scrolling: touch;
                scrollbar-width: thin;
            }

            .scroll-container::-webkit-scrollbar {
                height: 4px;
            }

            .scroll-container::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            .scroll-container::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 2px;
            }
        }
    </style>
@endsection
