@extends('layouts.sponsor_layout')
@section('content')
    <div class="container mx-auto px-4 py-8 sm:py-11">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl lg:text-[30px] font-semibold mb-2">Riwayat</h1>
            <p class="text-[#7f7f7f] font-semibold text-sm sm:text-base">
                Lihat acara yang telah kamu terima!
            </p>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block">
            <!-- Table Header - Original Style -->
            <div class="border-b border-black pb-3 mb-4">
                <div class="grid grid-cols-5 text-center font-semibold">
                    <div>Nama Acara</div>
                    <div>Dana sponsorship</div>
                    <div>Tanggal acara</div>
                    <div>Email penanggung jawab</div>
                    <div>Status</div>
                </div>
            </div>

            <!-- Table Body -->
            <div class="space-y-4">
                @foreach ($histories as $item)
                    <div class="grid grid-cols-5 items-center border border-black rounded-lg py-3">
                        <div class="text-center truncate px-2">{{ $item->event->name }}</div>
                        <div class="text-center">Rp {{ number_format($item->total_fund, 0, ',', '.') }}</div>
                        <div class="text-center">{{ date('d/m/Y', strtotime($item->event->start_date)) }}</div>
                        <div class="text-center truncate px-2">{{ $item->event->email }}</div>
                        <div class="flex justify-center">
                            <span class="badge badge-warning">{{ $item->status->status }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @foreach ($histories as $item)
                <div class="border border-black rounded-lg p-4">
                    <div class="space-y-3">
                        <div>
                            <label class="font-semibold">Nama Acara</label>
                            <div>{{ $item->event->name }}</div>
                        </div>

                        <div>
                            <label class="font-semibold">Dana sponsorship</label>
                            <div>Rp {{ number_format($item->total_fund, 0, ',', '.') }}</div>
                        </div>

                        <div>
                            <label class="font-semibold">Tanggal acara</label>
                            <div>{{ date('d/m/Y', strtotime($item->event->start_date)) }}</div>
                        </div>

                        <div>
                            <label class="font-semibold">Email penanggung jawab</label>
                            <div class="truncate">{{ $item->event->email }}</div>
                        </div>

                        <div>
                            <label class="font-semibold">Status</label>
                            <div>
                                <span class="badge badge-warning">{{ $item->status->status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if (count($histories) === 0)
            <div class="border border-black rounded-lg p-6 text-center">
                <p class="text-gray-500">Belum ada riwayat acara</p>
            </div>
        @endif

    </div>

    <!-- Optional: Add custom scrollbar for mobile horizontal scroll -->
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
