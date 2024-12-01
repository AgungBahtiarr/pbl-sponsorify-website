@extends('layouts.sponsor_layout')
@section('content')
    <div class="container mx-auto px-4 py-8 sm:py-10">
        <!-- Header -->
        <div class="max-w-2xl mx-auto text-center mb-8 sm:mb-12">
            <h1 class="text-2xl sm:text-3xl lg:text-[30px] font-semibold mb-2">
                List proposal masuk
            </h1>
            <p class="text-[#9f9f9f] text-sm sm:text-base">
                Yuk cek beberapa proposal yang sudah masuk di perusahaanmu
            </p>
        </div>

        <!-- Proposals Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($transactions as $item)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <!-- Header with Avatar -->
                        <div class="flex items-center gap-4 mb-6">
                            <div class="avatar flex-shrink-0">
                                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full overflow-hidden">
                                    <img src="/{{ $item->event->image }}" alt="{{ $item->event->name }}"
                                        class="w-full h-full object-cover" />
                                </div>
                            </div>
                            <div class="min-w-0">
                                <h2 class="font-semibold text-lg sm:text-xl truncate">
                                    {{ $item->event->name }}
                                </h2>
                                <p class="text-gray-600 text-sm truncate">
                                    {{ $item->event->email }}
                                </p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="space-y-2 mb-6">
                            <h3 class="font-semibold text-lg">Deskripsi</h3>
                            <p class="text-gray-700 line-clamp-3">
                                {{ $item->event->description }}
                            </p>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-auto">
                            <a href="/sponsor/detail/{{ $item->id }}"
                                class="block w-full py-3 px-4 bg-yellow-400 hover:bg-yellow-500 
                                  text-center font-semibold rounded-lg transition-colors 
                                  duration-200">
                                Lihat detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State (if needed) -->
        @if (count($transactions) === 0)
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">
                    Belum ada proposal yang masuk
                </p>
            </div>
        @endif
    </div>
@endsection

<style>
    /* Optional: Add custom styles for better truncation */
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
