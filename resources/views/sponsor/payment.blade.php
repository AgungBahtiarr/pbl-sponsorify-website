@extends('layouts.sponsor_layout')
@section('content')
    <div class="container mx-auto px-4 py-8 sm:py-11">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl lg:text-[30px] font-semibold mb-2">Pembayaran</h1>
            <p class="text-[#7f7f7f] font-semibold text-sm sm:text-base">
                Segera lakukan sponsorshipmu!
            </p>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block">
            <!-- Table Header -->
            <div class="border-b border-black pb-3 mb-4">
                <div class="grid grid-cols-4 text-center font-semibold">
                    <div>Nama Acara</div>
                    <div>Dana sponsorship</div>
                    <div>Status</div>
                    <div>Tindakan</div>
                </div>
            </div>

            <!-- Table Content -->
            <div class="space-y-4">
                @foreach ($data as $item)
                    <div class="grid grid-cols-4 items-center border border-black rounded-lg py-3">
                        <div class="text-center truncate px-2">{{ $item->event->name }}</div>
                        <div class="text-center">Rp {{ number_format($item->total_fund, 0, ',', '.') }}</div>
                        <div class="flex justify-center">
                            @php
                                $statusClasses = [
                                    1 => 'border-neutral text-neutral',
                                    2 => 'border-[#21be32] text-[#21be32]',
                                    3 => 'border-[#2a9c49] text-[#2a9c49]',
                                    4 => 'border-[#db3227] text-[#db3227]',
                                ];
                                $statusLabels = [
                                    1 => 'Belum dicairkan',
                                    2 => 'Sedang diproses',
                                    3 => 'Selesai',
                                    4 => 'Gagal',
                                ];
                            @endphp
                            <span
                                class="px-4 py-1 bg-white border rounded-full font-semibold 
                                   {{ $statusClasses[$item->id_payment_status] }}">
                                {{ $statusLabels[$item->id_payment_status] }}
                            </span>
                        </div>
                        <div class="flex justify-center">
                            <button class="btn btn-primary" onclick="my_modal_{{ $item->id }}.showModal()">
                                Bayar
                            </button>
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
                            <div>{{ $item->event->name }}</div>
                        </div>

                        <!-- Dana -->
                        <div>
                            <label class="font-semibold block mb-1">Dana sponsorship</label>
                            <div>Rp {{ number_format($item->total_fund, 0, ',', '.') }}</div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="font-semibold block mb-1">Status</label>
                            <div>
                                <span
                                    class="inline-block px-4 py-1 bg-white border rounded-full font-semibold 
                                       {{ $statusClasses[$item->id_payment_status] }}">
                                    {{ $statusLabels[$item->id_payment_status] }}
                                </span>
                            </div>
                        </div>

                        <!-- Payment Button -->
                        <div class="pt-2">
                            <button class="btn btn-primary w-full" onclick="my_modal_{{ $item->id }}.showModal()">
                                Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Payment Modals -->
        @foreach ($data as $item)
            <dialog id="my_modal_{{ $item->id }}" class="modal">
                <div class="modal-box w-11/12 max-w-md">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>

                    <div class="text-center mb-6">
                        <h3 class="font-semibold text-lg mb-2">Silahkan lakukan pembayaran sebesar</h3>
                        <p class="font-bold text-xl">Rp {{ number_format($item->level->fund, 0, ',', '.') }}</p>
                    </div>

                    <form action="/sponsor/payNow" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}" />
                        <button class="btn btn-primary w-full">Bayar sekarang</button>
                    </form>
                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>
        @endforeach

        <!-- Empty State -->
        @if (count($data) === 0)
            <div class="border border-black rounded-lg p-6 text-center">
                <p class="text-gray-500">Tidak ada pembayaran yang pending</p>
            </div>
        @endif
    </div>
@endsection
