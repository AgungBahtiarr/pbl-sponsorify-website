@extends('layouts.sponsor_layout')
@section('content')
    <div class="container mx-auto px-4 py-6 sm:py-8">
        <!-- Header -->
        <div class="mb-8 sm:mb-10">
            <h1 class="text-2xl sm:text-3xl lg:text-[30px] font-semibold text-center">Selamat Pagi!</h1>
            <p class="text-[#9f9f9f] text-center text-sm sm:text-base">
                Yuk cek berapa proposal yang sudah masuk di perusahaanmu
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 lg:gap-12 max-w-4xl mx-auto mb-8 sm:mb-10">
            <!-- Proposals Card -->
            <div class="bg-neutral text-white rounded-xl p-6 text-center">
                <p class="font-semibold text-sm sm:text-base mb-2">Proposal masuk</p>
                <p class="text-4xl sm:text-5xl lg:text-6xl font-semibold">
                    {{ count($proposalIn) }}
                </p>
            </div>

            <!-- Reports Card -->
            <div class="bg-neutral text-white rounded-xl p-6 text-center">
                <p class="font-semibold text-sm sm:text-base mb-2">Laporan selesai</p>
                <p class="text-4xl sm:text-5xl lg:text-6xl font-semibold">
                    {{ count($report) }}
                </p>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 max-w-7xl mx-auto">
            <!-- Proposals History Section -->
            <div class="w-full">
                <h2 class="font-semibold text-lg mb-3">Riwayat proposal</h2>

                @if (count($history) == 0)
                    <div class="border border-gray-200 rounded-xl p-6 text-center">
                        <div class="inline-block bg-neutral text-white px-6 py-2 rounded-lg">
                            <span class="font-semibold">Tidak ada</span>
                        </div>
                    </div>
                @else
                    <div class="border border-gray-200 rounded-xl p-4 space-y-4">
                        @foreach ($history as $item)
                            <div class="flex justify-between items-center border border-gray-200 rounded-xl p-4">
                                <div class="flex gap-3 items-center">
                                    <div class="avatar flex-shrink-0">
                                        <div class="w-12 h-12 rounded-full overflow-hidden">
                                            <img src="{{ url($item->event->image) }}" alt="{{ $item->event->name }}"
                                                class="object-cover w-full h-full" />
                                        </div>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="font-semibold truncate">{{ $item->event->name }}</h3>
                                        <p class="text-sm text-gray-600 truncate">{{ $item->event->email }}</p>
                                    </div>
                                </div>
                                <div class="badge badge-warning hidden sm:flex whitespace-nowrap">
                                    <span class="px-2 py-1 font-semibold">{{ $item->status->status }}</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="pt-2">
                            <a href="/sponsor/history"
                                class="inline-block bg-neutral text-white px-4 py-2 rounded-lg font-semibold hover:bg-neutral-700 transition-colors">
                                Lihat semua
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pending Proposals Section -->
            <div class="w-full">
                <h2 class="font-semibold text-lg mb-3">Belum di respon</h2>

                @if (count($proposalIn) == 0)
                    <div class="border border-gray-200 rounded-xl p-6 text-center">
                        <div class="inline-block bg-neutral text-white px-6 py-2 rounded-lg">
                            <span class="font-semibold">Tidak ada</span>
                        </div>
                    </div>
                @else
                    <div class="border border-gray-200 rounded-xl p-4 space-y-4">
                        @foreach ($proposalIn as $item)
                            <div class="flex justify-between items-center border border-gray-200 rounded-xl p-4">
                                <div class="flex gap-3 items-center">
                                    <div class="avatar flex-shrink-0">
                                        <div class="w-12 h-12 rounded-full overflow-hidden">
                                            <img src="{{ url($item->event->image) }}" alt="{{ $item->event->name }}"
                                                class="object-cover w-full h-full" />
                                        </div>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="font-semibold truncate">{{ $item->event->name }}</h3>
                                        <p class="text-sm text-gray-600 truncate">{{ $item->event->email }}</p>
                                    </div>
                                </div>
                                <div class="badge badge-warning hidden sm:flex whitespace-nowrap">
                                    <span class="px-2 py-1 font-semibold">{{ $item->status->status }}</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="pt-2">
                            <a href="/sponsor/event"
                                class="inline-block bg-neutral text-white px-4 py-2 rounded-lg font-semibold hover:bg-neutral-700 transition-colors">
                                Lihat semua
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
