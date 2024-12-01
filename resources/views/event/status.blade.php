@extends('layouts.event_layout')
@section('content')
    <div class="container mx-auto px-4 py-8 sm:py-11">
        <div class="mb-8 sm:mb-11">
            <h1 class="text-2xl sm:text-3xl font-semibold mb-2">Status</h1>
            <h2 class="text-[#7f7f7f] font-semibold text-sm sm:text-base">
                Status pengajuan proposal yang telah anda ajukan
            </h2>
        </div>

        <!-- Table Header - Hidden on Mobile -->
        <div class="hidden sm:block border-b border-black pb-3 mb-4">
            <div class="grid grid-cols-4 text-center font-semibold">
                <div>Nama Acara</div>
                <div>Tanggal Pengajuan</div>
                <div>Nama Sponsor</div>
                <div>Status</div>
            </div>
        </div>

        <!-- Mobile and Desktop View -->
        <div class="space-y-4">
            @foreach ($transactions as $transaction)
                <!-- Mobile View -->
                <div class="sm:hidden bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">Nama Acara:</span>
                            <span>{{ $transaction->event->name }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">Tanggal:</span>
                            <span>{{ date('d/m/Y', strtotime($transaction->created_at)) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">Sponsor:</span>
                            <span>{{ $transaction->sponsor->name }}</span>
                        </div>
                        <div class="flex justify-center mt-2">
                            <button onclick="my_modal_proses_{{ $transaction->id }}.showModal()"
                                class="btn btn-neutral w-full">
                                Cek Status
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Desktop View -->
                <div class="hidden sm:grid grid-cols-4 text-center items-center border border-black rounded-lg py-3">
                    <div class="px-4">
                        <h2 class="truncate">{{ $transaction->event->name }}</h2>
                    </div>
                    <div>{{ date('d/m/Y', strtotime($transaction->created_at)) }}</div>
                    <div class="px-4 truncate">{{ $transaction->sponsor->name }}</div>
                    <div>
                        <button onclick="my_modal_proses_{{ $transaction->id }}.showModal()" class="btn btn-neutral">
                            Cek Status
                        </button>
                    </div>
                </div>

                <!-- Modal - Same for both views -->
                <dialog id="my_modal_proses_{{ $transaction->id }}" class="modal">
                    <div class="modal-box w-11/12 max-w-md">
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>

                        <h3 class="font-bold text-lg mb-4">Status</h3>

                        @if ($transaction->id_status == 1)
                            <span class="inline-block px-4 py-2 rounded-lg bg-yellow-400 font-semibold">
                                {{ $transaction->status->status }}
                            </span>
                        @elseif($transaction->id_status == 2)
                            <span class="inline-block px-4 py-2 rounded-lg bg-[#30a24f] text-white font-semibold">
                                {{ $transaction->status->status }}
                            </span>
                        @elseif($transaction->id_status == 3)
                            <span class="inline-block px-4 py-2 rounded-lg bg-[#dd3428] text-white font-semibold">
                                {{ $transaction->status->status }}
                            </span>
                        @endif

                        <div class="mt-4">
                            <h4 class="font-semibold mb-2">Pesan:</h4>
                            <div class="border-2 rounded-lg p-4 min-h-[8rem] bg-white">
                                <p>
                                    @if ($transaction->id_status == 1)
                                        Proposal kamu sedang dalam pengecekan oleh pihak sponsor
                                    @else
                                        {{ $transaction->comment }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <form method="dialog" class="modal-backdrop">
                        <button>close</button>
                    </form>
                </dialog>
            @endforeach
        </div>
    </div>
@endsection
