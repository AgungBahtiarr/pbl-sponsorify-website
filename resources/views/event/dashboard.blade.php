@extends('layouts.event_layout')
@section('content')
    <div class="container mx-auto px-4 py-6 sm:py-8">
        <!-- Header -->
        <div class="mb-8 sm:mb-10">
            <h1 class="text-2xl sm:text-3xl lg:text-[30px] font-semibold text-center">Selamat Pagi!</h1>
            <p class="text-[#9f9f9f] text-center text-sm sm:text-base">
                Yuk cek Progress proposal yang sudah kamu ajukan!
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 lg:gap-12 max-w-4xl mx-auto mb-8 sm:mb-10">
            <!-- Proposals Card -->
            <div class="bg-neutral text-white rounded-xl p-6 text-center">
                <p class="font-semibold text-sm sm:text-base mb-2">Proposal diajukan</p>
                <p class="text-4xl sm:text-5xl lg:text-6xl font-semibold">
                    {{ count($transactions) }}
                </p>
            </div>

            <!-- Reports Card -->
            <div class="bg-neutral text-white rounded-xl p-6 text-center">
                <p class="font-semibold text-sm sm:text-base mb-2">Laporan selesai</p>
                <p class="text-4xl sm:text-5xl lg:text-6xl font-semibold">
                    {{ count($reports) }}
                </p>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 max-w-7xl mx-auto">
            <!-- Proposals Section -->
            <div class="w-full">
                <h2 class="font-semibold text-lg mb-3">Riwayat proposal diajukan</h2>

                @if (count($transactions) == 0)
                    <div class="border border-gray-200 rounded-xl p-6 text-center">
                        <div class="inline-block bg-neutral text-white px-6 py-2 rounded-lg">
                            <span class="font-semibold">Tidak ada</span>
                        </div>
                    </div>
                @else
                    <div class="border border-gray-200 rounded-xl p-4 space-y-4">
                        @foreach ($transactions as $item)
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
                                        <p class="text-sm text-gray-600 truncate">{{ $item->event->name }}</p>
                                    </div>
                                </div>
                                <div class="badge badge-warning hidden sm:flex">
                                    <span class="px-2 py-1 font-semibold">{{ $item->status->status }}</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="pt-2">
                            <a href="/event/status"
                                class="inline-block bg-neutral text-white px-4 py-2 rounded-lg font-semibold hover:bg-neutral-700 transition-colors">
                                Lihat semua
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Reports Section -->
            <div class="w-full">
                <h2 class="font-semibold text-lg mb-3">Laporan yang diajukan</h2>

                @if (count($reports) == 0)
                    <div class="border border-gray-200 rounded-xl p-6 text-center">
                        <div class="inline-block bg-neutral text-white px-6 py-2 rounded-lg">
                            <span class="font-semibold">Tidak ada</span>
                        </div>
                    </div>
                @else
                    <div class="border border-gray-200 rounded-xl p-4 space-y-4">
                        @foreach ($reports as $item)
                            <div class="flex justify-between items-center border border-gray-200 rounded-xl p-4">
                                <div class="flex gap-3 items-center">
                                    <div class="avatar flex-shrink-0">
                                        <div class="w-12 h-12 rounded-full overflow-hidden">
                                            <img src="{{ url($item[1]->image) }}" alt="{{ $item[1]->name }}"
                                                class="object-cover w-full h-full" />
                                        </div>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="font-semibold truncate">{{ $item[1]->name }}</h3>
                                        <p class="text-sm text-gray-600 truncate">{{ $item[1]->email }}</p>
                                    </div>
                                </div>
                                <div class="badge badge-warning hidden sm:flex">
                                    <span class="px-2 py-1 font-semibold">{{ $item[0]->transaction->total_fund }}</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="pt-2">
                            <a href="/event/report"
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
